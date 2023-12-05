@extends('admin.layouts.app')
@section('title', 'Post')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Data Post</h1>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <form autocomplete="off" action="" method="GET" class="form-inline form-row">
                            <div class="col">
                                <div class="input-group mx-1">
                                    <label class="font-weight-bold mr-2">Status</label>
                                    <select name="status" class="custom-select">
                                        <option value="publish" {{ $statusSelected == "publish" ? "selected" : "" }}>Publish</option>
                                        <option value="draft" {{ $statusSelected == "draft" ? "selected" : "" }}>Draft</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mx-1">
                                    <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control"
                                        placeholder="Search for posts">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <span class="float-right">
                            <a href="{{ route('change-font.titlePost') }}" class="btn btn-info">Change Font</a>
                            <a href="{{ route('post.create') }}" class="btn btn-success" role="button">
                                Add new
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @forelse ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="{{ $fontTitle->type_fonts }}">{{ $post->judul }}</h5>
                        <p class="{{ $fontSubTitle->type_fonts }}">
                            {{ $post->description }}...
                        </p>
                        <div class="float-right">
                            <!-- detail -->
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-primary" role="button">
                                view
                            </a>
                            <!-- edit -->
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-info" role="button">
                                edit
                            </a>
                            <!-- delete -->
                                <button onclick="destroy(this.id)" id="{{$post->id}}" type="submit" class="btn btn-sm btn-danger">
                                    delete
                                </button>
                        </div>
                    </div>
                </div>
                @empty
                    @if (request()->get('keyword'))
                    <p class="text-center">'{{request()->get('keyword')}}' tidak ditemukan</p>
                    @else
                    <p class="text-center">data tidak tersedia</p>
                    @endif

                @endforelse

            </div>
            @if ($posts->hasPages())
                <div class="card-footer">
                        {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    //ajax delete
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
                    url: `post/delete/${id}`,
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
