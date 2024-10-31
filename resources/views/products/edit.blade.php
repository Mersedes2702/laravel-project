<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Edit Product</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/products/{{ $product->id }}" method="POST">
        @csrf
        @method('PUT')

        <label for="ean">EAN:</label>
        <input type="text" name="ean" id="ean" value="{{ $product->ean }}" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ $product->description }}</textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" value="{{ $product->price }}" required><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="{{ $product->stock }}" required><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="{{ $product->category }}" required><br>

        <button type="submit">Update Product</button>
    </form>

    <a href="/products">Back to Product Listing</a>
</body>
</html>
