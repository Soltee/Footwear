@extends('layouts.app')

@section('content')
    <div class="flex flex-row  items-center">
        
        <cart-view :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}" sub="{{ $subTotal }}" dis="{{ $discount }}" subAfterdis="{{ $subAfterDis }}" tax="{{ $tax }}" grand="{{ $grandTotal }}"></cart-view>


    </div>
@endsection
