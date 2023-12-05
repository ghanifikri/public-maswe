@extends('admin.layouts.app')
@section('title', 'create about Area')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Create About Area</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('aboutKaligandu.update', $aboutKaligandu->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_section" value="aboutKaligandu">
                    <div class="form-group">
                        <label for="title_one">Judul Asal Usul</label>
                        <input value="{{ old('title_one') ? old('title_one') : $aboutKaligandu->title_one }}" type="text" class="form-control {{$errors->first('title_one')
                        ? "is-invalid": ""}}" id="title_one" name="title_one">
                        <div class="invalid-feedback">
                            {{$errors->first('title_one')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title_two">Judul Tempat Kelahiran</label>
                        <input value="{{ old('title_two') ? old('title_two') : $aboutKaligandu->title_two }}" type="text" class="form-control {{$errors->first('title_two')
                        ? "is-invalid": ""}}" id="title_two" name="title_two">
                        <div class="invalid-feedback">
                            {{$errors->first('title_two')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title_three">Judul Sejarah dimulai</label>
                        <input value="{{ old('title_three') ? old('title_three') : $aboutKaligandu->title_three }}" type="text" class="form-control {{$errors->first('title_three')
                        ? "is-invalid": ""}}" id="title_three" name="title_three">
                        <div class="invalid-feedback">
                            {{$errors->first('title_three')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title_four">Judul Sejarah Kita</label>
                        <input value="{{ old('title_four') ? old('title_four') : $aboutKaligandu->title_four }}" type="text" class="form-control {{$errors->first('title_four')
                        ? "is-invalid": ""}}" id="title_four" name="title_four">
                        <div class="invalid-feedback">
                            {{$errors->first('title_four')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="video_url">Url Video dari youtube</label>
                        <input value="{{ old('video_url') ? old('video_url') : $aboutKaligandu->video_url }}" type="text" class="form-control {{$errors->first('video_url')
                        ? "is-invalid": ""}}" id="video_url" name="video_url">
                        <div class="invalid-feedback">
                            {{$errors->first('video_url')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Background</label>
                        <div class="input-group">
                            <input placeholder="Url Background" value="{{ old('background')? old('background') : asset($aboutKaligandu->background) }}" type="text" id="image_label"
                                class="form-control {{$errors->first('background')
                            ? "is-invalid": ""}}" name="background" aria-label="Image" aria-describedby="button-image">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    id="button-image">Select</button>
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

            window.open('/file-manager/fm-button', 'fm', 'width=1000,height=800');
        });
    });

    // set file link
    function fmSetLink($url) {
        document.getElementById('image_label').value = $url;
    }

</script>
@endsection