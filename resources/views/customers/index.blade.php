@extends('layouts.admin')

@section('content')
    <div class="py-3 md:py-0 px-3 md:px-10">
        <div class="flex flex-row justify-start">
        	<div class="hidden md:block w-48 px-3">
            
	            @include('_partials.nav')

	        </div>
	        <div class="overflow-x-scroll w-500 md:w-auto md:overflow-hidden flex-1 md:px-6">
                
                <customers-view></customers-view>


	        </div>
	    </div>
    </div>
@endsection


