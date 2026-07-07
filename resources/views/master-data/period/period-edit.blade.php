@extends('layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Edit Position
    </h1>

    <form action="{{ route('master-data.position-update', $position->id) }}"
        method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Position Name
            </label>

            <input type="text"
                name="name"
                value="{{ $position->name }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Grade
            </label>

            <select name="grade_id"
                class="w-full border rounded-lg px-4 py-2">

                @foreach($grades as $grade)

                <option value="{{ $grade->id }}"
                    {{ $position->grade_id == $grade->id ? 'selected' : '' }}>

                    {{ $grade->name }}

                </option>

                @endforeach

            </select>

        </div>

        <button type="submit"
            class="bg-primary text-white px-4 py-2 rounded-lg">

            Update

        </button>

    </form>

</div>

@endsection