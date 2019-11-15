@extends('layouts.app')

@section('content')

    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="flex-1">
                <div class="flex flex-wrap ">
                    @forelse($products as $product)
                    <div class=" bg-gray text-align p-4">
                        <img style="height: 100px; width:100px; object-fit: cover;" src="/storage/{{ $product->imageUrl }}">
                        
                        <h3>{{ $product->name }}</h3>
                        <h3>$ {{ $product->price }}</h3>
            
                        @auth('customer')
                            
                            
                            <add-to-cart :product="{{ $product }}"   /> 

                        @else

                        @endauth
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
