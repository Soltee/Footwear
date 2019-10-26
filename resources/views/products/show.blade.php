@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-start">
        	<div class="w-40">
            
	            @include('_partials.nav')

	        </div>
	        <div class="">
                
                <show-product :products="{{ $products->toJson() }}"></show-product>

	        </div>
	    </div>
    </div>
@endsection


