@extends('layouts.app')

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
          <div class="col-sm-6"><h3 class="mb-0">Product</h3></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
          </div>
        </div>
        <!--end::Row-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-12">
              <!-- /.card-header -->
              <div class="card-body">
                

                
                <div class="card card-info card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header"><div class="card-title">Add Product</div></div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form class="needs-validation" novalidate action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <!--begin::Body-->
                      <div class="card-body">
                          <!--begin::Row-->
                          <div class="row g-3">
                              <!--begin::Col-->
                              <div class="col-md-6">
                                  <label for="category" class="form-label">Category</label>
                                  <select id="category" name="category[]" class="form-control select2" multiple="multiple" data-placeholder="Select categories" style="width: 100%;">

                                      <option value="">Select category</option>
                                      @foreach($categories as $category)
                                          <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                              {{ $category->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('category')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                              <!--end::Col-->
                  
                              <!--begin::Col-->
                              <div class="col-md-6">
                                  <label for="name" class="form-label">Product Name</label>
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                  @error('name')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                              <!--end::Col-->
                
                  
                              <!--begin::Col-->
                              <div class="col-md-6">
                                  <label for="description" class="form-label">Product Description</label>
                                  <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
                                  @error('description')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                              <!--end::Col-->
                  
                              <!--begin::Col-->
                              <div class="col-md-6">
                                  <label for="price" class="form-label">Price</label>
                                  <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                  @error('price')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                              <!--end::Col-->
                  
                              <!--begin::Col-->
                              <div class="col-md-6">
                                  <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                  <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}" required>
                                  @error('stock_quantity')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                              <!--end::Col-->
                  
                              <!--begin::Col-->
                              <div class="col-md-6">
                                  <label for="images" class="form-label">Product Images</label>
                                  <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple required>
                                  @error('images')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                              <!--end::Col-->
                  
                          </div>
                          <!--end::Row-->
                      </div>
                      <!--end::Body-->
                      <!--begin::Footer-->
                      <div class="card-footer">
                          <button class="btn btn-info" type="submit">Submit</button>
                      </div>
                      <!--end::Footer-->
                  </form>
                  
                  
                  
                  </div>
                  <!--end::Form Validation-->
                
    
              </div>
             
            </div>
            <!-- /.card -->
           
            <!-- /.card -->
          </div>
          <!-- /.col -->
       
          <!-- /.col -->
        </div>
        <!--end::Row-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::App Content-->
  </main>

<!-- jQuery (Required for Select2 and other plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- Your Custom JS -->
<script>
    $(document).ready(function() {
        $('.select2').select2(); // Initialize Select2
    });
</script>

@endsection
