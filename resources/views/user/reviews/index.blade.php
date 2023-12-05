@extends('user.layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Reviews</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Reviews</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Rate</th>
                                <th>Review</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $no=>$item)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++) @if ($item->rate >= $i)
                                        <small class="fa fa-star" style="color: #f6b024"></small>
                                        @else
                                        <small class="fa fa-star-o" style="color: #f6b024"></small>
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $item->review }}</td>
                                <td>
                                    <a href="{{ route('reviews.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <button onclick="destroy(this.id)" id="{{$item->id}}" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
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
                url: `reviews/delete/${id}`,
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
