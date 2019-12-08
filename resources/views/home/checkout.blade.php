@extends('layouts.app')

@section('content')
    <div class="flex flex-row  items-center">
        
        <cart-checkout :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}"  ></cart-checkout>
            

    </div>
@endsection
@push('scripts')
	
@endpush
