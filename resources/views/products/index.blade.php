@extends('layouts.admin')

@section('content')
    <div class="py-3 md:py-6 px-3 md:px-10">
        <div class="flex flex-row justify-start">
        	<div class="relative hidden md:block w-48 px-3">
            	<div class="fixed">
	            	@include('_partials.nav')            		
            	</div>

	        </div>
	        <div class="w-full md:flex-1 md:ml-48 md:px-6">
                
                <products-view></products-view>
	        </div>
	    </div>
    </div>
@endsection


