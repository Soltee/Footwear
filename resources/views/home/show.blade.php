@extends('layouts.app')

@section('content')
    <div class="  px-3 lg:px-12 bg-gray-300">
        
          <div class="relative w-full md:px-12 bg-gray-300 flex flex-col cm:flex-row justify-between ">
            <div class="flex-1 w-full">
                  <img class="h-full rounded-lg object-center object-cover w-full " src="/storage/{{ $products->imageUrl }}" alt="{{ $products->name }}">
              </div>
              <div class="cm:px-6 flex-1 flex flex-col items-center cm:items-start justify-around py-6 md:py-0 ">
                  <h3 class="text-3xl font-bold text-gray-900">{{ $products->name }}</h3>
                  <h5 class="my-4 cm:my-0 text-xl font-bold text-gray-800">$ {{ $products->price }}</h5>

                  <div class="mb-4 ">
                      <input class="px-2 py-2 w-24 text-center rounded-lg" type="number" name="" value="1" min="1" max="{{ $products->qty }}">
                  </div>
                  <add-to-cart :product="{{ $products }}"   /> 
              </div>
              
          </div>


          <recommended :recommended="{{ $recommended }}"></recommended>


    </div>
@endsection
