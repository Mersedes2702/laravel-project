<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Shopping Cart</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(empty($cart))
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 50px; height: auto;"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ $item['price'] * $item['quantity'] }}</td>
                            <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width: 60px; display: inline;">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </form>
                                <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="/products" class="btn btn-primary">Continue Shopping</a>
    </div>
</body>
</html>
