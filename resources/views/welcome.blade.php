@extends('layouts.app')

@section('title', 'Welcome To Foot-wear')
@section('head')
    <meta property="og:title" content="Welcome">
    <meta property="og:description" content="Online shop for shoes and sneakers. Order sneakers, from topbrands like Nike, Adidas, Champion and Carhartt. Huge selection of sport shoes, and sneakers.">

@endsection
@section('content')
    
    <div>

        <div class="w-full relative pt-6 md:pt-2 pb-8   flex flex-col md:flex-row items-center justify-between py-2">
            <div class="w-full md:w-1/2 lg:w-2/3  h-full flex flex-col items-start justify-center  ">
                <h1 class=" leading-tight font-bold text-4xl cm:text-5xl lg:text-6xl text-black opacity-75">
                  Affordable Shoes and Sneakers at your Home.
                </h1>
                <p class=" text-lg  md:text-2xl  text-custom-light-black mt-2 font-bold">Branded shoes for your next wear.</p>

                <div class="flex">
                    <a href="/shoes" class="w-auto md:w-48 px-4 py-3 md:px-6 md:py-4 text-center mt-8 md:mt-12 text-md md:text-lg text-white bg-custom-light-orange hover:opacity-75 rounded-lg">
                        Shop Now
                    </a>
                </div>

              </div>
              <img src="{{ asset('/img/h.jpg') }}" class="hidden md:block object-bottom object-cover h-64 md:h-90 w-full md:w-1/2 lg:w-1/3 mt-4 md:mt-0 opacity-75 rounded transform ">

        </div>


        <div class="mt-10 py-6 w-full  ">
            <div class="flex  items-center mb-6">
                <span class="text-custom-light-black font-bold text-center  tracking-wider text-lg md:text-xl">RECOMMENDED</span>
            </div>
            <div class="mt-2  w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class=" rounded-lg  cursor-pointer mb-6 hover:-mt-1  transition-all">
                    <div class="cartBtnParent relative" >
                          
                      <a href="shoes/{{ $product->id }}/{{ $product->slug }}">   

                        <img 
                            class="w-full h-64 rounded-t-lg object-cover object-center" src="/{{ $product->imageUrl }}"
                            onerror="this.src='/img/placeholder.png'">
                      </a>

                      <div class="cartBtn absolute inset-0 flex justify-center items-center opacity-0">
                        <add-to-cart :product="{{ $product }}"   /> 
                      </div>

                    </div>
                    <div class=" mt-6 mb-3  rounded-lg flex flex-col justify-between w-full">
                        <div class="mb-2 rounded-lg flex flex-row justify-between w-full items-center">

                            <h4 class="text-lg font-bold text-custom-light-black">{{ $product->name }}</h4>                    
                            <h5 class="text-xl font-bold text-custom-light-black">$ {{ $product->price }}</h5>
                        </div>
                        <div class="flex items-center">
                            @for ($i = 1; $i <= $product->average_rating; $i++)
                                    <svg class=" h-6 w-6 text-yellow-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor

                        </div>
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

        </div>

        <div class="relative w-full md:px-12  flex flex-col md:flex-row justify-between items-center h-86 md:h-auto">
            <div class="flex-1 flex flex-col justify-center text-center md:items-left py-6 md:py-0 z-20">
                <h3 class="text-3xl font-bold text-custom-light-black">Over hundreds of women shoes</h3>
                <div class="text-lg font-bold flex flex-col  items-center text-custom-light-black mt-8">
                    <a href="/shoes?type=Women" class="mb-3 md:mb-0">
                        <span class="opacity-75">Use CODE WOMEN20 to get</span> 
                    </a>
                    <a href="/shoes?type=Women" class="px-4 py-3 rounded-lg bg-custom-light-orange  text-white ml-6 opacity-100 hover:opacity-75">
                        20% off
                    </a>
                </div>
            </div>
            <div class="absolute inset-0 opacity-25 md:opacity-100  md:static flex-1 mt-8 md:mt-0 w-full">
                <img class="h-86 rounded-lg object-center object-cover w-full " src="{{ asset('/img/women.jpg') }}" alt="Women Shoes">
            </div>
        </div>

        <div class="mt-12 py-6 w-full  ">
            <div class="flex  items-center mb-6">
                <span class="text-custom-light-black font-bold text-center  tracking-wider text-lg md:text-xl">FEATURED</span>
            </div>

            <div class="mt-2  w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($featured as $product)
                <div class=" rounded-lg  cursor-pointer mb-6 hover:-mt-1  transition-all">
                    <div class="cartBtnParent relative" >
                          
                      <a href="shoes/{{ $product->id }}/{{ $product->slug }}">   

                        <img 
                            class="w-full h-64 rounded-t-lg object-cover object-center" src="/{{ $product->imageUrl }}"
                            onerror="this.src='/img/placeholder.png'">
                      </a>

                      <div class="cartBtn absolute inset-0 flex justify-center items-center opacity-0">
                        <add-to-cart :product="{{ $product }}"   /> 
                      </div>

                    </div>
                    <div class=" mt-6 mb-3  rounded-lg flex flex-col justify-between w-full">
                        <div class="mb-2 rounded-lg flex flex-row justify-between w-full items-center">

                            <h4 class="text-lg font-bold text-custom-light-black">{{ $product->name }}</h4>                    
                            <h5 class="text-xl font-bold text-custom-light-black">$ {{ $product->price }}</h5>
                        </div>
                        <div class="flex items-center">
                            @for ($i = 1; $i <= $product->average_rating; $i++)
                                    <svg class=" h-6 w-6 text-yellow-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor

                        </div>
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
           
        </div>

        <subscribe />  

    </div>


@endsection
