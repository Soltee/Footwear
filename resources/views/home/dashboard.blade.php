@extends('layouts.app')

@section('title' , '- My Dashboard')

@section('content')
    <div class="flex flex-row  items-center "> 
        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col bg-white w-full">

            <div class="w-full">

                <div class="" >
                    <div class="flex items-center mb-6">
                        <a href="/dashboard" class="px-2 py-3 rounded block hover:opacity-50 relative flex justify-between items-center {{ Route::currentRouteName() == 'dashboard' ? 'border font-medium border-custom-light-orange text-custom-light-orange' : 'text-custom-light-orange rounded' }} ">
                            <h2 class="  focus:outline-none ">My Orders</h2>
                            <span class="ml-2 text-custom-light-orange">( {{ $new}} )</span>
                        </a>

                        <a href="/customer-profile"><h2 class="  px-2 py-3 rounded block hover:opacity-50 focus:outline-none">Profile</h2></a>
                    </div>
                    
                    
                    <div  class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div  class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                                            User
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                                            Qty
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                                            Total
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-custom-light-black uppercase tracking-wider">
                                            Created at
                                        </th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $item)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full"
                                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                        alt="" />
                                                </div>
                                                
                                            </div>
                                        </td>
                                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $item->name }}</p>
                                        </td>
                                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">$ {{ $item->price }}</p>
                                        </td>
                                         <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $item->quantity }}</p>
                                        </td>
                                         <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">$ {{ $item->price  *  $item->quantity}}</p>
                                        </td>
                                        <td class="px-5 whitespace-no-wrap py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ ($item->created_at->diffForHumans()) }}
                                            </p>
                                        </td>
                                    </tr>
                                            
                                    @empty
                                        <tr>
                                            <td class="px-4 py-3 text-red-600">
                                                Sorry! You haven't made any purchases;
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div
                                class="px-5  py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                                <span class="text-xs xs:text-sm text-gray-900">
                                    Showing {{ $first }} to {{ $last }} of {{$total}} Entries
                                </span>
                                <div class="inline-flex mt-2 xs:mt-0">
                                    @if($has_previous)
                                        <a href="{{ $has_previous }}">
                                            <button
                                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                            Prev
                                            </button>
                                        </a>
                                        @endif
                                    @if($has_next)
                                        <a href="{{ $has_next }}">
                                            <button
                                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                                Next
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
@endsection
