@extends('layout')

@section('content')

<div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-3xl mx-auto mt-24">
<header class="text-center mb-10">
    <p class="text-xl font-bold uppercase mb-1">
        Reservation for {{ $car->make }} {{ $car->model }}
    </p>
    <img class="w-3/5 mx-auto" src="{{ asset('storage/' . $car->photos) }}" alt="" />
</header>

<form id="reservation-form" method="POST" action="/otodom_clone/public/reservations/cars/{{ $car->id }}" data-car-id="{{ $car->id }}">
    @csrf
    <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2">
            Name
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{ auth()->user()->name ?? '' }}"/>
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

    </div>

    <div class="mb-6">
        <label for="contact_phone" class="inline-block text-lg mb-2">Contact phone number</label>
        <input type="tel" class="border border-gray-200 rounded p-2 w-full" name="contact_phone"/>
        @error('contact_phone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="contact_email" class="inline-block text-lg mb-2">Contact email</label>
        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="contact_email" value="{{ auth()->user()->email ?? '' }}"/>
        @error('contact_email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block text-lg mb-2">Pick reservation dates</label>
        <label for="date_start" class="inline text-lg mb-2">From:</label>
        <input type="text" id="date_start" class="inline border border-gray-200 rounded p-2 w-full sm:w-auto" name="date_start"/>
        <label for="date_end" class="inline text-lg mb-2">To:</label>
        <input type="text" id="date_end" class="inline border border-gray-200 rounded p-2 w-full sm:w-auto" name="date_end"/>
    </div>

    <div class="mb-6 mt-8 text-center">
        <button type="submit" class="bg-slate-600 text-white rounded py-2 px-4 hover:bg-black">
            Confirm reservation
        </button>
    </div>
</form>
</div>

@endsection