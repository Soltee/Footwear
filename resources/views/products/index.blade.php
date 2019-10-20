@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-start">
        	<div class="w-40">
            
	            @include('_partials.nav')

	        </div>
	        <div class="">
                
                <products-view :products="{{ $products->toJson() }}"></products-view>

	        </div>
	    </div>
    </div>
@endsection


