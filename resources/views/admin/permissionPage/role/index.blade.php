@extends('admin.layouts.app')

@section('title','Role')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Role</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('role.create') }}" class="btn btn-primary float-right" role="button">
                            Add new
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <!-- list role -->
                    @forelse ($roles as $role)
                    <li
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                        <label class="mt-auto mb-auto">
                            {{ $role->name }}
                        </label>
                        <div>
                            <!-- detail -->
                            <a href="{{ route('role.show', $role->id) }}" class="btn btn-sm btn-primary" role="button">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- edit -->
                            <a href="{{ route('role.edit', $role->id) }}" class="btn btn-sm btn-info" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- delete -->
                                <button onclick="destroy(this.id)" id="{{$role->id}}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                        </div>
                    </li>
                    @empty
                        <p>
                            <strong>
                                Wewenang Belum Tersedia!
                            </strong>
                        </p>
                    @endforelse


                    <!-- list role -->
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
                    url: `role/delete/${id}`,
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
                                text: 'DATA GAGAL DIHAPUS KARENA SEDANG DIGUNAKAN!',
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
