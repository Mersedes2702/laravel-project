<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Add New Product</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/products" method="POST">
        @csrf
        <label for="ean">EAN:</label>
        <input type="text" name="ean" id="ean" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required><br>

        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image">

        <button type="submit">Add Product</button>
    </form>

    <a href="/products">Back to Product Listing</a>
</body>
</html>
