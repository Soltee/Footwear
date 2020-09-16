@extends('layouts.admin')

@section('content')
     <div class="py-3 md:py-0 px-3 md:px-10 ">
        <div class="flex flex-row justify-start">
        	<div class="hidden md:block w-48 px-3">
            
	            @include('_partials.nav')

	        </div>
	        <div class="overflow-x-scroll w-500 md:w-auto md:overflow-hidden flex-1 md:px-6 pb-16">
	        	<div class="flex flex-col">
	        		<h3 class="font-bold text-lg text-gray-800 my-6">Dashboard</h3>
	        		<div class="w-full flex flex-row items-center justify-between mb-3">
	        			<div class="flex-1 px-6 py-6 rounded-lg bg-admin-light-green mr-2">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-white">Categories</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$categories}}
	        				</div>
	        			</div>
	        			<div class="flex-1 px-6 py-6 rounded-lg bg-admin-light-green">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-white">Products</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$products}}
	        				</div>
	        			</div>
	        			<div class="ml-2 flex-1 px-6 py-6 rounded-lg bg-admin-light-green">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-white">Customers</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$customers}}
	        				</div>
	        			</div>
	        		</div>
	        		<div class="flex flex-row items-center justify-between mb-3">
	        			<div class="flex-1 px-6 py-6 rounded-lg bg-admin-light-green mr-2">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-white">Sales</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					${{$sales}}
	        				</div>
	        			</div>
	        			<div class="flex-1 px-6 py-6 rounded-lg bg-admin-light-green">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-white">Orders</span>
	        				</h4>
	        				<div class="text-left font-bold text-white">
	        					{{$orders}}
	        				</div>
	        			</div>

	        			<div class="ml-2 flex-1 px-6 py-6 rounded-lg bg-admin-light-green">
	        				<h4 class="text-right pb-2">
	        					<span class="font-semibold text-lg text-white">Order Items</span>
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


