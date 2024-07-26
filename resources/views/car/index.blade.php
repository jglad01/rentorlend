@extends('layout')

@section('content')
@include('partials._search')

@php
    $curr = request()->session()->get('currency') ?? 'PLN';
    $rate = request()->session()->get('rate') ?? 1;
@endphp

<div id="search-container" class="lg:grid lg:grid-cols-2 gap-4 space-y-4 lg:space-y-0 mx-4 mt-10">

@unless (count($cars) == 0)
    @foreach ($cars as $car)
        <x-car-card :car="$car" :curr="$curr" :rate="$rate" />
    @endforeach

@else
    <h3>No cars available</h3>
@endunless

</div>
<div class="pagination-section mt-16 lg:px-80">
    {{ $cars->links() }}
</div>

@endsection