@extends('admin.layouts.app')
@section('title', 'Edit Produk')

@section('css')
<link rel="stylesheet" href="{{ asset('template_admin/vendor/glightbox/css/glightbox.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">Edit Product</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Add Image</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                    aria-controls="nav-contact" aria-selected="false">Add Attribute</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card border-light rounded-0">
                    <div class="card-body">
                        <form autocomplete="off" action="{{ route('prod.update', $product->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input value="{{ old('name') ? old('name') : $product->name }}" type="text" class="form-control {{$errors->first('name')
                        ? "is-invalid": ""}}" id="name" name="name">
                                <div class="invalid-feedback">
                                    {{$errors->first('name')}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select_post_status">
                                    Kategori
                                </label>
                                <select id="select_post_status" name="kategori"
                                    class="custom-select {{$errors->first('kategori') ? "is-invalid": ""}}">
                                    <option value="benih"
                                        {{ old('kategori', $product->kategori) === 'benih' ? 'selected' : NULL}}>benih
                                    </option>
                                    <option value="konsumsi"
                                        {{ old('kategori', $product->kategori) === 'konsumsi' ? 'selected' : NULL}}>
                                        konsumsi</option>
                                    <option value="kolam"
                                        {{ old('kategori', $product->kategori) === 'kolam' ? 'selected' : NULL}}>kolam
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('kategori')}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input value="{{ old('price') ? old('price') : $product->price }}" type="number" class="form-control {{$errors->first('price')
                        ? "is-invalid": ""}}" id="price" name="price">
                                <div class="invalid-feedback">
                                    {{$errors->first('price')}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea name="summary" class="form-control {{$errors->first('summary')
                            ? "is-invalid": ""}}"
                                    id="input_post_content">{{old('summary') ? old('summary') : $product->summary }}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('summary')}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control {{$errors->first('description')
                            ? "is-invalid": ""}}"
                                    id="input_description">{{old('description') ? old('description') : $product->description }}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('description')}}
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('prod.index') }}" class="btn btn-info px-4 mr-2">Back</a>
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card border-light rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        Add Image
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                        <div class="form-group">
                                            <label for="input_post_thumbnail" class="font-weight-bold">
                                                Gallery
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button id="button-image" data-input="input_post_thumbnail"
                                                        class="btn btn-primary" type="button">
                                                        Browse
                                                    </button>
                                                </div>
                                                <input id="image_label" name="image" value="{{ old('image') }}"
                                                    type="text"
                                                    class="form-control {{$errors->first('image') ? "is-invalid": ""}}"
                                                    placeholder="" readonly />
                                                <div class="invalid-feedback">
                                                    {{$errors->first('image')}}
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info col-12 add-image">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        Image
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-image table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Image</th>
                                                    <th>File Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($productImages as $no=>$item)
                                                <tr>
                                                    <td>{{ $no + 1 }}</td>
                                                    @if (file_exists(public_path($item->image)))
                                                    <td><a class="gallery-lightbox" href="{{ $item->image }}"><img
                                                                src="{{ $item->image }}" width="100px" alt=""></a></td>
                                                    @endif
                                                    <td>{{ $item->nama }}</td>
                                                    <td><button data-id="{{$item->id}}"
                                                            class="btn tombol-del btn-sm btn-outline-danger">DELETE</button></td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="card border-light rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        Add Attribute
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="form-group">
                                            <label for="">Select Attribute</label>
                                            <select name="attribute_id" id="attribute_id" class="form-control">
                                                <option value="">-- Select --</option>
                                                @foreach ($attributes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Select Value</label>
                                            <select name="value" id="values_id" class="form-control">
                                                <option value="">-- Select --</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input autocomplete="off" value="{{ old('price') ? old('price') : 0 }}" type="number" class="form-control {{$errors->first('price')
                                    ? "is-invalid": ""}}" id="price_id" name="price">
                                            <div class="invalid-feedback">
                                                {{$errors->first('price')}}
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info col-12 add-attribute">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        Image
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-attribute table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Attribute</th>
                                                    <th>Value</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($productAttributes as $no=>$item)
                                                <tr>
                                                    <td>{{ $no + 1 }}</td>
                                                    <td>{{ $item->attribute->name }}</td>
                                                    <td>{{ $item->value }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td><button onclick="destroy(this.id)" id="{{$item->id}}"
                                                            class="btn btn-sm btn-outline-danger">DELETE</button></td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Data tidak tersedia</td>
                                                </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('template_admin/vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('template_admin/vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="{{ asset('template_admin/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#input_post_content").tinymce({
            relative_urls: false,
            language: "en",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",


            file_picker_callback(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight

                tinymce.activeEditor.windowManager.openUrl({
                    url: '/file-manager/tinymce5',
                    title: 'Laravel File manager',
                    width: x * 0.8,
                    height: y * 0.8,
                    onMessage: (api, message) => {
                        callback(message.content, {
                            text: message.text
                        })
                    }
                })
            }
        });
        $("#input_description").tinymce({
            relative_urls: false,
            language: "en",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",


            file_picker_callback(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight

                tinymce.activeEditor.windowManager.openUrl({
                    url: '/file-manager/tinymce5',
                    title: 'Laravel File manager',
                    width: x * 0.8,
                    height: y * 0.8,
                    onMessage: (api, message) => {
                        callback(message.content, {
                            text: message.text
                        })
                    }
                })
            }
        });
    });

</script>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-image').click(function () {
        var product_id = $('#product_id').val();
        var image = $('#image_label').val();

        $.ajax({
            url: '{{ route('image.store') }}',
            type: 'POST',
            data: {
                product_id: $('#product_id').val(),
                image: $('#image_label').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL!',
                        text: 'DATA BERHASIL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        $(".table-image").load(location.href + ' .table-image'),
                        $("#image_label").val("")
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL!',
                        text: 'DATA GAGAL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        $('#image_label')[0].reset(),
                        $(".table-image").load(location.href + ' .table-image');
                    });
                }
            }
        });
    })

    $('body').on('click', '.tombol-del', function(e) {
        var id = $(this).data('id');
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
                    url: `deleteImage/${id}`,
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
                                $(".table-image").load(location.href + ' .table-image'),
                                $("#image_label").val("")
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                $(".table-image").load(location.href + ' .table-image'),
                                $("#image_label").val("")
                            });
                        }
                    }
                });
            }
        })
        // if (confirm('Yakin mau hapus data ini?') == true) {
        //     var id = $(this).data('id');
        //     $.ajax({
        //         url: 'pegawaiAjax/' + id,
        //         type: 'DELETE',
        //     });
        //     $('#myTable').DataTable().ajax.reload();
        // }
    });
</script>
<script>
    //KETIKA SELECT BOX DENGAN ID province_id DIPILIH
    $('#attribute_id').on('change', function () {
        //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
        //DAN MENGIRIMKAN DATA PROVINCE_ID
        $.ajax({
            url: "{{ url('/api/value') }}",
            type: "GET",
            data: {
                attribute_id: $(this).val()
            },
            success: function (html) {
                //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                $('#values_id').empty()
                //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                $('#values_id').append('<option value="">-- Select --</option>')
                $.each(html.data, function (key, item) {
                    $('#values_id').append('<option value="' + item.value + '">' + item.value +
                        '</option>')
                })
            }
        });
    })
</script>
<script>
    $('.add-attribute').click(function () {
        var product_id = $('#product_id').val();
        var attribute_id = $('#attribute_id').val();
        var value = $('#values_id').val();
        var price = $('#price_id').val();

        $.ajax({
            url: '{{ route('storeAtr.store') }}',
            type: 'POST',
            data: {
                product_id: $('#product_id').val(),
                attribute_id: $('#attribute_id').val(),
                value: $('#values_id').val(),
                price: $('#price_id').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL!',
                        text: 'DATA BERHASIL DI SIMPAN!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        $(".table-attribute").load(location.href + ' .table-attribute');
                        $("#values_id").val("")
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL!',
                        text: 'DATA GAGAL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        $(".table").load(location.href + ' .table');
                    });
                }
            }
        });
    })

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
                    url: `deleteAttribute/${id}`,
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
                                $(".table-attribute").load(location.href + ' .table-attribute')
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                $(".table").load(location.href + ' .table'),
                                $("#image_label").val("")
                            });
                        }
                    }
                });
            }
        })
    }
</script>
@endsection
