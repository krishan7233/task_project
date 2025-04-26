<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Register</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"

    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"

    />

    <link rel="stylesheet" href="{{asset('assets/css/adminlte.css')}}" />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="register-page bg-body-secondary">
    <div class="register-box">
      <div class="register-logo">
          Register
      </div>
      <!-- /.register-logo -->
      <div class="card">
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new member</p>
          <form action="{{ route('register') }}" method="post">
            @csrf

            <div class="input-group mb-3">
              <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" />
              <div class="input-group-text"><span class="bi bi-person"></span></div>
            </div>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror

            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" />
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            <div class="input-group mb-3">
              <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="{{ old('mobile') }}" />
              <div class="input-group-text"><span class="bi bi-phone"></span></div>
          </div>
          @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
      
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password" />
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror

            <!--begin::Row-->
            <div class="row">
              <div class="col-4">
                
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
              </div>
              <div class="col-4">
                
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
         
          <!-- /.social-auth-links -->
          <p class="mb-0">
            <a href="{{route('login')}}" class="text-center"> I already have a member </a>
          </p>
        </div>
     
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
     
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"

    ></script>
    <script src="{{asset('assets/js/adminlte.js')}}"></script>
   
  </body>
  <!--end::Body-->
</html>
