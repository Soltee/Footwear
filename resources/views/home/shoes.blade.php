@extends('layouts.app')

@section('content')
    <div class="  px-6  lg:px-12 flex flex-row bg-gray-300">
        
        <!-- Categories -->
       <div class="w-48 px-3 py-3">
            <ul class="flex flex-col items-left ml-2">
              @forelse($categories as $category)

                <a class="mt-3 " href="{{ route('shoes', ['id' => $category->id , 'category' => $category->name]) }}" class="text-black hover:opacity-75">
                  <h4 class="text-lg font-bold mb-3 ">{{ $category->name }}</h4>
                </a>

                <ul class="mt-2 flex flex-col items-left ml-2">
                  @forelse($category->subcategories as $subcategory)
            
                  <li class="mb-2">
                        <a href="{{ route('shoes', ['id' => $subcategory->id , 'subcategory' => $subcategory->name]) }}">
                            {{ $subcategory->name }}
                        </a>
                  </li> 
                  @empty  
                  @endforelse
                </ul>              
              @empty 

              @endforelse
            </ul>
       </div>

        <!-- Shoes -->
       <div class="px-3 py-3 flex flex-col flex-1 mt-3">
       		<div class="flex flex-row justify-between">
       			<h4 class="text-lg font-bold mb-3">Products</h4>
            <span class="">{{ $count }} / {{ $products->total() }}</span>
       		</div>
       		<div class="mt-10 flex flex-row  flex-wrap {{ $count > 2 ? '' : '' }}">
       			@forelse($products as $product)

                <div class=" w-full sm:w-1/2 p-3 md:w-1/3 lg:w-1/4   {{ $count > 2 ? '' : 'mr-24' }}">
                	<div class="flex flex-col bg-white shadow-md rounded-lg">
                    <img class="w-full h-64 object-cover object-center rounded-lg" src="storage/{{ $product->imageUrl }}" alt="Product Image">
                    <h5>{{ $product->name }}</h5>
                    <h5>{{ $product->price }}</h5> 
                  </div>
                </div>              
	            @empty 

	            @endforelse

       		</div>
			
			     @if($count > 2)
       	    <div class="mt-6 flex flex-row justify-center items-center ">
  				    <a href="{{ $products->appends(request()->input())->previousPageUrl() ?? '' }}" class="px-3 py-3 bg-black text-custom-gray text-center rounded-lg hover:bg-custom-gray-light mr-4 {{ $products->appends(request()->input())->previousPageUrl() ? '' : 'cursor-not-allowed opacity-75' }}">Previous page</a>
  				    <span class="text-bg-custom-gray-lighter">{{ $products->appends(request()->input())->currentPage() }}</span>
         			<a href="{{ $products->appends(request()->input())->nextPageUrl() ?? '#' }}" class="ml-4  px-3 py-3 bg-black text-custom-gray text-center rounded-lg hover:bg-custom-gray-light {{ $products->appends(request()->input())->nextPageUrl() ? '' : 'cursor-not-allowed opacity-75' }}">Next page</a>
         		</div>
       		@endif
       </div>
            

    </div>
@endsection
