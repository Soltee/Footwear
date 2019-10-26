@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-start">
        	<div class="w-40">
            
	            @include('_partials.nav')

	        </div>
	        <div class="flex-1 flex flex-col justify-between">

                <show-customer :customer="{{ $customer->toJson() }}" />
                
	        </div>
	    </div>
    </div>
@endsection
