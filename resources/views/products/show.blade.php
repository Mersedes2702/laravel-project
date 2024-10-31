<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>{{ $product->name }}</h1>
    <p><strong>EAN:</strong> {{ $product->ean }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Category:</strong> {{ $product->category }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    <div class="card">
    <div class="card-body">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        @endif
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p>Price: ${{ $product->price }}</p>

        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline;">
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
    </div>
</div>
    <a href="/products">Back to Product Listing</a>
</body>
</html>
