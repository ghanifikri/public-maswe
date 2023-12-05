@extends('admin.layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('prod.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input value="{{ old('name') }}" type="text" class="form-control {{$errors->first('name')
                        ? "is-invalid": ""}}" id="name" name="name">
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select_post_status">
                            Kategori
                        </label>
                        <select id="select_post_status" name="kategori" class="custom-select {{$errors->first('kategori') ? "is-invalid": ""}}">
                            <option value="benih"{{ old('kategori') === 'benih' ? 'selected' : NULL}}>benih</option>
                            <option value="konsumsi" {{ old('kategori') === 'konsumsi' ? 'selected' : NULL}}>konsumsi</option>
                            <option value="kolam" {{ old('kategori') === 'kolam' ? 'selected' : NULL}}>kolam</option>
                        </select>
                        <div class="invalid-feedback">
                            {{$errors->first('kategori')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input value="{{ old('price') }}" type="number" class="form-control {{$errors->first('price')
                        ? "is-invalid": ""}}" id="price" name="price">
                        <div class="invalid-feedback">
                            {{$errors->first('price')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <textarea name="summary" class="form-control {{$errors->first('summary')
                            ? "is-invalid": ""}}" id="input_post_content">{{old('summary')}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('summary')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control {{$errors->first('description')
                            ? "is-invalid": ""}}" id="input_description">{{old('description')}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('description')}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
{{-- tiny MCE 5 --}}
<script src="{{ asset('template_admin/vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('template_admin/vendor/tinymce5/tinymce.min.js') }}"></script>
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
            toolbar1: "fullscreen preview",
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
            toolbar1: "fullscreen preview",
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
@endsection
