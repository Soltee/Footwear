@extends('layouts.app')

@section('content')
    <div class="flex flex-row  items-center">
        
        <cart-view :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}" ></cart-view>


    </div>
@endsection
