@extends('layouts.app')

@section('content')

    <div class="mt-32 py-6 w-full  ">
        <div class="flex justify-center items-center mb-6">
            <span class="text-gray-900 font-bold text-center  tracking-wider text-lg md:text-xl my-6 ml-4">RECOMMENDED</span>
        </div>
        <div class="flex flex-wrap justify-center">
                @forelse($products as $product)
                <div class="p-4  m-2 w-full cm:w-auto hover:-mt-1 hover:shadow-lg  transition-all">
                    <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                        <h3 class="text-lg font-bold my-2 text-gray-900">{{ $product->name }}</h3>
                        <img class="h-64 w-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                    </a>                    
                    <div class=" my-2  rounded-lg flex flex-row justify-between w-full items-center">
                        <h5 class="text-xl font-bold text-gray-800">$ {{ $product->price }}</h5>
                        <add-to-cart :product="{{ $product }}"   /> 
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
            <h3 class="text-3xl font-bold text-gray-900">Over hundreds of women shoes</h3>
            <p class="text-lg font-bold text-gray-900 mt-8">
                <a href="/shoes?type=Women">
                    <span class="opacity-75">Grab now to get</span> 
                </a>
                <a href="/shoes?type=Women">
                    <span class="p-2 rounded-lg bg-black text-white ml-6 opacity-100 hover:opacity-75">20% off</span>
                </a>
            </p>
        </div>
        <div class="absolute inset-0 opacity-50 md:opacity-100  md:static flex-1 mt-8 md:mt-0 w-full">
            <img class="h-86 rounded-lg object-center object-cover w-full " src="{{ asset('/img/women.jpg') }}" alt="Women Shoes">
        </div>
    </div>

    <div class="mt-6 md:mt-0 py-6 md:py-10 w-full ">
        <div class="flex justify-center items-center">
            <span class="text-gray-900 font-bold text-center text-lg tracking-wider md:text-xl my-6 ml-4">FEATURED</span>
        </div>


        <div class="flex flex-wrap justify-center">
                @forelse($featured as $product)
                <div class="p-4 rounded-lg hover:shadow-lg cursor-pointer m-2 w-full cm:w-auto hover:-mt-1 transition-all">
                    <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                        <h3 class="text-lg font-bold my-2 text-gray-900">{{ $product->name }}</h3>
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
    </div>

    <div class="relative w-full overflow-hidden md:px-12  flex flex-col md:flex-row justify-between items-center h-64 ">

        <img class="hover:shadow-2xl h-full opacity-50 absolute inset-0  object-center object-cover w-full " src="{{ asset('/img/children.jpg') }}" alt="Women Shoes">
        <div class="flex-1 flex flex-col justify-center text-center md:items-left py-6 md:py-0 z-20">
            <a href="/shoes?type=Children"><h3 class="text-3xl font-bold text-gray-900 cursor-pointer"> Shop shoes for children : Boys & Girls </h3>
            </a>
        </div>
       
    </div>

    <footer-view></footer-view>
@endsection
