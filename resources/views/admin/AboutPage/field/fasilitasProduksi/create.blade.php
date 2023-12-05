@extends('admin.layouts.app')
@section('title', 'Add Fasilitas Produksi')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Fasilitas Produksi</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('fasilitasProduksi.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_fasilitas">Nama Fasilitas</label>
                        <input value="{{ old('nama_fasilitas') }}" type="text" class="form-control {{$errors->first('nama_fasilitas')
                        ? "is-invalid": ""}}" id="nama_fasilitas" name="nama_fasilitas">
                        <div class="invalid-feedback">
                            {{$errors->first('nama_fasilitas')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control {{$errors->first('description')
                            ? "is-invalid": ""}}" id="description" rows="5">{{ old('description') }}</textarea>
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
