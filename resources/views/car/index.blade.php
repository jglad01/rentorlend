@extends('layout')

@section('content')
@include('partials._search')

<div id="search-container" class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4 mt-10">

@unless (count($cars) == 0)
    @foreach ($cars as $car)
        <x-car-card :car="$car" />
    @endforeach

@else
    <h3>No cars available</h3>
@endunless

</div>

@endsection