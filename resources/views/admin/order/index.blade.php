@extends('admin.layouts.app')
@section('title', 'Order')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('template_admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Order List</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Transaction</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->midtrans_booking_code  }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td class="#">{{ $item->transactionDetails->count() }}</td>
                                    <td>{{ moneyFormat($item->total_price) }}</td>
                                    <td>
                                        @if ($item->payment_status == 'waiting')
                                            <span class="badge badge-warning">{{ $item->payment_status }}</span>
                                        @elseif ($item->payment_status == 'paid')
                                            <span class="badge badge-success">{{ $item->payment_status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('order_show')
                                            <a href="{{ route('order.show', $item->id) }}" class="btn btn-warning px-4">Show</a>
                                        @endcan
                                        @can('order_delete')
                                            <button onclick="destroy(this.id)" id="{{$item->id}}" class="btn btn-danger px-4">Delete</button>
                                        @endcan
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{ asset('template_admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template_admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('template_admin/js/demo/datatables-demo.js') }}"></script>
<script>
    function destroy(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'APAKAH KAMU YAKIN ?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax delete
                jQuery.ajax({
                    url: `order/delete/${id}`,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    }
</script>
@endsection
