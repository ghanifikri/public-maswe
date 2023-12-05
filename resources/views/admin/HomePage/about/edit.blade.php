@extends('admin.layouts.app')
@section('title', 'edit about')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah About</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('about.update', $about->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{old('title')? old('title') : $about->title}}" class="form-control {{$errors->first('title')
                        ? "is-invalid": ""}}" id="title" name="title" placeholder="Enter title">
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Sub Title</label>
                        <textarea name="sub_title" class="form-control {{$errors->first('sub_title')
                            ? "is-invalid": ""}}" id="input_post_content">{{old('sub_title')? old('sub_title') : $about->sub_title}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('sub_title')}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Submit</button>
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
    });
</script>
@endsection
