<?php

namespace App\Http\Controllers\Administrator\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use App\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }



    public function getProducts()
    {
        $search = request()->search;

        $query = Product::latest()->withCount('reviews');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $data = $this->validate($request, [
            'name' => ['required','string', 'min:2', 'unique:products'],
            'price' => ['required', 'int', 'min:1'],
            'qty' => ['required', 'int', 'min:1'],
            'category' => ['required', 'string', 'min:1'],
            'subcategory' => ['required', 'string', 'min:1'],
        ]);
        

        abort_if(!$request->hasFile('files'), 422);
        $allowedfileExtension = ['jpeg','jpg','png','gif'];
        $images      = $request->file('files'); 
        foreach($images as $file){
            $filename = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $check = in_array($extension,$allowedfileExtension);
            abort_if(!$check, 422);
        }



        foreach ($images as $image) {
            $basename  = Str::random();
            $original  = 'pd-' . $basename . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $original, 'public'); 

            $paths[] =  [
                'filename'  => $original,
                'url'       => 'storage/products/' . $original
            ];
        }

        $product = Product::create([
            'category_id' => $data['category'],
            'subcategory_id' => $data['subcategory'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name'], '-'),
            'price' => $data['price'],
            'qty' => $data['qty'],
            'imageUrl' => $paths[0]['url'],
            'excerpt' => ($request->input('excerpt')) ? $request->input('excerpt') : "" ,
            'description' => ($request->input('description')) ? $request->input('description') : "" 
        ]);

        foreach ($paths as $path) {
            ProductImages::create([
                'product_id' => $product->id,
                'imageUrl'   => $path['url'],
                'thumbnail'  => $path['filename']
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
            'product'     => $product,
            'category'    => $product->categories,
            'subcategory' => $product->subcategories,
            'images'      => $product->images,
            'reviews'    => count($product->reviews)
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
            'name'         => ['required','string', 'min:2'],
            'price'       => ['required', 'int', 'min:1'],
            'qty'         => ['required', 'int', 'min:1'],
            'category'    => ['required', 'string', 'min:1'],
            'subcategory' => ['required', 'string', 'min:1'],
        ]);

        if((count($product->images) < 1) && !$request->hasFile('files')){
            abort(422, 'Please select an image. All images has been deleted.');
        } else {

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $images      = $request->file('files'); 
            foreach($images as $file){
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension,$allowedfileExtension);
                abort_if(!$check, 422, 'File must be jpeg, png or gif');
            }

            foreach ($images as $image) {
                $basename  = Str::random();
                $original  = 'pd-' . $basename . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $original, 'public'); 

                $paths[] =  [
                    'filename'  => $original,
                    'url'       => 'storage/products/' . $original
                ];

            }

            $firstImagePathArr = [
                'imageUrl' => $paths[0]['url']
            ];

            foreach ($paths as $path) {
                ProductImages::create([
                    'product_id' => $product->id,
                    'imageUrl'   => $path['url'],
                    'thumbnail'  => $path['filename']
                ]);

            }

        }



        // dd($data['description']);
        $descriptionArray  = ['description' => $request->input('description')];
        $excerptArray      = ['excerpt' => $request->input('excerpt')];
        // dd($paths);
        $new_product = $product->update(array_merge([
                'category_id'    => $data['category'],
                'subcategory_id' => $data['subcategory'],
                'name'           => $data['name'],
                'slug'           => Str::slug($data['name'], '-'),
                'price'          => $data['price'],
                'qty'            => $data['qty']
            ], 
            ($firstImagePathArr)?? [],
            ($excerptArray) ?? [], 
            ($descriptionArray) ?? []));

        return response()->json(['success' => 'true'], 200);
    }

    /**g
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach ($product->images() as $image) {
            unlink($image->thumbnail);
            // File::delete($image->thumbnail);
            $image->delete();
        }

        $product->delete();
        return response()->json(['success' => 'true'], 204);
  
    }
}
