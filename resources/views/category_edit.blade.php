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
                    <div class="card-header"><div class="card-title">Edit Category</div></div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                    <form class="needs-validation" action="{{ route('update-category', $category->id) }}" method="POST">
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
                                      value="{{ old('name', $category->name) }}"
                                  />
                              </div>
                  
                              <div class="col-md-6">
                                  <label for="categoryDesc" class="form-label">Description</label>
                                  <input
                                      type="text"
                                      class="form-control"
                                      id="categoryDesc"
                                      name="description"
                                      placeholder="Enter description"
                                      value="{{ old('description', $category->description) }}"
                                  />
                                 
                              </div>
                              <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                          </div>
                      </div>
                  
                      <div class="card-footer">
                          <button class="btn btn-info" type="submit">Update</button>
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
