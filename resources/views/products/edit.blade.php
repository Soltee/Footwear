@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-start">
        	<div class="w-40">
            
	            @component('_partials.nav')
					
	            @endcomponent

	        </div>
	        <div class="flex-1 flex flex-row justify-between">
	        	<div class="flex-1 overflow-hidden px-4">

	        		<form method="POST" action="{{ url('/products/'. $products->id . '/update' ) }}" enctype="multipart/form-data">
	        		@csrf
	        		@method('PATCH')

		        		<div class="flex flex-row justify-between items-center mb-3">
		        			<h1 class="m-0 text-lg">Update Products</h1>
		        			<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
	                                {{ __('Save') }}
	                        </button>
		        		</div>
		        		<div class="max-w-lg">
		        			<div class="flex flex-row items-center 	rounded-lg mb-3">
			        			<label for="imageUrl" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md	">Choose</label>
			        			<input type="file" id="imageUrl" name="imageUrl" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
			        		</div>
		        			<div class="flex flex-row items-center 	rounded-lg mb-3">
			        			<label for="name" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md	">Name</label>
			        			<input value="{{ $products->name }}" type="text" id="name" name="name" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
			        		</div>
			        		<div class="flex flex-row items-center 	rounded-lg mb-3">
			        			<label for="price" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md	">Price</label>
			        			<input value="{{ $products->price }}" type="text" id="price" name="price" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
			        		</div>
			        		<div class="flex flex-row items-center 	rounded-lg mb-3">
			        			<label for="qty" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md	">Quantity</label>
			        			<input value="{{ $products->qty }}" type="text" id="qty" name="qty" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
			        		</div>
			        		
				        	<div class="row">
				                <div class="col-md-5 mb-3">
				                  <label for="category">Category</label>
				                  <select class="custom-select d-block w-100" id="category" name="category" required>

				                    <option value="{{ $category->id }}" selected="">{{ $category->name }}</option>
				                    {{ $categories }}
				                    @forelse ($categories as $category)
				                      <option value="{{ $category->id }}">{{ $category->name }}</option>
				                    @empty    

				                      No category added...

				                    @endforelse
				                  </select>
				                  @error('category')
				                    <div class="invalid-feedback border border-red" style="width: 100%;">
				                      {{ $message }}
				                    </div>
				                  @enderror
				                </div>
				              </div>
			        		</div>
							
			        		<div>
			        			<textarea id="description" name="description">
			        				{{ $products->description }}
			        			</textarea>
			        		</div>

			        		<div>
			        			<input value="{{ $products->excerpt }}" type="text" id="excerpt" name="excerpt" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
			        		</div>
			        		<div>
			        			<input value="{{ $products->visible }}" type="checkbox" name="visible" id="visible">
			        		</div>
	        	    </form>

	        	</div>

	        	<div class="w-64">
	        	</div>
	        </div>
        </div>
    </div>
@endsection
