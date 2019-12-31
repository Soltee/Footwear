@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-start">
        	<div class="w-48 px-3">
            
	            @include('_partials.nav')

	        </div>
	        <div class="flex-1 px-6">
                
                <products-view :products="{{ $products->toJson() }}" shown="{{ $shown }}" total="{{$total}}"></products-view>

	        </div>
	    </div>
    </div>
@endsection


