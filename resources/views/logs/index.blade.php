<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Action Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Admin Action Logs</h1>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Product</th>
                    <th>Admin</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ ucfirst($log->action) }}</td>
                        <td>{{ $log->product->name ?? 'N/A' }}</td>
                        <td>{{ $log->user->name ?? 'Unknown' }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
