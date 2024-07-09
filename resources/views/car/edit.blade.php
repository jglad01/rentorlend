@extends('layout')

@section('content')
    
<div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Edit car {{ $car->make }} {{ $car->model }}
                        </h2>
                    </header>

                    <form method="POST" action="/otodom_clone/public/cars/{{ $car->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="make" class="inline-block text-lg mb-2">Car make</label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="make" placeholder="Eg. Toyota, BMW, Volvo" value="{{ $car->make }}" />

                            @error('make')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="model" class="inline-block text-lg mb-2">Car model</label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="model" value="{{ $car->model }}" />
                            @error('model')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="production_year" class="inline-block text-lg mb-2">Production year</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="production_year" value="{{ $car->production_year }}" min="1999" max="2024" placeholder="Example: 2014" />
                            @error('production_year')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="mileage" class="inline-block text-lg mb-2">Mileage (in kms, rounded to full thousands)</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="mileage" value="{{ $car->mileage }}" min="0" max="999999" step="1000" placeholder="Example: 118000" />
                            @error('production_year')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="type" class="inline-block text-lg mb-2">Car type</label>
                            <select class="p-2" name="type" id="type">
                                <option value="sedan">Sedan</option>
                                <option value="wagon">Wagon</option>
                                <option value="suv">SUV</option>
                                <option value="compact">Compact</option>
                                <option value="cabrio">Cabrio</option>
                                <option value="coupe">Coupe</option>
                            </select>
                            @error('type')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="location" class="inline-block text-lg mb-2">Location</label>
                            <select class="p-2" name="location" id="location">
                                <option value="Gdansk">Gdansk</option>
                                <option value="Szczecin">Szczecin</option>
                                <option value="Warsaw">Warsaw</option>
                                <option value="Poznan">Poznan</option>
                                <option value="Wroclaw">Wroclaw</option>
                                <option value="Krakow">Krakow</option>
                            </select>
                            @error('location')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="transmission" class="inline-block text-lg mb-2">Transmission type</label>
                            <select class="p-2" name="transmission" id="transmission">
                                <option value="manual">Manual</option>
                                <option value="automatic">Automatic</option>
                            </select>
                            @error('transmission')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="fuel" class="inline-block text-lg mb-2">Fuel type</label>
                            <select class="p-2" name="fuel" id="fuel">
                                <option value="gasoline">Gasoline</option>
                                <option value="diesel">Diesel</option>
                                <option value="hybrid">Hybrid</option>
                                <option value="electric">Electric</option>
                            </select>
                            @error('fuel')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="fuel_usage" class="inline-block text-lg mb-2">Fuel usage (mixed cycle, litres per 100 kms)</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="fuel_usage" value="{{ $car->fuel_usage }}" min="0" max="30" placeholder="Example: 7.5" />
                            @error('fuel_usage')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="price" class="inline-block text-lg mb-2">Price (per one day, in PLN)</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="price" value="{{ $car->price }}" min="0" placeholder="Example: 40" />
                            @error('price')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="photos" class="inline-block text-lg mb-2">
                                Photos
                            </label>
                            <input type="file" class="border border-gray-200 rounded p-2 w-full" name="photos"/>
                            @error('photos')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror

                            <img class="w-48 mb-6 mx-auto mt-3" src="{{ asset('storage/' . $car->photos) }}" alt="" />
                        </div>

                        <div class="mb-6">
                            <button class="bg-slate-600 text-white rounded py-2 px-4 hover:bg-black">
                                Save
                            </button>

                            <a href="/" class="text-black ml-4"> Back </a>
                        </div>
                    </form>
                </div>
@endsection