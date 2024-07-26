@extends('layout')

@php
    $curr = request()->session()->get('currency') ?? 'PLN';
    $rate = request()->session()->get('rate') ?? 1;
@endphp

@section('content')

<div class="mt-8 text-center">
    <form action="" class="adv-search-form">
        <input type="hidden" name="search" value="true">

        <div class="flex flex-col lg:flex-row gap-8 lg:justify-center text-center lg:text-left">
            <div>
                <label for="make" class="inline text-lg mb-2 block">Make:</label>
                <select class="p-2 bg-white rounded block m-auto" name="make">
                    <option value="all" selected="selected">All</option>
                    @foreach ($makes_list as $make)
                        <option value="{{ $make->make }}">{{ $make->make }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="type" class="inline text-lg mb-2 block">Type:</label>
                <select class="p-2 bg-white rounded block m-auto" name="type">
                    <option value="all" selected="selected">All</option>
                    <option value="sedan">Sedan</option>
                    <option value="wagon">Wagon</option>
                    <option value="suv">SUV</option>
                    <option value="compact">Compact</option>
                    <option value="cabrio">Cabrio</option>
                    <option value="coupe">Coupe</option>
                </select>
            </div>

            <div>
                <label for="location" class="inline text-lg mb-2 block">Location:</label>
                <select class="p-2 bg-white rounded block m-auto" name="location" id="location">
                    <option value="all" selected="selected">All</option>
                    <option value="Gdansk">Gdansk</option>
                    <option value="Szczecin">Szczecin</option>
                    <option value="Warsaw">Warsaw</option>
                    <option value="Poznan">Poznan</option>
                    <option value="Wroclaw">Wroclaw</option>
                    <option value="Krakow">Krakow</option>
                </select>
            </div>

            <div>
                <label for="transmission" class="inline text-lg mb-2 block">Transmission:</label>
                <select class="p-2 bg-white rounded block m-auto" name="transmission" id="transmission">
                    <option value="all" selected="selected">All</option>
                    <option value="manual">Manual</option>
                    <option value="automatic">Automatic</option>
                </select>
            </div>

            <div>
                <label for="fuel" class="inline text-lg mb-2 block">Fuel:</label>
                <select class="p-2 bg-white rounded block m-auto" name="fuel" id="fuel">
                    <option value="all" selected="selected">All</option>
                    <option value="gasoline">Gasoline</option>
                    <option value="diesel">Diesel</option>
                    <option value="hybrid">Hybrid</option>
                    <option value="electric">Electric</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 lg:justify-center mt-6 text-center lg:text-left">
            @php($years_between = range(1990, date('Y')))

            <div>
                <label for="year_from" class="inline text-lg mb-2 block">Prod. year from:</label>
                <select class="p-2 bg-white rounded block sm:min-w-32 m-auto" name="year_from">
                    <option value="all" selected="selected">All</option>
                    @foreach ($years_between as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="year_to" class="inline text-lg mb-2 block">To:</label>
                <select class="p-2 bg-white rounded block sm:min-w-32 m-auto" name="year_to">
                    <option value="all" selected="selected">All</option>
                    @foreach ($years_between as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date_start" class="text-lg block">Reserv. From:</label>
                <input type="text" id="date_from" class="border block border-gray-200 rounded p-2 w-full sm:w-auto m-auto" name="date_from"/>
            </div>

            <div>
                <label for="date_end" class="text-lg block mb-0">To:</label>
                <input type="text" id="date_to" class="border block border-gray-200 rounded p-2 w-full sm:w-auto m-auto" name="date_to"/>
            </div>
        </div>

        <button type="submit" class="block mx-auto mt-4 h-10 w-20 text-black rounded-lg bg-white hover:bg-gray-100">
            Search
        </button>
    </form>
</div>

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4 my-10">

@unless (count($cars) == 0)
    @foreach ($cars as $car)
        <x-car-card :car="$car" :curr="$curr" :rate="$rate" />
    @endforeach
@else
    @if (request()->search)
        <p>No cars available</p>
    @else
    @endif
@endunless

</div>

@endsection