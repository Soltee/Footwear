@extends('layouts.app')

@section('extra')
  <style>
   .products{
     display: grid;
     grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
     grid-gap:2rem;
   } 
  </style>
@endsection

@section('content')
    <div class="">
      <div class="z-0  flex flex-col lg:flex-row">
          
          <!-- Categories -->
         <div class=" overflow-x-scroll lg:overflow-x-auto lg:w-48 md:px-3 z-0">
              <ul class="flex flex-row lg:flex-col items-left md:ml-2">
                @forelse($categories as $category)

                  <ul class="mt-2 flex flex-row lg:flex-col items-left ">
                    @forelse($category->subcategories as $subcategory)
                      <a class="mr-3 lg:mr-0 mb-2 px-3 py-3 rounded-lg  hover:font-bold" href="{{ route('shoes', ['id' => $subcategory->id , 'subcategory' => $subcategory->name]) }}">
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
         <div class="flex-1  mt-5">
         		<div class="flex flex-row justify-between">
         			<h4 class="text-lg font-bold mb-3"></h4>
              <span class="">{{ $count }} / {{ $products->total() }}</span>
         		</div>
         		<div class="mt-4  w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
         			@forelse($products as $product)
                  <div class=" rounded-lg  cursor-pointer mb-6 hover:-mt-1  transition-all">
                    <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                        
                        <img class="w-full h-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                    </a>
                    <div class="mt-4  rounded-lg flex flex-row justify-between w-full items-center">

                        <h4 class="text-md font-semibold text-custom-light-black">{{ $product->name }}</h4>                    
                        <h5 class="text-md font-semibold text-custom-light-black">$ {{ $product->price }}</h5>
                    </div>
                     
                    {{-- <add-to-cart :product="{{ $product }}"   />  --}}

                  </div>
  	            @empty 
                  <div class="px-4 py-4 rounded-lg text-white bg-red-600">
                    No products.
                  </div>
  	            @endforelse

         		</div>
  			
  			     @if($count > 2)

         	    <div class="my-8 flex flex-row justify-center items-center ">
                {{ $products->appends(request()->input())->links() }}
                
    				    <a href="{{ $products->appends(request()->input())->previousPageUrl() ?? '' }}" class="px-3 py-3   text-center rounded-lg text-custom-light-black hover:text-black  hover:font-bold{{ $products->appends(request()->input())->previousPageUrl() ? '' : 'cursor-not-allowed opacity-75' }}">Prev</a>
    				    <span class="text-bg-custom-gray-lighter px-4">{{ $products->appends(request()->input())->currentPage() }}</span>
           			<a href="{{ $products->appends(request()->input())->nextPageUrl() ?? '#' }}" class="px-3 py-3   text-center rounded-lg text-custom-light-black hover:text-black hover:font-bold{{ $products->appends(request()->input())->nextPageUrl() ? '' : 'cursor-not-allowed opacity-75' }}">Next</a>
           		</div>
         		@endif
         </div>
            
      </div>
    </div>

@endsection
