<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <h1>Product Listing</h1>
    <a href="/products/create" style="display: inline-block; margin-bottom: 10px; padding: 8px 12px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">
    Add New Product
</a>
    <form method="GET" action="/products">
    <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}">

    <select name="category">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                {{ $category }}
            </option>
        @endforeach
    </select>

    <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
    <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">

    <button type="submit">Filter</button>
</form>
    <ul>
        @foreach ($products as $product)
            <li>
                <strong><a href="/products/{{ $product->id }}">{{ $product->name }}</strong><br>
                Price: ${{ $product->price }}<br>
                Category: {{ $product->category }}<br>
                Stock: {{ $product->stock }}
                <a href="/products/{{ $product->id }}" class="btn btn-info">View</a>
                <a href="/products/{{ $product->id }}/edit">Edit</a>

                <div class="card">
                    <div class="card-body">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                        @endif
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: ${{ $product->price }}</p>

            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline;">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
            <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
            </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
