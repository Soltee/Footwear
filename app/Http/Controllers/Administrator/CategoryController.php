<?php

namespace App\Http\Controllers\Administrator;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    
	public function index()
	{
		return view('categories.index');
	}

    public function getCategories()
    {
        $category = request()->category;
        $search = request()->search;

        if($category){
            $subcategories = Subcategory::where('category_id', $category)->rderBy('name')->get();
            return response()->json([
                'subcategories' => $subcategories
            ], 200);
        } else {
            $query = Category::latest();
            if($search){
                $query = $query->orderBy('name')->where('name', 'LIKE', '%'.$search.'%');
            }

            $categories = $query->paginate(10);

            return response()->json([
                'categories' => $categories->items(),
                'paginate' => [
                    'first_item'    => $categories->firstItem(),
                    'last_item'     => $categories->lastItem(),
                    'previous_page_url' => $categories->previousPageUrl(),
                    'current_page'      => $categories->currentPage(),
                    'next_page_url'     => $categories->nextPageUrl(),
                    'current_count' => $categories->count(),
                    'total_count'   => $categories->total()
                ]
            ], 200);
        }        
    }



    public function store(Request $request){
        $data = $this->validate($request, [
            'name' => 'required|string|min:3',
        ]);

        Category::create([
            'name'       => $data['name'],
            'slug'      => Str::slug($data['name'])
        ]);

        return response()->json(['success' => 'Ok'], 201);
    }

    public function destroy(Category $category){
        $category->delete();
        return response()->json(['success' => 'Ok'], 204);      
    }
}
