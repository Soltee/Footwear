@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="flex-1">
                <div class="flex flex-wrap ">
                    @forelse($products as $product)
                    <div class=" bg-gray text-align p-4">
                        <img style="height: 100px; width:100px; object-fit: cover;" src="/storage/{{ $product->imageUrl }}">
                        <h3>{{ $product->name }}</h3>
                        <h3>$ {{ $product->price }}</h3>
                        <!-- <span>
                            <button class="btn btn-success">
                            </button>
                        </span> -->
                        @auth('customer')
                            
                                <a href="/add-to-cart/{{ $product->id }}">
                                    <button class="btn btn-primary">
                                        Add To Cart
                                    </button>
                                </a>
                        @endauth
                    </div>
                    @empty
                        <div class="alert alert-error">
                            No products in the database.
                        </div>
                    @endforelse;

                </div>

                {{$products->links()}}
            </div>
            <div class="w-full max-w-sm">
                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                        {{ __('Login') }}
                    </div>

                    <form class="w-full p-6" method="POST" action="{{ route('board-login') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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

                        <div class="flex mb-6">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="text-sm text-gray-700 ml-3" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="flex flex-wrap items-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline ml-auto" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                                    Don't have an account?
                                    <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('register') }}">
                                        Register
                                    </a>
                                </p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
