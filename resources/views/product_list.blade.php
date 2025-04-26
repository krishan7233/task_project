@extends('layouts.app')
@section('content')

     <!--begin::App Main-->
     <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Products</h3></div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Categories</th>
                        <th>Images</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                    </tbody>
                  </table>
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

      <!--end::App Main-->
<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTable Init -->
<script>
   $(document).ready(function() {
        $('#example1').DataTable({
          responsive: true,
          autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: '{{ route('products.data') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'description', name: 'description' },
                { data: 'price', name: 'price' },
                { data: 'stock_quantity', name: 'stock_quantity' },
                { data: 'categories', name: 'categories' },
                { data: 'images', name: 'images' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Handle delete action
        $(document).on('click', '.delete-product', function() {
            var productId = $(this).data('id');
            
            if (confirm("Are you sure you want to delete this product?")) {
                $.ajax({
                    url: '/delete-product/' + productId,
                    method: 'DELETE',
                    data: {
                          _token: '{{ csrf_token() }}'
                      },
                    success: function(response) {
                        alert(response.success);
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            }
        });
    });

 
</script>
@endsection

      