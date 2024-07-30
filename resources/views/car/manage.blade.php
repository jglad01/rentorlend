@extends('layout')

@section('content')

<div class="bg-gray-50 border border-gray-200 p-10 rounded">
    <header>
        <h1 class="text-3xl text-center font-bold mt-6 uppercase">
            Manage your cars
        </h1>
        <p class="text-xl text-center mb-6 text-slate-500"><a href="/cars/add">Add new car</p>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>

            @unless (count($cars) == 0)
            @foreach ($cars as $car)
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="/cars/{{ $car->id }}">
                        {{ $car->make }} {{ $car->model }}
                    </a>
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a
                        href="/cars/{{ $car->id }}/edit"
                        class="text-blue-400 px-6 py-2 rounded-xl"
                        ><i
                            class="fa-solid fa-pen-to-square"
                        ></i>
                        Edit</a
                    >
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                <form method="POST" action="/cars/{{ $car->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
                </form>
                </td>
            </tr>
            @endforeach

            @else
                <h3>You don't have any cars listed.</h3>
            @endunless

        </tbody>
    </table>
</div>

@endsection