<select name="category" id="category">
    <option value="">All Categories</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
