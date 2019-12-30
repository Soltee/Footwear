@extends('layouts.app')

@section('content')
    <div class="flex flex-row  items-center px-3 md:px-12 py-6"> 
        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col bg-white w-full">

            <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                My Purchases
            </div>

            <div class="w-full">
                 <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                          <th class="px-4 py-3 text-left text-gray-900">Id</th>
                          <th class="px-4 py-3 text-left text-gray-900">Image</th>
                          <th class="px-4 py-3 text-left text-gray-900">Name</th>
                          <th class="px-4 py-3 text-left text-gray-900">Price</th>
                          <th class="px-4 py-3 text-left text-gray-900">Quantity</th>
                          <th class="px-4 py-3 text-left text-gray-900">Total</th>
                          <th class="px-4 py-3 text-left text-gray-900">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchases as $purchase)
                            <tr>
                                <td class="px-3 py-3 mb-2">{{ $purchase->id }}</td>
                                <td class="px-3 py-3 mb-2">
                                    <img class="w-24 h-24 rounded-lg" src="/storage/{{ $purchase->imageUrl }}">
                                </td>
                                <td class="px-3 py-3 mb-2">{{ $purchase->name }}</td>
                                <td class="px-3 py-3 mb-2">{{ $purchase->price }}</td>
                                <td class="px-3 py-3 mb-2">{{ $purchase->quantity }}</td>
                                <td class="px-3 py-3 mb-2">{{ $purchase->price * $purchase->quantity }}</td>
                                <td class="px-3 py-3 mb-2">{{ ($purchase->created_at->diffForHumans()) }}</td>                                
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

                @if(count($purchases) > 1)
                <div class="flex flex-row justify-center items-center">
                    <a href="{{ $purchases->previousPageUrl() }}" class="px-3 py-3 rounded-lg mx-3 text-gray-900">Prev</a>
                    <a href="{{ $purchases->nextPageUrl() }}" class="px-3 py-3 rounded-lg mx-3 text-gray-900">Next</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
