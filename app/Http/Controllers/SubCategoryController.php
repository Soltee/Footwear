<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index(Category $category){
    	$subcategories = Subcategory::latest()->where('category_id', $category->id)->get();
    	return response()->json(['subcategories' => $subcategories], 200);
    }


    public function getSubCategories(){
    	$category = request()->category;
        $search = request()->search;

        $query = Subcategory::latest();
        if($category){
        	$query = $query->where('category_id', $category);
        }

        if($search){
            $query = $query->orderBy('name')->where('name', 'LIKE', '%'.$search.'%');
        }

        $subcategories = $query->paginate(5);

        return response()->json([
            'subcategories' => $subcategories->items(),
            'paginate' => [
                'first_item'    => $subcategories->firstItem(),
                'last_item'     => $subcategories->lastItem(),
                'previous_page_url' => $subcategories->previousPageUrl(),
                'current_page'      => $subcategories->currentPage(),
                'next_page_url'     => $subcategories->nextPageUrl(),
                'current_count' => $subcategories->count(),
                'total_count'   => $subcategories->total()
            ]
        ], 200);
    }

    public function store(Request $request){
    	$data = $this->validate($request, [
    		'name' => 'required|string|min:3',
    		'category' => 'required|string'
    	]);

    	Subcategory::create([
    		'category_id' => $data['category'],
    		'name'       => $data['name'],
            'slug'      => Str::slug($data['name'])
    	]);

    	return response()->json(['success' => 'Ok'], 201);
    }

    public function update(Request $request, Subcategory $subcategory){
        $data = $this->validate($request, [
            'name' => 'required|string|min:3',
            'category' => 'required|string'
        ]);

        $subcategory->update([
            'category_id' => $data['category'],
            'name'       => $data['name'],
            'slug'      => Str::slug($data['name'])
        ]);

        return response()->json(['success' => 'Ok'], 200);
    }

    public function destroy(Subcategory $subcategory){
    	$subcategory->delete();
    	return response()->json(['success' => 'Ok'], 204);    	
    }
}
