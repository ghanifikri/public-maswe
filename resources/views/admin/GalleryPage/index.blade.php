@extends('admin.layouts.app')
@section('title', 'Data Gallery')

@section('css')
<!-- Custom styles for this page -->
<link href="{{ asset('template_admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('template_admin/vendor/glightbox/css/glightbox.min.css') }}">
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Data Gallery</h1>
<div class="row">
    <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                Add Gallery
            </div>
            <div class="card-body">
                <form action="{{ route('dataGallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="input_post_thumbnail" class="font-weight-bold">
                            Gallery
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button id="button-image" data-input="input_post_thumbnail" class="btn btn-primary"
                                    type="button">
                                    Browse
                                </button>
                            </div>
                            <input id="image_label" name="image" value="{{ old('image') }}" type="text"
                                class="form-control {{$errors->first('image') ? "is-invalid": ""}}" placeholder=""
                                readonly />
                            <div class="invalid-feedback">
                                {{$errors->first('image')}}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info col-12">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Gallery</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>File Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallery as $no=>$item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            @if (file_exists(public_path($item->image)))
                            <td><a class="gallery-lightbox" href="{{ $item->image }}"><img src="{{ $item->image }}"
                                        width="100px" alt=""></a></td>
                            @endif
                            <td>{{ $item->nama }}</td>
                            <td><button onclick="destroy(this.id)" id="{{$item->id}}"
                                    class="btn btn-sm btn-outline-danger">DELETE</button></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
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
<script src="{{ asset('template_admin/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script>
    const galleryLightbox = GLightbox({
        selector: '.gallery-lightbox'
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();

            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        });
    });

    // set file link
    function fmSetLink($url) {
        document.getElementById('image_label').value = $url;
    }

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
                    url: `dataResearch/delete/${id}`,
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
