@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row py-12">
        <div class="w-full md:w-1/2 hidden md:block">
             <img class="h-full w-full object-cover object-center rounded-lg" src="{{ asset('img/auth.jpg') }}">
        </div>

        <div class="w-full md:w-1/2 md:px-4 md:py-5">

                <div class="font-semibold text-custom-light-black py-3 md:px-6  mb-4">
                    {{ __('Login') }}
                </div>


                    <form class="w-full md:px-6" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="first_name" class="block text-custom-light-black text-sm font-bold mb-2">
                                {{ __('First Name') }}:
                            </label>

                            <input id="first_name" type="text" class="shadow appearance-none border rounded w-full py-3 px-3 text-custom-light-black leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('first_name') ? ' border-red-500' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            @if ($errors->has('first_name'))
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $errors->first('first_name') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="last_name" class="block text-custom-light-black text-sm font-bold mb-2">
                                {{ __('Last Name') }}:
                            </label>

                            <input id="last_name" type="text" class="shadow appearance-none border rounded w-full py-3 px-3 text-custom-light-black leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('last_name') ? ' border-red-500' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                            @if ($errors->has('last_name'))
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $errors->first('last_name') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-custom-light-black text-sm font-bold mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="shadow appearance-none border rounded w-full py-3 px-3 text-custom-light-black leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email') }}" required>

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

                            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-3 px-3 text-custom-light-black leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password') ? ' border-red-500' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password-confirm" class="block text-custom-light-black text-sm font-bold mb-2">
                                {{ __('Confirm Password') }}:
                            </label>

                            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-3 px-3 text-custom-light-black leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required>
                        </div>

                        <div class="flex flex-col w-full items-center">
                            <button type="submit" class="w-full inline-block align-middle text-center select-none border font-bold whitespace-no-wrap py-3 px-4 rounded text-base leading-normal no-underline text-white bg-custom-light-orange hover:opacity-75">
                                {{ __('Register') }}
                            </button>

                            <p class="w-full text-xs text-center text-custom-light-black mt-8 -mb-4">
                                Already have an account?
                                <a class="ttext-custom-light-black hover:opacity-50  no-underline" href="{{ route('login') }}">
                                    Login
                                </a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
