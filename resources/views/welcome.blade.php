@extends('layouts.app')

@section('title', 'Welcome To Foot-wear')
@section('head')
    <meta property="og:title" content="Welcome">
    <meta property="og:description" content="Online shop for shoes and sneakers. Order sneakers, from topbrands like Nike, Adidas, Champion and Carhartt. Huge selection of sport shoes, and sneakers.">

@endsection
@section('content')
    
    <div>
        {{-- <main-categories /> --}}

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
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @forelse($products as $product)
                    <div class="mb-6 w-full flex flex-col items-start  hover:shadow  transition-all">
                        <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                            
                            <img class="w-full rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}" 
                                onerror="this.src='https://via.placeholder.com/300'">
                        </a>
                        <div class=" mt-6 mb-3  rounded-lg flex flex-row justify-between w-full items-center">

                            <h4 class="text-lg font-bold text-custom-light-black">{{ $product->name }}</h4>                    
                            <h5 class="text-xl font-bold text-custom-light-black">$ {{ $product->price }}</h5>
                        </div>
                        

                    </div>
                    @empty
                        <div class="alert alert-error">
                            No products in the database.
                        </div>
                    @endforelse

            </div>
        </div>

        <div class="relative w-full md:px-12  flex flex-col md:flex-row justify-between items-center h-86 md:h-auto">
            <div class="flex-1 flex flex-col justify-center text-center md:items-left py-6 md:py-0 z-20">
                <h3 class="text-3xl font-bold text-custom-light-black">Over hundreds of women shoes</h3>
                <div class="text-lg font-bold flex flex-col  items-center text-custom-light-black mt-8">
                    <a href="/shoes?type=Women" class="mb-3 md:mb-0">
                        <span class="opacity-75">Grab now to get</span> 
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
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @forelse($featured as $product)
                    <div class="mb-6 p-2 w-full flex flex-col items-start  hover:shadow  transition-all">
                        <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                            
                            <img class="w-full rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}" 
                                onerror="this.src='https://via.placeholder.com/300'">
                        </a>
                        <div class=" mt-6 mb-3  rounded-lg flex flex-row justify-between w-full items-center">

                            <h4 class="text-lg font-bold text-custom-light-black">{{ $product->name }}</h4>                    
                            <h5 class="text-xl font-bold text-custom-light-black">$ {{ $product->price }}</h5>
                        </div>
                      
                    </div>
                    @empty
                        <div class="alert alert-error">
                            No products in the database.
                        </div>
                    @endforelse

            </div>
        </div>

        <subscribe />  

    </div>
    {{-- <div class="mt-6 md:mt-0 py-6 md:py-10 w-full ">
        <div class="flex justify-center items-center">
            <span class="text-custom-light-black font-bold text-center text-lg tracking-wider md:text-xl my-6 ml-4">FEATURED</span>
        </div>


        <div class="flex flex-wrap justify-center">
                @forelse($featured as $product)
                <div class="p-4 rounded-lg hover:shadow-lg cursor-pointer m-2 w-full cm:w-auto hover:-mt-1 transition-all">
                    <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                        <h3 class="text-lg font-bold my-2 text-custom-light-black">{{ $product->name }}</h3>
                        <img class="h-64 w-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                        
                        
                    </a>
                    <div class=" my-2   rounded-lg flex flex-row justify-between w-full items-center">
                            <h5 class="text-xl font-bold text-gray-800">$ {{ $product->price }}</h5>
                            <add-to-cart :product="{{ $product }}"   /> 
                        </div>

                </div>
                @empty
                    
                @endforelse

        </div>
    </div> --}}

    {{-- <div class="relative w-full overflow-hidden md:px-12  flex flex-col md:flex-row justify-between items-center h-64 ">

        <img class="hover:shadow-2xl h-full opacity-50 absolute inset-0  object-center object-cover w-full " src="{{ asset('/img/children.jpg') }}" alt="Women Shoes">
        <div class="flex-1 flex flex-col justify-center text-center md:items-left py-6 md:py-0 z-20">
            <a href="/shoes?type=Children"><h3 class="text-3xl font-bold text-custom-light-black cursor-pointer"> Shop shoes for children : Boys & Girls </h3>
            </a>
        </div>
       
    </div> --}}

@endsection
