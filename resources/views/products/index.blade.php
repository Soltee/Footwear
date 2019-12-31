@extends('layouts.admin')

@section('content')
    <div class="py-3 md:py-6 px-3 md:px-10">
        <div class="flex flex-row justify-start">
        	<div class="hidden md:block w-48 px-3">
            
	            @include('_partials.nav')

	        </div>
	        <div class="overflow-x-scroll w-500 md:w-auto md:overflow-hidden flex-1 md:px-6">
                
                <products-view :products="{{ $products->toJson() }}" shown="{{ $shown }}" total="{{$total}}"></products-view>

	        </div>
	    </div>
    </div>
@endsection


