@extends('layout')

@section('content')

@php
    $curr = request()->session()->get('currency') ?? 'PLN';
    $rate = request()->session()->get('rate') ?? 1;
@endphp

<div class="bg-gray-50 border border-gray-200 p-10 rounded">
        <p class="text-2xl text-center font-bold my-6 uppercase">
            Reservations of your cars
        </p>

        <p class="text-md text-center font-bold my-6 uppercase">
            Upcoming
        </p>

    <table class="w-full table-auto rounded-sm">
        @unless (count($my_cars_reservations['upcoming']) == 0)
        <thead>
            <tr>
                <th>Reserved car</th>
                <th>Reserv. from</th>
                <th>Reserv. to</th>
                <th>Reserved at</th>
                <th></th>
            </tr>
        </thead>

        @foreach ($my_cars_reservations['upcoming'] as $reservation)
        @php($current_car = $car::find($reservation->reserved_car_id))
        <tbody>
            <tr class="border-gray-300">
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    <a href="/otodom_clone/public/cars/{{ $current_car->id }}">
                        {{ $current_car->make }} {{ $current_car->model }}
                    </a>
                </td>
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    {{ $reservation->date_start }}
                </td>
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    {{ $reservation->date_end }}
                </td>
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    {{ $reservation->created_at }}
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    <a href="/otodom_clone/public/reservations/{{ $reservation->id }}">
                        Reservation details
                        @foreach ($notifications as $notification)
                            @if ($notification->data['reservation_id'] == $reservation->id)
                                <span class="text-sm py-[4px] px-[2px] bg-red-600 text-white rounded-md ml-1 font-bold">NEW!</span>
                            @endif
                        @endforeach
                    </a>
                </td>
            </tr>
        @endforeach

        @else
            <p class="text-xl text-center">You don't have any upcoming reservations.</p>
        @endunless

        </tbody>
    </table>

    <p class="text-md text-center font-bold my-6 uppercase">
        Previous
    </p>

    <table class="w-full table-auto rounded-sm">
        @unless (count($my_cars_reservations['upcoming']) == 0)
        <thead>
            <tr>
                <th>Reserved car</th>
                <th>Reserv. from</th>
                <th>Reserv. to</th>
                <th>Reserved at</th>
                <th></th>
            </tr>
        </thead>

        @foreach ($my_cars_reservations['previous'] as $reservation)
        @php($current_car = $car::find($reservation->reserved_car_id))
        <tbody>
            <tr class="border-gray-300">
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    <a href="/otodom_clone/public/cars/{{ $current_car->id }}">
                        {{ $current_car->make }} {{ $current_car->model }}
                    </a>
                </td>
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    {{ $reservation->date_start }}
                </td>
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    {{ $reservation->date_end }}
                </td>
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    {{ $reservation->created_at }}
                </td>
                <td
                    class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center"
                >
                    <a href="/otodom_clone/public/reservations/{{ $reservation->id }}">
                        Reservation details
                    </a>
                </td>
            </tr>
        @endforeach

        @else
            <p class="text-xl text-center">You don't have any previous reservations.</p>
        @endunless

        </tbody>
    </table>

    <p class="text-2xl text-center font-bold mb-6 mt-16 uppercase">
        Your reservations
    </p>

    <p class="text-md text-center font-bold my-6 uppercase">
        Upcoming
    </p>

    <table class="w-full table-auto rounded-sm">
        @unless (count($my_reservations) == 0)
        <thead>
            <tr>
                <th>Reserved car</th>
                <th>Reserv. from</th>
                <th>Reserv. to</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>

        @foreach ($my_reservations['upcoming'] as $reservation)
        @php($current_car = $car::find($reservation->reserved_car_id))
        <tbody>
            <tr class="border-gray-300">
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    <a href="/otodom_clone/public/cars/{{ $current_car->id }}">
                        {{ $current_car->make }} {{ $current_car->model }}
                    </a>
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    {{ $reservation->date_start }}
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    {{ $reservation->date_end }}
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    {{ ceil($reservation->total_cost / $rate) }} {{ $curr }}
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    <a href="/otodom_clone/public/reservations/{{ $reservation->id }}">
                        Reservation details
                    </a>
                </td>
            </tr>
        @endforeach

        @else
            <p class="text-xl text-center">You don't have any upcoming reservations.</p>
        @endunless

        </tbody>
    </table>

    <p class="text-md text-center font-bold my-6 uppercase">
        Previous
    </p>

    <table class="w-full table-auto rounded-sm">
        @unless (count($my_reservations) == 0)
        <thead>
            <tr>
                <th>Reserved car</th>
                <th>Reserv. from</th>
                <th>Reserv. to</th>
                <th>Price</th>
                <th></th>
            </tr>
        </thead>

        @foreach ($my_reservations['previous'] as $reservation)
        @php($current_car = $car::find($reservation->reserved_car_id))

        <tbody>
            <tr class="border-gray-300">
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    <a href="/otodom_clone/public/cars/{{ $current_car->id }}">
                        {{ $current_car->make }} {{ $current_car->model }}
                    </a>
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    {{ $reservation->date_start }}
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    {{ $reservation->date_end }}
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    {{ ceil($reservation->total_cost / $rate) }} {{ $curr }}
                </td>
                <td class="px-3 py-6 border-t border-b border-gray-300 text-lg text-center">
                    <a href="/otodom_clone/public/reservations/{{ $reservation->id }}">
                        Reservation details
                    </a>
                </td>
            </tr>
        @endforeach

        @else
            <p class="text-xl text-center">You don't have any previous reservations.</p>
        @endunless

        </tbody>
    </table>
</div>

@endsection