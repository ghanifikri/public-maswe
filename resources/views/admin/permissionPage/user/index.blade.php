@extends('admin.layouts.app')

@section('title','User')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                       <span style="font-size: 20px;font-weight:bold">User</span> 
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('user.create') }}" class="btn btn-primary float-right" role="button">
                            Create
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- list users -->
                    @forelse ($users as $user)
                    <div class="col-md-4">
                        <div class="card my-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <i class="fas fa-id-badge fa-5x"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <table>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <td>:</td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Email
                                                </th>
                                                <td>:</td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Role
                                                </th>
                                                <td>:</td>
                                                <td>
                                                    {{ $user->roles->first()->name }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <!-- edit -->
                                    <a href="{{  route('user.edit', $user->id)  }}" class="btn btn-sm btn-info"
                                        role="button">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <button onclick="destroy(this.id)" id="{{$user->id}}" type="submit"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse
                </div>
            </div>
            <div class="card-footer">
                <!-- Todo:paginate -->
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
                    url: `user/delete/${id}`,
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
