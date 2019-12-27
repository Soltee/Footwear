@extends('layouts.app')

@section('content')
    <div class="bg-black w-full pt-8  px-6  lg:px-12 z-10 flex flex-col md:flex-row items-center content-between py-8">
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
        <div class="relative flex-1 hidden md:inline-flex w-full">
            <img class="w-full bg-cover bg-center " src="{{ asset('/img/hero.svg') }}" alt="Hero Svg">
        </div>
    </div>

    <div class="py-6 md:py-10 w-full bg-gray-300">
        <div class="flex flex-wrap justify-center">
                @forelse($products as $product)
                <div class="p-4 bg-white rounded-lg shadow-lg m-2 w-full cm:w-auto">
                    <h3 class="text-lg font-bold my-2 text-gray-900">{{ $product->name }}</h3>
                    <img class="h-64 w-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                    
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
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" class="h-12 w-12"  x="0px" y="0px" viewBox="0 0 512.021 512.021" style="enable-background:new 0 0 512.021 512.021;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M509.736,385.128l-78.4-130.592l-86.656-144.16c-4.544-7.552-14.368-9.984-21.984-5.472l-92.416,55.552
                            c-7.552,4.576-10.016,14.368-5.472,21.952l131.552,219.2c2.912,4.832,8.096,7.776,13.728,7.776h125.92
                            c5.76,0,11.104-3.104,13.952-8.128C512.776,396.264,512.712,390.087,509.736,385.128z M379.176,377.384L379.176,377.384
                            L260.488,179.656l65.024-39.072l142.24,236.8H379.176z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M339.656,385.16l-30.752-51.36c0,0,0,0,0-0.032l-75.488-125.6c-2.176-3.648-5.728-6.272-9.856-7.296
                            c-4.096-1.024-8.48-0.352-12.096,1.824L119.08,258.28c-3.648,2.176-6.336,5.728-7.36,9.856c-1.024,4.128-0.384,8.48,1.792,12.128
                            l72.928,121.376c2.912,4.8,8.128,7.744,13.728,7.744h125.824c5.728,0,11.04-3.104,13.856-8.096
                            C342.696,396.264,342.632,390.087,339.656,385.16z M209.224,377.384l-60.032-99.872l65.056-39.136l83.52,139.008H209.224z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M169.768,385.16l-25.792-42.976l-21.76-36.16c-4.544-7.584-14.336-10.112-21.952-5.472l-92.512,55.52
                            c-7.552,4.544-10.016,14.4-5.472,21.952l14.144,23.584c2.912,4.832,8.096,7.776,13.728,7.776h125.92
                            c5.76,0,11.072-3.104,13.888-8.096C172.808,396.296,172.744,390.12,169.768,385.16z M39.208,377.384l-1.28-2.08l65.12-39.104
                            l24.768,41.184H39.208z"/>
                    </g>
                </g>
             </svg>
            <span class="text-gray-900 font-bold text-center my-6 ml-4">Adidas</span>
        </div>


        <div class="flex flex-wrap justify-center">
                @forelse($adidas as $product)
                <div class="p-4 bg-white rounded-lg shadow-lg cursor-pointer m-2 w-full cm:w-auto hover:-mt-1 hover:-mr-21">
                    <a href="{{ $product->id }}">
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
