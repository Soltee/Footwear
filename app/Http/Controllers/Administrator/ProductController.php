<?php

namespace App\Http\Controllers\Administrator;

use App\Product;
use App\ProductImages;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }


    public function getProducts()
    {
        $search = request()->search;

        $query = Product::latest();
        if($search){
            $query = $query->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('price', 'LIKE', '%'.$search.'%');
         }

        $products = $query->paginate(5);

        return response()->json([
            'products' => $products->items(),
            'paginate' => [
                'first_item'    => $products->firstItem(),
                'last_item'     => $products->lastItem(),
                'previous_page_url' => $products->previousPageUrl(),
                'current_page'      => $products->currentPage(),
                'next_page_url'     => $products->nextPageUrl(),
                'current_count' => $products->count(),
                'total_count'   => $products->total()
            ]
        ], 200);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $data = $this->validate($request, [
            'category' => ['required', 'string', 'min:1'],
            'subcategory' => ['required', 'string', 'min:1'],
            'name' => ['required','string', 'min:2', 'unique:products'],
            'cover' => ['required','file', 'image', 'mimes:jpeg,png,gif,webp', 'max:2048'],
            'file*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            'price' => ['required', 'int', 'min:1'],
            'qty' => ['required', 'int', 'min:1']
        ]);
        
        $images      = $request->file('files'); // get the validated filee
        foreach ($images as $image) {
            $basename  = Str::random();
            $original  = 'pd-' . $basename . '.' . $image->getClientOriginalExtension();
            $paths[] = $image->storeAs('products', $original, 'public'); 
        }

        $product = Product::create([
            'category_id' => $data['category'],
            'subcategory_id' => $data['subcategory'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name'], '-'),
            'price' => $data['price'],
            'qty' => $data['qty'],
            'imageUrl' => $paths[0],
            'excerpt' => ($request->input('excerpt')) ? $request->input('excerpt') : "" ,
            'description' => ($request->input('description')) ? $request->input('description') : "" 
        ]);

        foreach ($paths as $path) {
            ProductImages::create([
                'product_id' => $product->id,
                'imageUrl'   => $path,
                'thumbnail'  => $path
            ]);
        }

        return response()->json(['success' => 'Ok'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => $product,
            'category' => $product->categories,
            'subcategory' => $product->subcategories,
            'images'  => $product->images
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $data = $this->validate($request, [
            'category' => ['required', 'string', 'min:1'],
            'subcategory' => ['required', 'string', 'min:1'],
            'name' => ['required','string', 'min:2', 'unique:products'],
            'price' => ['required', 'int', 'min:1'],
            'qty' => ['required', 'int', 'min:1']
        ]);
        // dd($request->all());
        if($request->file('files')){
            $files = $this->validate($request, [
                'file*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',                
            ]);
            // dd($files['files']);

            $images      = $request->file('files'); // get the validated filee
            // dd($images);

            foreach ($images as $image) {
                $basename  = Str::random();
                $original  = 'pd-' . $basename . '.' . $image->getClientOriginalExtension();
                $paths[] = $image->storeAs('products', $original, 'public'); 
            }
        }
        // dd($data['description']);
        $descriptionArray  = ['description' => $request->input('description')];
        $excerptArray      = ['excerpt' => $request->input('excerpt')];

        $new_product = $product->update(array_merge([
            'category_id' => $data['category'],
            'subcategory_id' => $data['subcategory'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name'], '-'),
            'price' => $data['price'],
            'qty' => $data['qty']
        ], ($excerptArray) ?? [], ($descriptionArray) ?? []));


        foreach ($paths as $path) {
            ProductImages::create([
                'product_id' => $product->id,
                'imageUrl'   => $path,
                'thumbnail'  => $path
            ]);
        }

        return response()->json(['success' => 'true'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        ($product->imageUrl) ?? Storage::disk('public')->delete([$product->imageUrl]);
        $product->delete();
        App\ProductImages::where('product_id', $product->id)->delete();
        return response()->json(['success' => 'true'], 204);
  
    }
}
