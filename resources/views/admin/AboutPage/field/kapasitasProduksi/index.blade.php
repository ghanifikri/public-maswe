@extends('admin.layouts.app')
@section('title', 'Kapasitas Produksi')

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('template_admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Data Kapasitas Produksi</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="float-right">
                    <a href="{{ route('change-font.titleCategory') }}" class="btn btn-info">Change Font</a>
                    @if ($kapasitasCount < 1)
                        <a href="{{ route('kapasitasProduksi.create') }}" class="btn btn-success px-4">Tambah</a>
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kapasitasProduksi as $no=>$item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>
                                        <img src="{{ $item->image }}" width="200px" alt="">
                                    </td>
                                    <td class="#">{{ $item->judul }}</td>
                                    <td class="#">{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ route('kapasitasProduksi.edit', $item->id) }}" class="btn btn-warning px-4">Edit</a>
                                        <button onclick="destroy(this.id)" id="{{$item->id}}" class="btn btn-danger px-4">Delete</button>
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
                    url: `kapasitasProduksi/delete/${id}`,
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
