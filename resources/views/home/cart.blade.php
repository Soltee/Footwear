@extends('layouts.app')

@section('content')
    <div class="flex flex-row  items-center">
        
        <cart-view :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}" sub="{{ $subTotal }}" dis="{{ $discount }}" subafterdis="{{ $subAfterDis }}" taxadded="{{ $tax }}" grand="{{ $grandTotal }}"></cart-view>


    </div>
@endsection
