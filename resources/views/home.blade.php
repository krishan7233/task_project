<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Listing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-card {
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 30px;
    }
    .product-card .carousel-inner img {
      height: 250px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<!-- Top Bar -->
<div class="container-fluid bg-light p-3 d-flex justify-content-between align-items-center">
  <h2 class="m-0">Products</h2>

  <div>
    @if(auth()->check())
    <!-- User is logged in -->
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
            {{ auth()->user()->name }}
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('user.orders') }}">Orders List</a></li>
            <li>
                <a href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </div>
    @else
    <!-- User is not logged in -->
    <a href="{{ route('login') }}" class="btn btn-outline-primary">Sign In</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
    @endif
  </div>
</div>

<!-- Product Listing -->
<div class="container mt-4">
  <div class="row" id="product-list">
    @foreach($products as $product)

    <!-- Product Item -->
    <div class="col-md-4">
      <div class="product-card card">
        <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            @foreach($product->images as $key=>$image)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image"  class="d-block w-100">
            </div>
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="card-text text-muted">
            @foreach($product->categories as $category)
                <span class="badge bg-secondary">{{ $category->name }}</span>
            @endforeach
          </p>
          <p class="card-text">Price: ₹{{ $product->price }}</p>
          <button class="btn btn-success w-100 order-btn" data-user-logged-in="{{ auth()->check() ? '1' : '0' }}" data-product-id="{{ $product->id }}">Place Order</button>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<!-- Modal for login prompt (Optional) -->
<div id="loginPrompt" class="modal fade" tabindex="-1" aria-labelledby="loginPromptLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginPromptLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please log in to place your order.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Get all the "Place Order" buttons
// const orderButtons = document.querySelectorAll('.order-btn');

// orderButtons.forEach(button => {
//     button.addEventListener('click', function() {
//         // Get the "data-user-logged-in" value from the button
//         var isLoggedIn = this.getAttribute('data-user-logged-in') === '1'; // true if logged in

//         if (isLoggedIn) {
//             // Proceed with the order process, for example, redirecting to the dashboard or order page
//             window.location.href = '{{ route('dashboard') }}'; // Replace with your order placement logic
//         } else {
//             // Show the login prompt modal if not logged in
//             var loginPrompt = new bootstrap.Modal(document.getElementById('loginPrompt'));
//             loginPrompt.show();
//         }
//     });
// });

document.querySelectorAll('.order-btn').forEach(button => {
    button.addEventListener('click', function() {
        const isLoggedIn = this.dataset.userLoggedIn === '1';
        const productId = this.dataset.productId;

        if (!isLoggedIn) {
            const loginPrompt = new bootstrap.Modal(document.getElementById('loginPrompt'));
            loginPrompt.show();
            return;
        }

        fetch(`/place-order/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if(data.success) {
                location.reload(); // reload to reflect stock changes if needed
            }
        })
        .catch(err => {
            alert("Something went wrong!");
            console.error(err);
        });
    });
});

</script>

</body>
</html>
