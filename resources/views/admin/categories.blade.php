@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
    <h1>Manage Categories</h1>
    <a href="#" id="add-category-btn">Add New Category</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Category Modal -->
    <div id="add-category-modal" style="display:none;">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <label for="name">Category Name:</label>
            <input type="text" name="name" required>
            <label for="description">Description:</label>
            <textarea name="description"></textarea>
            <button type="submit">Add Category</button>
        </form>
    </div>

    <script>
        const modal = document.getElementById('add-category-modal');
        document.getElementById('add-category-btn').onclick = () => modal.style.display = 'block';
    </script>
@endsection
