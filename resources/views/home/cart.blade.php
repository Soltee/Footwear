@extends('layouts.app')

@section('content')
    <div class="">
        
        <cart-view :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}" sub="{{ $subTotal }}" per="{{ $percent }}" dis="{{ $discount }}" subafterdis="{{ $subAfterDis }}" taxadded="{{ $tax }}" grand="{{ $grandTotal }}"></cart-view>


    </div>

@endsection
