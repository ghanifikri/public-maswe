@extends('admin.layouts.app')

@section('title', 'Tambah Header Video')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Header Video</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('header-video.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control {{$errors->first('title')
                        ? "is-invalid": ""}}" id="title" name="title" placeholder="Enter title">
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Sub Title</label>
                        <input type="text" class="form-control {{$errors->first('sub_title')
                        ? "is-invalid": ""}}" id="sub_title" name="sub_title" placeholder="Enter Sub Title">
                        <div class="invalid-feedback">
                            {{$errors->first('sub_title')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Video</label>
                        <div class="input-group">
                            <input placeholder="url video" value="{{ old('video') }}" type="text" id="image_label"
                                class="form-control {{$errors->first('video')
                            ? "is-invalid": ""}}" name="video" aria-label="Image" aria-describedby="button-image">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    id="button-image">Select</button>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            {{$errors->first('video')}}
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
