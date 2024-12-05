@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        <label for="name">Category Name:</label>
        <input type="text" name="name" value="{{ $category->name }}" required>

        <label for="description">Description:</label>
        <textarea name="description">{{ $category->description }}</textarea>

        <button type="submit">Update Category</button>
    </form>
@endsection
