@extends('layouts.app')

@section('title' , '- Shop Page')

@section('head')
  <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/mt.min.css') }}">
  <style>

    .slr {
      -webkit-appearance: none;
      height: 10px;
      background: #d3d3d3;
      outline: none;
      opacity: 0.7;
      -webkit-transition: .2s;
      transition: opacity .2s;
    }

    .slr:hover {
      opacity: 1;
    }

    .slr::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 10px;
      height: 10px;
      background: #4CAF50;
      cursor: pointer;
    }

    .slr::-moz-range-thumb {
      width: 10px;
      height: 10px;
      background: #EE6425;
      cursor: pointer;
    }

   .products{
     display: grid;
     grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
     grid-gap:2rem;
   } 

    .check{opacity: 0;}
    .custom_checkbox input:hover + .check{
      opacity: 1;
      color:#EE6425;
    }
    .custom_checkbox input:checked + .check{
      opacity: 1;
      color:#EE6425;
    }
    .custom_checkbox input:checked + .text{
      font-weight: bold;
    }

    .cartBtnParent:hover  .cartBtn{
      opacity: 1;
      visibility: initial;
    }

  


  </style>

@endsection

@section('content')
    <div class="">
      <div class="z-0  flex flex-col lg:flex-row">
          
          <!-- Categories -->
         <div class="w-full lg:w-64 lg:mr-3 md:px-3 z-0">
          <form 
              method="GET">
              @csrf
                <h4 class="mb-3 text-md font-medium text-custom-light-black">
                  <span class="mr-2">Price $</span>
                  <span id="from" class="" >{{ request()->from ?? '0' }}
                  </span>
                  -
                  <span id="to" class="ml-2" >{{ request()->to ?? '0' }}</span>
                </h4>
                <div class="flex flex-col ">
                  <div class="flex flex-row items-center mb-2">
                    <span id="" class=" w-1/3 pr-2 text-sm text-custom-light-orange">
                      From
                    </span>
                    <input  name="from" min="0" max="2000" type="range" value="{{ request()->from ?? '0' }}" class="slr w-2/3" id="myRange">
                  </div>
                  <div class="flex flex-row items-center mb-2">
                    <span id="" class=" w-1/3 pr-2 text-sm text-custom-light-orange">To</span>
                    <input  name="to" min="0" max="2000" type="range" value="{{ request()->to ?? '0' }}" class="slr w-2/3" id="myRange">
                  </div>
                </div>
           
                  
                <div class="mt-3 overflow-x-scroll lg:overflow-x-auto lg:w-full">
      
                  <ul class="flex flex-row lg:flex-col items-left md:ml-2 mb-3">

                    @forelse($categories as $cat)
                      {{-- @if($category)
                        <label  class="custom_checkbox relative flex flex items-center">
                          <div class="flex items-center border">
                            <input class="hidden" class="roleCheckbox border border-custom-light-orange" type="radio"  
                            name="category" value="{{ $cat->id }}" {{ ($cat->id == $category->id) ? 'checked' : '' }}>
                            <svg class="check h-8 w-8 text-blue-900 border border-custom-light-orange rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                          </div>

                          <span  class="text checkbox_btn hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:opacity-75 
                          {{ ($category->id == $cat->id) ? 'text-custom-light-orange font-semibold' : '' }}
                          "
                          >
                            {{ $cat->name }}
                          </span>
                          
                        </label>    
                      @else
                        <label  class="custom_checkbox relative flex flex items-center">

                          <div class="flex items-center border">
                            <input class="hidden" class="roleCheckbox" type="radio"  
                            name="category" value="{{ $cat->id }}">
                            <svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                          </div>

                          <span  class="text checkbox_btn hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold
                          "
                          >
                            {{ $cat->name }}
                          </span>
                          
                        </label>  
                      @endif --}}
                      <ul class="mt-2 flex flex-row lg:flex-col items-left ">
                        @forelse($cat->subcategories as $sub_cat)
                          @if($subcategory)
                            <label  class="custom_checkbox relative flex flex items-center">
                              <div class="flex items-center border">
                                <input class="hidden" class="roleCheckbox" type="radio"  
                                name="subcategory" value="{{ $sub_cat->id }}" {{ ($sub_cat->id == $subcategory->id) ? 'checked' : '' }}>
                                <svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                              </div>

                              <span  class="text checkbox_btn hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:opacity-75 
                              {{ ($subcategory->id == $sub_cat->id) ? 'text-custom-light-orange font-semibold' : '' }}
                              "
                              >
                                {{ $sub_cat->name }}
                              </span>
                              
                            </label>    
                          @else
                            <label  class="custom_checkbox relative flex flex items-center">

                              <div class="flex items-center border">
                                <input class="hidden" class="roleCheckbox" type="radio"  
                                name="subcategory" value="{{ $sub_cat->id }}">
                                <svg class="check h-8 w-8 text-blue-900 border rounded" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                              </div>

                              <span  class="text checkbox_btn hover:text-blue-900 mr-2 px-5 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:font-bold
                              "
                              >
                                {{ $sub_cat->name }}
                              </span>
                              
                            </label>  
                          @endif
                         
                        @empty  
                        @endforelse
                      </ul>              
                    @empty 

                    @endforelse
                  </ul>

                </div>

              <button type="submit" class="mt-4 w-full px-6 py-3 rounded bg-custom-light-orange hover:opacity-75 text-white">Filter</button>
          </form>
         </div>

          <!-- Shoes -->
         <div class="flex-1  lg:mt-0">
            <div class="flex flex-row justify-between mb-3">
              <div class="flex flex-row items-center">
                <a href="/" class=" text-md md:text-lg  text-custom-light-black">Home</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                    <polyline points="13 17 18 12 13 7"></polyline>
                    <polyline points="6 17 11 12 6 7"></polyline>
                </svg>
                <h4 class=" text-md md:text-lg md:text-lg  text-custom-light-black {{ Route::currentRouteName() === 'shoes' ? 'font-bold' : '' }}">Shoes</h4>
                @if($category || $subcategory)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                    <polyline points="13 17 18 12 13 7"></polyline>
                    <polyline points="6 17 11 12 6 7"></polyline>
                </svg>
                @endif
                <h4 class="text-md md:text-lg font-semibold md:font-bold">{{ ($category) ? $category->name : '' }}</h4>

                <h4 class="text-md md:text-lg font-semibold md:font-bold {{  $category ? 'ml-3' : ''}}">{{ ($subcategory) ? $subcategory->name : '' }}</h4>
              </div>
              <span class="">{{ $first }} - {{ $last }} of {{ $total }}</span>
         		</div>
         		<div class="mt-2  w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
         			@forelse($products as $product)
                  <div class=" rounded-lg  cursor-pointer mb-6 hover:-mt-1  transition-all">
                    <div class="cartBtnParent relative" >
                          
                      <a href="shoes/{{ $product->id }}/{{ $product->slug }}">   <img 
                            class="w-full h-64 rounded-t-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}"
                            onerror="this.src='https://via.placeholder.com/300'">
                      </a>

                      <div class="cartBtn absolute inset-0 flex justify-center items-center opacity-0">
                        <add-to-cart :product="{{ $product }}"   /> 
                      </div>

                    </div>
                    <div class="px-3 py-3  rounded-b-lg flex flex-row justify-between bg-gray-400 w-full items-center">

                        <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                          <h4 class="text-md font-semibold text-custom-light-black">{{ $product->name }}</h4>
                        </a>                    
                        <h5 class="text-md font-semibold text-custom-light-black">$ {{ $product->price }}</h5>
                    </div>
                     

                  </div>
  	            @empty 
                  <div class="flex flex-col justify-center items-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 md:h-24 md:w-24 text-red-500">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                    </svg>
                    <p class="text-sm font-semibold text-red-500 mt-4">No Products.</p>
                  </div>
  	            @endforelse

         		</div>
  			
  			     {{-- @if($count > 2) --}}

         	    <div class="my-8 flex flex-row justify-center items-center ">
                
                @if($prev)
    				      <a href="{{ $prev }}" class="px-3 py-3   text-center rounded-lg text-custom-light-black hover:text-black  hover:font-bold">Prev</a>
                @else
                  <span class="px-3 py-3 text-transparent">prev</span>
                @endif

    				    <span class="text-bg-custom-gray-lighter px-4">{{ $current }}</span>

                @if($next)
           			<a href="{{ $next }}" class="px-3 py-3   text-center rounded-lg text-custom-light-black hover:text-black hover:font-bold">Next</a>
                @else
                  <span class="px-3 py-3 text-transparent">Next</span>
                @endif
           		</div>
         		{{-- @endif --}}
         </div>
            
      </div>
    </div>
    {{-- <subscribe />   --}}

@endsection

@push('scripts')
  <script src="{{ asset('/js/mt.min.js') }}"></script>
  <script>
      let slrs = document.querySelectorAll('.slr');
      let from = document.getElementById('from');
      let to = document.getElementById('to');
      slrs.forEach((s) => {

        slrs[0].addEventListener('change', function(e){
          from.innerHTML = e.target.value;
          console.log(e);
        });

        slrs[1].addEventListener('change', function(e){
          to.innerHTML = e.target.value;
          console.log(e);
        });

      });
  </script>
 
@endpush
