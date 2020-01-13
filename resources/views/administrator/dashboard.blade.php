@extends('layouts.admin')

@section('content')
     <div class="py-3 md:py-0 px-3 md:px-10 ">
        <div class="flex flex-row justify-start">
        	<div class="hidden md:block w-48 px-3">
            
	            @include('_partials.nav')

	        </div>
	        <div class="overflow-x-scroll w-500 md:w-auto md:overflow-hidden flex-1 md:px-6 pb-16">
	        	<div class="flex flex-col">
	        		<h3 class="font-md text-lg text-gray-800 my-3">Dashboard</h3>
	        		<div class="w-full flex flex-row items-center justify-between mb-3">
	        			<div class="flex-1 px-3 py-3 rounded-lg bg-green-500 mr-2">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-gray-300">Categories</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$categories}}
	        				</div>
	        			</div>
	        			<div class="flex-1 px-3 py-3 rounded-lg bg-green-500">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-gray-300">Products</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$products}}
	        				</div>
	        			</div>
	        			<div class="ml-2 flex-1 px-3 py-3 rounded-lg bg-green-500">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-gray-300">Customers</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$customers}}
	        				</div>
	        			</div>
	        		</div>
	        		<div class="flex flex-row items-center justify-between mb-3">
	        			<div class="flex-1 px-3 py-3 rounded-lg bg-green-500 mr-2">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-gray-300">Sales</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					${{$sales}}
	        				</div>
	        			</div>
	        			<div class="flex-1 px-3 py-3 rounded-lg bg-green-500">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-gray-300">Orders</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$orders}}
	        				</div>
	        			</div>

	        			<div class="ml-2 flex-1 px-3 py-3 rounded-lg bg-green-500">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-gray-300">Items</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$items}}
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


