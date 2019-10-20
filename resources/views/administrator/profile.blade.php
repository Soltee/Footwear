@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-start">
        	<div class="w-40">
            
	            @include('_partials.nav')

	        </div>
	        <div class="flex-1 flex flex-row justify-between">
	        	<div class="flex-1 overflow-hidden px-4">
						
	        		<form method="POST" action="{{ route('administrator-update', $administrator->id) }}" enctype="multipart/form-data">
		        		@csrf
		        		@method('PATCH')
		        		<div class="flex flex-row justify-between items-center mb-3">
		        			<h1 class="m-0 text-lg">Profile</h1>
		        			<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
	                                {{ __('Save') }}
	                        </button>
		        		</div>
		        		<div class="w-full">
		        			<div class="flex flex-row items-center 	rounded-lg mb-3">
			        			<label for="avatar" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md	">Choose</label>
			        			<input type="file" id="avatar" name="avatar" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
			        		</div>
		        			<div class="flex flex-row items-center 	rounded-lg mb-3">
			        			<label for="name" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md	">Name</label>
			        			<input type="text" id="name" name="name"  value="{{ $administrator->name }}" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
			        		</div>
			        		<div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="shadow appearance-none border bg-blue-700 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email') ?? $administrator->email }}" required autofocus>

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

                            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-blue-700 focus:outline-none focus:shadow-outline{{ $errors->has('password') ? ' border-red-500' : '' }}" name="password" required>

        
		        		</div>

		        		<div class="flex flex-wrap mb-6">
                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Confirm Password') }}:
                            </label>

                            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required>
                        </div>
		        	</form>
	        	</div>
	        </div>
        </div>
    </div>
@endsection
