@extends('layouts.app')

@section('content')
    <div class="bg-black w-full  px-6  lg:px-12 z-10 flex flex-col md:flex-row items-center content-between py-2">
        <div class="flex flex-col items-left justify-around flex-1 w-full">
            <h1 class="text-3xl md:text-4xl lg:text-5xl text-custom-gray leading-tight font-bold">
                Branded Shoes
                </br >
                <span class="text-custom-red-light">Affordable Price</span>
            </h1>
            <p class="text-md md:text-lg text-custom-gray-lighter mt-6 font-bold">Get branded shoes for your next wear.</p>
            <a href="/shoes" class="w-48 px-4 py-3 text-center mt-6 text-lg text-custom-gray bg-custom-red-darker hover:bg-custom-red-lighter rounded-full">
                Grab Now
            </a>
        </div>
        <div class="relative flex-1 hidden md:inline-flex w-full">
            <img class="w-full bg-cover bg-center " src="{{ asset('/img/hero.svg') }}" alt="Hero Svg">
        </div>
    </div>

    <div class="py-6 md:py-10 w-full bg-gray-300">
        <div class="flex flex-wrap justify-center">
                @forelse($products as $product)
                <div class="p-4 bg-white rounded-lg shadow-lg m-2 w-full cm:w-auto hover:-mt-1 hover:-mr-1">
                    <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                        <h3 class="text-lg font-bold my-2 text-gray-900">{{ $product->name }}</h3>
                        <img class="h-64 w-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                    </a>                    
                    <div class=" my-2 bg-gray-300 shadow-lg rounded-lg flex flex-row justify-between w-full items-center">
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

    <div class="relative w-full md:px-12 bg-gray-300 flex flex-col md:flex-row justify-between items-center h-86 md:h-auto">
        <div class="flex-1 flex flex-col justify-center text-center md:items-left py-6 md:py-0 z-20">
            <h3 class="text-3xl font-bold text-gray-900">Over hundreds of women shoes</h3>
            <p class="text-lg font-bold text-gray-900 mt-8"><span class="opacity-75">Grab now to get</span> <span class="p-2 rounded-lg bg-black text-white ml-6 opacity-100">20% off</span></p>
        </div>
        <div class="absolute inset-0 opacity-50 md:opacity-100  md:static flex-1 mt-8 md:mt-0 w-full">
            <img class="h-86 rounded-lg object-center object-cover w-full " src="{{ asset('/img/women.jpg') }}" alt="Women Shoes">
        </div>
    </div>

    <div class="mt-6 md:mt-0 py-6 md:py-10 w-full bg-gray-300">
        <div class="flex justify-center items-center">
            <span class="text-gray-900 font-bold text-center my-6 ml-4">Featured</span>
        </div>


        <div class="flex flex-wrap justify-center">
                @forelse($featured as $product)
                <div class="p-4 bg-white rounded-lg shadow-lg cursor-pointer m-2 w-full cm:w-auto hover:-mt-1 hover:-mr-1">
                    <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                        <h3 class="text-lg font-bold my-2 text-gray-900">{{ $product->name }}</h3>
                        <img class="h-64 w-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                        
                        
                    </a>
                    <div class=" my-2 bg-gray-300 shadow-lg rounded-lg flex flex-row justify-between w-full items-center">
                            <h5 class="text-xl font-bold text-gray-800">$ {{ $product->price }}</h5>
                            <add-to-cart :product="{{ $product }}"   /> 
                        </div>

                </div>
                @empty
                    
                @endforelse

        </div>
    </div>

    <div class="mb-6 relative w-full overflow-hidden md:px-12 bg-gray-300 flex flex-col md:flex-row justify-between items-center h-64 cursor-pointer">

        <img class="hover:shadow-2xl h-full opacity-75 absolute inset-0 rounded-lg object-center object-cover w-full " src="{{ asset('/img/children.jpg') }}" alt="Women Shoes">
        <div class="flex-1 flex flex-col justify-center text-center md:items-left py-6 md:py-0 z-20">
            <h3 class="text-3xl font-bold text-gray-900"> Shop shoes for children : Boys & Girls </h3>
        </div>
       
    </div>


@endsection
