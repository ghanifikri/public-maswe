@extends('admin.layouts.app')

@section('title', 'Ubah Hero Gallery')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Hero Gallery</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('galleryHero.update', $titleGallery->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input value="{{old('title')? old('title') : $titleGallery->title}}" type="text" class="form-control {{$errors->first('title')
                    ? "is-invalid": ""}}" id="title" name="title" placeholder="Enter title">
                    <div class="invalid-feedback">
                        {{$errors->first('title')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="sub_title">Sub Title</label>
                    <input value="{{old('sub_title')? old('sub_title') : $titleGallery->sub_title}}" type="text" class="form-control {{$errors->first('sub_title')
                    ? "is-invalid": ""}}" id="sub_title" name="sub_title" placeholder="Enter Sub Title">
                    <div class="invalid-feedback">
                        {{$errors->first('sub_title')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Background</label>
                    <div class="input-group">
                        <input value="{{old('background')? old('background') : asset($titleGallery->background)}}" type="text" id="image_label" class="form-control {{$errors->first('background')
                        ? "is-invalid": ""}}" name="background" aria-label="Image" aria-describedby="button-image">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        {{$errors->first('background')}}
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

</script>
@endsection
