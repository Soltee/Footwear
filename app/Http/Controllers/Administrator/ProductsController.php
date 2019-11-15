<?php

namespace App\Http\Controllers\Administrator;

use App\Products;
use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
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
        $products = Products::latest()->paginate(10);
        // dd($products);
        // $total = Products::all()->count();
        // $shown = $products->count();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::latest()->get();
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
            'category' => ['required', 'int', 'min:1'],
            'name' => ['required','string', 'min:2', 'unique:products'],
            'imageUrl' => ['required','image'],
            'price' => ['required', 'int', 'min:1'],
            'qty' => ['required', 'int', 'min:1']
        ]);
        
        // dd($request->all());
        $item =  $request->file('imageUrl')->store('products', 'public');

        // $storeImage = Image::make(public_path("storage/{$item}"))->fit(1200, 1200);
        // $storeImage->save();

        $product = Products::create([
            'category_id' => $data['category'],
            'name' => $data['name'],
            'price' => $data['price'],
            'qty' => $data['qty'],
            'imageUrl' => $item,
            'excerpt' => ($request->input('excerpt')) ? $request->input('excerpt') : "" ,
            'description' => ($request->input('description')) ? $request->input('description') : "" ,
            'visible' => $request->filled('visible')
        ]);

        return redirect()->back()->with(['success' =>'Product added.', 'product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products, $slug)
    {
        return view('products.show', compact('products'));
        // dd($products->id);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products, $slug)
    {
        // dd($slug);
        $categories = Categories::latest()->get();
        $category = Categories::findOrfail($products->category_id);

        return view('products.edit', compact('products', 'categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        $data = $this->validate($request, [
            'category' => ['required', 'int', 'min:1'],
            'name' => ['required','string', 'min:2'],
            'price' => ['required', 'int', 'min:1'],
            'qty' => ['required', 'int', 'min:1']
        ]);
        // dd($request->all());
        

        if($request->hasFile('imageUrl')){
            $this->validate($request,['imageUrl' => ['required','image']]);
            $image = $request->file('imageUrl')->store('products', 'public');
            $imagePath = ['imageUrl' => $image];
        }

        // $storeImage = Image::make(public_path("storage/{$item}"))->fit(1200, 1200);
        // $storeImage->save();
        $excerpt = ['excerpt' => $request->input('excerpt')];

        $description = ['description' => $request->input('description')];

        $products->update(array_merge(
            [
                'category_id' => $data['category'],
                'name' => $data['name'],
                'price' => $data['price'],
                'qty' => $data['qty'],
                'visible' => $request->filled('visible')
            ],
            $imagePath   ?? []
            // ,$excerpt     ?? [],
            // $description ?? []
        ));

        return redirect()->route('administrator-dashboard')->with('success', 'Product added.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        // dd(Storage::path($products->imageUrl));
        // ($products->imageUrl) ? File::delete($products->imageUrl) : '' ;
        // ($products->imageUrl) ?? Storage::disk('local')->delete([$products->imageUrl]);
        // $products->delete();
        return response()->json(['success' => 'true'], 204);
        // return redirect()->route('administrator-dashboard')->with('success', 'Product dropped.');
  
    }
}
