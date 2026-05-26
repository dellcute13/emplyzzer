@extends('layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Edit Department
    </h1>

    <form action="{{ route('master-data.department-update', $department->id) }}"
        method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Department Name
            </label>

            <input type="text"
                name="name"
                value="{{ $department->name }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>
        <button type="submit"
            class="bg-primary text-white px-4 py-2 rounded-lg">

            Update

        </button>

    </form>

</div>

@endsection