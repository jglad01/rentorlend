@props(['car', 'curr', 'rate'])

<a href="cars/{{ $car->id }}" class="car-card bg-tab_bg p-6 rounded-lg">
    <div>
        <div class="flex">
            <img class="hidden w-48 mr-6 md:block aspect-video" src="{{ asset('storage/' . $car->photos) }}" alt=""/>
            <div>
                <h3 class="text-2xl">
                    <span>{{ $car->make }} {{ $car->model }}</span>
                    @unless ($car->getAvgCarRating() == 0)
                        <span class="ml-2"><i class="fa fa-star star-checked"></i> {{ $car->getAvgCarRating() }}</span>
                    @endisset
                </h3>
                <div class="text-xl mb-4 md:block hidden">{{ $car->production_year }} | {{ $car->mileage }} km | {{ ucfirst($car->fuel) }}</div>
                <div class="text-2xl my-2 block md:hidden">{{ ceil($car->price / $rate) }}{{ $curr }} / day</div>
                <div class="text-lg mt-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $car->location }}
                </div>
            </div>
            <div class="self-center mr-0 ml-auto hidden md:block">
                <p class="text-2xl lg:text-3xl">{{ ceil($car->price / $rate) }}{{ $curr }} / day</p>
            </div>
        </div>
    </div>
</a>