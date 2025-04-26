@extends('layouts.app')

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
          <div class="col-sm-6"><h3 class="mb-0">Category</h3></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                    <div class="card-header"><div class="card-title">Add Category</div></div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form class="needs-validation" action="{{ route('store-category') }}" method="POST">
                      @csrf
                      <div class="card-body">
                          <div class="row g-3">
                              <div class="col-md-6">
                                  <label for="categoryName" class="form-label">Category name</label>
                                  <input
                                      type="text"
                                      class="form-control"
                                      id="categoryName"
                                      name="name"
                                      placeholder="Enter category name"
                                      required
                                      value="{{ old('name') }}"
                                  />
                                  @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                  
                              <div class="col-md-6">
                                  <label for="categoryDesc" class="form-label">Description</label>
                                  <input
                                      type="text"
                                      class="form-control"
                                      id="categoryDesc"
                                      name="description"
                                      placeholder="Enter description"
                                      value="{{ old('description') }}"
                                  />
                                  @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                          </div>
                      </div>
                  
                      <div class="card-footer">
                          <button class="btn btn-info" type="submit">Submit form</button>
                      </div>
                  </form>
                  
                    <!--end::Form-->
                    <!--begin::JavaScript-->
                   
                    <!--end::JavaScript-->
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
@endsection
