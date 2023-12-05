@extends('admin.layouts.app')
@section('title', 'Edit People')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit People</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('people.update', $people->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input value="{{ old('nama') ? old('nama') : $people->nama }}" type="text" class="form-control {{$errors->first('nama')
                        ? "is-invalid": ""}}" id="nama" name="nama">
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input value="{{ old('jabatan') ? old('jabatan') : $people->jabatan }}" type="text" class="form-control {{$errors->first('jabatan')
                        ? "is-invalid": ""}}" id="jabatan" name="jabatan">
                        <div class="invalid-feedback">
                            {{$errors->first('jabatan')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_post_thumbnail" class="font-weight-bold">
                            Image
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button id="button-image" data-input="input_post_thumbnail" class="btn btn-primary"
                                    type="button">
                                    Browse
                                </button>
                            </div>
                            <input id="image_label" name="image" value="{{ old('image') ? old('image') : asset($people->image) }}" type="text"
                                class="form-control {{$errors->first('image') ? "is-invalid": ""}}" placeholder=""
                                readonly />
                            <div class="invalid-feedback">
                                {{$errors->first('image')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input value="{{ old('facebook') ? old('facebook') : $people->facebook }}" type="text" class="form-control {{$errors->first('facebook')
                        ? "is-invalid": ""}}" id="facebook" name="facebook">
                        <div class="invalid-feedback">
                            {{$errors->first('facebook')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gmail">Gmail</label>
                        <input value="{{ old('gmail') ? old('gmail') : $people->gmail }}" type="text" class="form-control {{$errors->first('gmail')
                        ? "is-invalid": ""}}" id="gmail" name="gmail">
                        <div class="invalid-feedback">
                            {{$errors->first('gmail')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input value="{{ old('instagram') ? old('instagram') : $people->instagram }}" type="text" class="form-control {{$errors->first('instagram')
                        ? "is-invalid": ""}}" id="instagram" name="instagram">
                        <div class="invalid-feedback">
                            {{$errors->first('instagram')}}
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
