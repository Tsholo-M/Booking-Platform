@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Manage Users</h1>
    <table class="table-auto w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                <td class="border px-4 py-2">
                    <a href="#" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{route('admin.users.delete',$user->id)}}" method="POST" class="inline-block ml-2">
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
