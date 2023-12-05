@extends('admin.layouts.app')
@section('title', 'Edit History')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit History</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('longHistory.update', $longHistory->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">title</label>
                        <input value="{{ old('title') ? old('title') : $longHistory->title }}" type="text" class="form-control {{$errors->first('title')
                        ? "is-invalid": ""}}" id="title" name="title">
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control {{$errors->first('description')
                            ? "is-invalid": ""}}" id="input_post_content">{{old('description')?old('description'):$longHistory->description}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('description')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_post_thumbnail" class="font-weight-bold">
                            Image
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button id="button-image" data-input="input_post_thumbnail"
                                    class="btn btn-primary" type="button">
                                    Browse
                                </button>
                            </div>
                            <input id="image_label" name="image" value="{{ old('image') ? old('image') : asset($longHistory->image) }}" type="text" class="form-control {{$errors->first('image') ? "is-invalid": ""}}" placeholder="" readonly />
                            <div class="invalid-feedback">
                                {{$errors->first('image')}}
                            </div>
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
            toolbar2: " fullscreen preview | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",


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

</script>
@endsection