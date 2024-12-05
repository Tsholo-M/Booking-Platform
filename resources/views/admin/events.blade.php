@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Manage Events</h1>
    <table class="table-auto w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td class="border px-4 py-2">{{ $event->name }}</td>
                <td class="border px-4 py-2">{{ $event->category->name }}</td>
                <td class="border px-4 py-2">{{ $event->date }}</td>
                <td class="border px-4 py-2">
                    <a href="#" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
