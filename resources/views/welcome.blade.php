@extends('layouts.app')

@section('content')
    <div class="pt-8 lg:pt-32 container px-6  lg:px-12 z-10 flex flex-col md:flex-row items-center content-between">
        <div class="flex flex-col items-left justify-around flex-1 w-full">
            <h1 class="text-3xl md:text-4xl lg:text-5xl text-custom-gray leading-tight font-bold">
                Branded Shoes
                </br >
                <span class="text-custom-red-light">Affordable Price</span>
            </h1>
            <p class="text-md md:text-lg text-custom-gray-lighter mt-6 font-bold">Get branded shoes for your next wear.</p>
            <a href="#" class="w-48 px-4 py-3 text-center mt-6 text-lg text-custom-gray bg-custom-red-darker hover:bg-custom-red-lighter rounded-full">
                Grab Now
            </a>
        </div>

        <div class="relative flex-1 md:-mt-8  lg:-mt-16 -z-10 w-full">
            <img class="absolute inset-0 md:-mt-48 lg:-mt-64 bg-cover bg-center " src="{{ asset('/img/hero.svg') }}" alt="Hero Svg">
        </div>
    </div>

    <!-- <welcome-view :products="{{ $products->toJson() }}"></welcome-view> -->
    
    <div class="mt-64">
        {{ Cart::content() }}
    </div>
    <div class="container mx-auto text-black font-bold mt-12">

        <div class="flex flex-row items-center">
        
        @forelse(Cart::content() as $product)

        <div class=" w-full sm:w-1/2 p-3 md:w-1/3 lg:w-1/4 ">
            <div class="flex flex-col bg-white shadow-md rounded-lg">
            <img class="w-full h-64 object-cover object-center rounded-lg" src="storage/{{ $product->imageUrl }}" alt="Product Image">
            <h5>{{ $product->name }}</h5>
            <h5>{{ $product->price }}</h5> 
          </div>
        </div>              
        @empty 
        
    </div>


    @endforelse
        <div class="flex flex-wrap justify-center">
            <div class="flex-1">
                <div class="flex flex-wrap ">
                    @forelse($products as $product)
                    <div class=" bg-gray text-align p-4">
                        <img style="height: 100px; width:100px; object-fit: cover;" src="/storage/{{ $product->imageUrl }}">
                        
                        <h3>{{ $product->name }}</h3>
                        <h3>$ {{ $product->price }}</h3>
                
                        <add-to-cart :product="{{ $product }}"   /> 

                    </div>
                    @empty
                        <div class="alert alert-error">
                            No products in the database.
                        </div>
                    @endforelse;

                </div>

                {{$products->links()}}
            </div>
            
        </div>
    </div>
@endsection
