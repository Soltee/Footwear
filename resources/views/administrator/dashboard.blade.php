@extends('layouts.admin')

@section('content')
     <div class="py-3 md:py-0 px-3 md:px-10">
        <div class="flex flex-row justify-start">
        	<div class="hidden md:block w-48 px-3">
            
	            @include('_partials.nav')

	        </div>
	        <div class="overflow-x-scroll w-500 md:w-auto md:overflow-hidden flex-1 md:px-6">
	        	<div class="flex flex-col">
	        		<h3 class="font-md text-lg text-gray-800 my-2">Dashboard</h3>
	        		<div class="flex flex-row items-center justify-between">
	        			<div class="">
	        				<h4>
	        					<span>Products</span>
	        				</h4>
	        				<div>
	        					{{$products}}
	        				</div>
	        			</div>
	        			<div class="">
	        				<h4>
	        					<span>Customers</span>
	        				</h4>
	        				<div>
	        					{{$customers}}
	        				</div>
	        			</div>
	        			<div class="">
	        				<h4>
	        					<span>Orders</span>
	        				</h4>
	        				<div>
	        					{{$orders}}
	        				</div>
	        			</div>
	        		</div>
	        	</div>

	        	<div>
	        		{!! $chart->container() !!}	        		
	        	</div>

	        </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $chart->script() !!}
@endpush


