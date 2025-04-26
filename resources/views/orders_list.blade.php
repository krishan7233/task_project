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
            <div class="col-sm-6"><h3 class="mb-0">Orders</h3></div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                        <th>ID</th>
                        <th>Order No</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Username</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
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
  // $(function () {
  //   $('#example1').DataTable({
  //     responsive: true,
  //     autoWidth: false,
  //   });
  // });

  $(function () {
  $('#example1').DataTable({
    responsive: true,
    autoWidth: false,
    processing: true,
    serverSide: true,
    ajax: '{{ route('orders.data') }}',
    columns: [
      { data: 'id', name: 'id' },
      { data: 'orderNo', name: 'orderNo' },
      { data: 'product_name', name: 'product_name' },
      { data: 'category_name', name: 'category_name' },
      { data: 'username', name: 'username' },
      { data: 'total_amount', name: 'total_amount' },
      { data: 'status', name: 'status' },
      { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
});


// Handle status update click
$(document).on('click', '.update-status', function () {
        var orderId = $(this).data('order-id');

        // Make AJAX request to update order status
        $.ajax({
            url: '/admin/orders/' + orderId + '/status',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                alert(response.message);
                if (response.success) {
                    // Reload DataTable after status update
                    $('#example1').DataTable().ajax.reload();
                }
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    });
</script>
@endsection

      