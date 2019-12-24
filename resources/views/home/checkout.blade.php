@extends('layouts.app')

@section('content')
    <div class="flex flex-row  items-center">

        <cart-checkout :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}" sub="{{ $subTotal }}" dis="{{ $discount }}" afterdis="{{ $subAfterDis }}" tax="{{ $tax }}" grand="{{ $grandTotal }}" token="{{ $token }}"></cart-checkout>
            
    </div>
@endsection
@push('scripts')
	
@endpush
