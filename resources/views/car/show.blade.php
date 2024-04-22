@extends('layout')

@section('content')

            <div>
                <div class="p-6 lg:p-10">
                    <a href="/otodom_clone/public/" class="inline-block text-black my-3">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                    <div class="flex flex-col items-center justify-center text-center">
                        <div class="flex flex-col lg:flex-row justify-center lg:px-8 lg:gap-20">
                            <img class="w-full sm:w-3/5 lg:w-2/5 mb-6 self-center lg:self-auto" src="{{ asset('storage/' . $car->photos) }}" alt="" />
                            <div class="flex flex-col text-center lg:text-left">
                                <div class="text-2xl mb-2">{{ $car->make }} {{ $car->model }} | {{ $car->production_year }}</div>
                                <div class="text-4xl">{{ $car->price }}$/day</div>
                                <div class="text-lg my-4">
                                    <i class="fa-solid fa-location-dot"></i> {{ $car->location }}
                                </div>
                                <x-user-details :user="$owner"/>
                            </div>
                        </div>
                        <div class="border border-steel w-full my-6"></div>
                        <div class="lg:w-2/5">
                            <p class="text-2xl font-bold mb-4 text-left">
                                Car details
                            </p>
                            <div class="text-lg flex flex-col lg:grid lg:auto-cols-fr lg:grid-cols-2 text-left">
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
                        @if (auth()->user() && $car->uid == auth()->user()->id)
                        @else
                            <a href="/otodom_clone/public/reservations/cars/{{ $car->id }}" class="block bg-denim1 text-white mt-6 py-2 px-3 rounded-xl hover:opacity-80"><i class="fa-solid fa-calendar-days"></i>
                                Check availability and reserve this car!
                            </a>
                        @endif
                    </div>
                </div>

                @auth
                    @if ($car->uid == auth()->user()->id)
                        <div class="mt-4 p-2 flex justify-center gap-6">
                            <a href="{{ $car->id }}/edit">
                                <i class="fa-solid fa-pencil"></i>
                                Edit
                            </a>

                            <form class="inline" method="POST" action="/otodom_clone/public/cars/{{ $car->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500"><i class="fa-solid fa-trash mr-1"></i>Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth

                <div class="bg-gray-50 border border-gray-200 p-4 lg:p-10 rounded lg:mx-52 mt-4">
                    <p class="mt-3 mb-5 text-center text-xl">Comments and reviews</p>
                    
                    @unless (count($reviews) == 0)
                        @foreach ($reviews as $review)
                            <x-review :review="$review"/>
                        @endforeach
                    @else
                        <p class="my-3">No comments yet. Be the first one!</p>
                    @endunless

                    @auth
                        @if ($car->uid != auth()->user()->id && !($current_user_review->count()))
                            <div class="border border-gray-200 w-full mb-6"></div>
                            <p class="text-center text-xl">Review this car</p>
                            <span class="mr-4">How did you like this car?</span>
                            <div class="rating-container inline">
                                <i data-rating-value="1" class="fa fa-star rating-star"></i>
                                <i data-rating-value="2" class="fa fa-star rating-star"></i>
                                <i data-rating-value="3" class="fa fa-star rating-star"></i>
                                <i data-rating-value="4" class="fa fa-star rating-star"></i>
                                <i data-rating-value="5" class="fa fa-star rating-star"></i>
                            </div>
                            <form class="rating-submit" method="POST" action="/otodom_clone/public/reviews/cars/{{ $car->id }}">
                                @csrf
                                <input type="hidden" name="rating-value" id="rating-value" value="0">
                                <label for="review-comment">Leave a comment (optional)</label>
                                <textarea name="review-comment" id="review-comment" cols="30" rows="10"></textarea>
                                <button class="block bg-slate-500 mt-2 p-2 text-white rounded-xl hover:opacity-80 inline">Submit</button>
                            </form>
                        @endif
                    @else
                            <p><a href="/otodom_clone/public/login" class="text-slate-600">Sign in</a> to post a review</p>
                    @endauth
                </div>
            </div>

@endsection