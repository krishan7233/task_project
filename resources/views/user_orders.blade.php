<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">My Orders </h2>
        <a class="btn btn-success" href="{{route('home')}}">Back To Home</a>
        @if($orders->isEmpty())
            <div class="alert alert-info text-center">You have no orders yet.</div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Order No</th>
                        <th>Product</th>
                        <th>Categories</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Ordered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->orderNo }}</td>
                            <td>{{ $order->product->name ?? 'N/A' }}</td>
                            <td>
                                @if($order->product && $order->product->categories)
                                    @foreach($order->product->categories as $category)
                                        <span class="badge bg-primary">{{ $category->name }}</span>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>₹{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @if($order->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
