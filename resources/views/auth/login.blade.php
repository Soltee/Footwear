@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex flex-col md:flex-row py-12">
        <div class="w-full md:w-1/2 hidden md:block">
             <img class="h-full w-full object-cover object-center rounded-lg" src="{{ asset('img/auth.jpg') }}">
        </div>

        <div class="w-full md:w-1/2 md:px-4 md:py-5">

                <div class="font-semibold text-custom-light-black py-3 md:px-6  mb-4">
                    {{ __('Login') }}
                </div>

                <form class="w-full md:px-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-custom-light-black text-sm font-bold mb-2">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email" class="shadow appearance-none border rounded w-full py-3 w-full px-3 text-custom-light-black leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email') ?? 'customer@example.com'  }}" required autofocus>

                        @if ($errors->has('email'))
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block text-custom-light-black text-sm font-bold mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="shadow appearance-none border rounded w-full py-3 w-full px-3 text-custom-light-black leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password') ? ' border-red-500' : '' }}" name="password" value="password" required>

                        @if ($errors->has('password'))
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    <div class="flex mb-6">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="text-sm text-custom-light-black ml-3" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="flex flex-col w-full items-center">
                        <button type="submit" class="bg-custom-light-orange hover:opacity-75 text-gray-100 font-bold py-3 w-full px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Login') }}
                        </button>

                       

                        @if (Route::has('register'))
                            <p class="w-full text-xs text-center text-custom-light-black mt-8 -mb-4">
                                Don't have an account?
                                <a class="text-custom-light-black hover:opacity-50 no-underline" href="{{ route('register') }}">
                                    Register
                                </a>
                            </p>
                        @endif
                    </div>
                </form>

        </div>
    </div>
@endsection
