@extends('layouts.app')

@section('content')
    <div class="flex flex-row  items-center px-3 md:px-12 py-6"> 
        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col w-full">
            <div class="flex items-center mb-6">
                <a href="/dashboard"><h2 class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none {{ Route::currentRouteName() == 'dashboard' ? 'text-blue-500 border-b-2 font-medium border-blue-500' : '' }} ">My Purchases</h2></a>

                <a href="/#"><h2 class="ml-3 ttext-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none {{ Route::currentRouteName() == 'customer-profile' ? 'text-blue-500 border-b-2 font-medium border-blue-500' : '' }}">Profile</h2></a>
            </div>
	        <div class="flex-1 flex flex-col md:flex-row justify-between">
	        	<div class="w-full md:w-64">
	        		<form method="POST" action="{{ route('customer-pic', $customer->id) }}" enctype="multipart/form-data">
		        		@csrf
		        		@method('PATCH')
		        		<div class="flex flex-row justify-between items-center mb-3">
		        			<h1 class="m-0 text-lg text-gray-900 ml-3">Profile Picture</h1>
		        			<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
	                                {{ __('Save Pic') }}
	                        </button>
		        		</div>
			        		<div class="flex flex-row items-center 	rounded-lg mb-3">
					        	<input type="file" id="avatar" name="avatar" class="px-2 py-2 rounded-r-lg  text-white cursor-pointer">
			        			@if($customer->avatar)
			        			<img class="h-24 w-full rounded-lg object-cover object-center" src="/storage/{{ $customer->avatar }}">
			        			@endif
			        		</div>
			        </form>
	        	</div>
	        	<div class="flex-1 overflow-hidden px-4 md:pl-8   ">
						
	        		<form method="POST" action="{{ route('customer-update', $customer->id) }}" enctype="multipart/form-data">
		        		@csrf
		        		@method('PATCH')
		        		<div class="flex flex-row justify-between items-center mb-3">
		        			<h1 class="m-0 text-lg text-gray-900">Profile Info</h1>
		        			<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
	                                {{ __('Save') }}
	                        </button>
		        		</div>
		        		<div class="w-full">

			        	<div class="flex flex-wrap mb-6">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Name') }}:
                            </label>

                            <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('name') ? ' border-red-500' : '' }}" name="name" value="{{ old('name') ?? $customer->name }}" required autofocus>

                            @if ($errors->has('name'))
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email') ?? $customer->email }}" required>

                            @if ($errors->has('email'))
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Password') }}:
                            </label>

                            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password') ? ' border-red-500' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Confirm Password') }}:
                            </label>

                            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required>
                        </div>
                    </div>
		        	</form>
	        	</div>
	        </div>
        </div>
    </div>
@endsection
