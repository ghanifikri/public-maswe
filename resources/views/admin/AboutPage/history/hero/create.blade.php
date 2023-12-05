@extends('admin.layouts.app')
@section('title', 'Section Hero History')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Create Section Hero History</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('heroHistory.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_section" value="history">
                    <input type="hidden" name="route" value="history">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{ old('title') }}" class="form-control {{$errors->first('title')
                        ? "is-invalid": ""}}" id="title" name="title">
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title_link">Title Link</label>
                        <input type="text" value="{{ old('title_link') }}" class="form-control {{$errors->first('title_link')
                        ? "is-invalid": ""}}" id="title_link" name="title_link">
                        <div class="invalid-feedback">
                            {{$errors->first('title_link')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control {{$errors->first('description')
                            ? "is-invalid": ""}}" name="description" id="" rows="5">{{ old('description') }}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('description')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Background</label>
                        <div class="input-group">
                            <input value="{{ old('background') }}" type="text" id="image_label"
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