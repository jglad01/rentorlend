@extends('layout')

@section('content')

@php
    $curr = request()->session()->get('currency') ?? 'PLN';
    $rate = request()->session()->get('rate') ?? 1;
@endphp

<a href="/otodom_clone/public/" class="inline-block text-black ml-4 mb-4"
                ><i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                    <div class="flex flex-col items-center justify-center text-center">
                        <img class="w-2/5 mr-6 mb-6" src="{{ asset('storage/' . $car->photos) }}" alt="" />

                        <h3 class="text-2xl mb-2">Reservation no. {{ $reservation->id }} of {{ $car->make }} {{ $car->model }}</h3>
                        <div class="text-xl mb-4">{{ $car->production_year }}</div>
                        <div class="text-lg my-4">
                            <i class="fa-solid fa-location-dot"></i> {{ $car->location }}
                        </div>

                        @if (auth()->user()->id == $car_owner->id)
                            <div class="text-lg my-3">
                                Renting user contact details:
                            </div>
                            <p class="text-lg">Email: {{ $reservation->contact_email }}</p>
                            <p class="text-lg">Phone: {{ $reservation->contact_phone }}</p>

                            <p class="text-xl mt-4">Contact user about reservation details!</p>
                        @else
                            <div class="text-lg">
                                Listed for rent by: {{ $car_owner->name }}
                            </div>
                            <div class="text-lg my-4">
                                Car owner contact details:
                            </div>
                            <p>Email: {{ $car_owner->email }}</p>
                        @endif

                        <p class="text-2xl mt-6">Reservation from: {{ $reservation->date_start }} To: {{ $reservation->date_end }}</p>
                        <p class="text-2xl mb-6">Total price: {{ ceil($reservation->total_cost / $rate) }}{{ $curr }}</p>
                        <div class="border border-gray-200 w-full mb-6"></div>
                        <div class="w-2/5">
                            <p class="text-2xl font-bold mb-4 text-left">
                                Car details
                            </p>
                            <div class="text-lg grid auto-cols-fr grid-cols-2 text-left">
                                    <p>Brand: {{ $car->make }}</p>
                                    <p>Model: {{ $car->model }}</p>
                                    <p>Type: {{ $car->type }}</p>
                                    <p>Year: {{ $car->production_year }}</p>
                                    <p>Fuel: {{ $car->fuel }}</p>
                                    <p>Fuel usage (mixed cycle): {{ $car->fuel_usage }}l/100km</p>
                                    <p>Mileage: {{ $car->mileage }}</p>
                                    <p>Transmission: {{ $car->transmission }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection