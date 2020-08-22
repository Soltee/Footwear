@extends('layouts.app')
{{-- <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> --}}
{{-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> --}}
@section('content')

        <div class="w-full relative py-16  flex flex-col  items-center justify-between py-2">
          <div class="flex-1 h-full flex flex-col items-start justify-center  ">
            <h1 class=" leading-tight font-bold text-3xl md:text-6xl text-black opacity-75">
              Thousands of shoes.
            </h1>
            <p class=" text-lg  md:text-2xl  text-custom-light-black mt-2 font-bold">Get branded shoes for your next wear.</p>

            <div class="flex">
                <a href="/shoes" class="w-48 px-6 py-4 text-center mt-12 text-lg text-white bg-custom-light-orange hover:bg-custom-dark-orange rounded-lg">
                    Grab Now
                </a>
            </div>

          </div>

    </div>
    {{-- <div class="w-full relative   md:px-16 pt-16 pb-24 z-10 flex flex-col  items-center justify-between py-2">
          <div class="flex-1 mt-0 h-full flex flex-col items-start justify-center md:pr-12 ">
            <h1 class=" leading-tight font-bold text-3xl md:text-6xl text-black opacity-75">
              Thousands of shoes.
            </h1>
            <p class=" text-lg  md:text-2xl  text-custom-light-black mt-2 font-bold">Get branded shoes for your next wear.</p>
            <a href="/shoes" class="w-48 px-6 py-4 text-center mt-12 text-lg text-white bg-custom-light-orange hover:bg-custom-dark-orange rounded-lg">
                Grab Now
            </a>
          </div>
          <div class="w-64 hidden">
          </div>

        <img class="hero-background absolute top-0 w-full h-94 right-0 opacity-25   object-contain object-center -z-10" src="{{ asset('img/b.jpg') }}" alt="Hero Background">
    </div> --}}

    <div class="mt-16 md:mt-10 py-6 w-full  ">
        <div class="flex  items-center mb-6">
            <span class="text-custom-light-black font-bold text-center  tracking-wider text-lg md:text-xl">RECOMMENDED</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($products as $product)
                <div class="mb-6 p-2 w-full flex flex-col items-start  hover:shadow  transition-all">
                    <a href="shoes/{{ $product->id }}/{{ $product->slug }}">
                        
                        <img class="w-full h-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                    </a>
                    <div class=" my-6  rounded-lg flex flex-row justify-between w-full items-center">

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
            <div class="text-lg font-bold flex flex-col md:flex-row items-center text-custom-light-black mt-8">
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
                        
                        <img class="w-full h-64 rounded-lg object-cover object-center" src="/storage/{{ $product->imageUrl }}">
                    </a>
                    <div class=" my-6  rounded-lg flex flex-row justify-between w-full items-center">

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
