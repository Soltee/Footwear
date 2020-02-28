@extends('layouts.app')

@section('content')
    <div class="  px-6  lg:px-12 flex flex-col lg:flex-row bg-gray-300 mx-auto container">
        
        <!-- Categories -->
       <div class=" overflow-x-scroll lg:w-56 md:px-3 py-3">
            <ul class="flex flex-row lg:flex-col items-left ml-2">
              @forelse($categories as $category)

                <a class="hidden lg:block mt-3 " href="{{ route('shoes', ['id' => $category->id , 'category' => $category->name]) }}" class="text-black hover:opacity-75">
                  <h4 class="text-lg font-bold mb-3 ">{{ $category->name }}</h4>
                </a>

                <ul class="mt-2 flex flex-row lg:flex-col items-left lg:ml-2">
                  @forelse($category->subcategories as $subcategory)
                    <a class="mr-3 lg:mr-0 mb-2 px-3 py-3 rounded-lg bg-white hover:shadow-lg" href="{{ route('shoes', ['id' => $subcategory->id , 'subcategory' => $subcategory->name]) }}">
                        {{ $subcategory->name }}
                    </a>
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
       		<div class="mt-10 flex flex-row container flex-wrap {{ $count > 2 ? '' : '' }}">
       			@forelse($products as $product)
                <div class="p-4 bg-white rounded-lg shadow-lg cursor-pointer m-2 w-full cm:w-auto hover:-mt-1 hover:-mr-21 w-full p-3 md:2/3  lg:1/3 transition-all">
                    <a href="/shoes/{{ $product->id }}/{{$product->slug}}">
                        <h3 class="text-lg font-bold my-2 text-gray-900">{{ $product->name }}</h3>
                        <img class="w-full sm:h-64 sm:w-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">  
                    </a>
                    <div class=" my-2 bg-gray-300 shadow-lg rounded-lg flex flex-row justify-between w-full items-center">
                            <h5 class="text-xl font-bold text-gray-800">$ {{ $product->price }}</h5>
                            <add-to-cart :product="{{ $product }}"   /> 
                        </div>

                </div>
	            @empty 
                <div class="px-4 py-4 rounded-lg text-white bg-red-600">
                  No products in the database.
                </div>
	            @endforelse

       		</div>
			
			     @if($count > 2)
       	    <div class="my-6 flex flex-row justify-center items-center ">
  				    <a href="{{ $products->appends(request()->input())->previousPageUrl() ?? '' }}" class="px-3 py-3 bg-black text-custom-gray text-center rounded-lg hover:bg-custom-gray-light mr-4 {{ $products->appends(request()->input())->previousPageUrl() ? '' : 'cursor-not-allowed opacity-75' }}">Previous page</a>
  				    <span class="text-bg-custom-gray-lighter">{{ $products->appends(request()->input())->currentPage() }}</span>
         			<a href="{{ $products->appends(request()->input())->nextPageUrl() ?? '#' }}" class="ml-4  px-3 py-3 bg-black text-custom-gray text-center rounded-lg hover:bg-custom-gray-light {{ $products->appends(request()->input())->nextPageUrl() ? '' : 'cursor-not-allowed opacity-75' }}">Next page</a>
         		</div>
       		@endif
       </div>
            

    </div>
@endsection
