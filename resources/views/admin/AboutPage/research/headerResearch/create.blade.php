@extends('admin.layouts.app')
@section('title', 'Create Header Section')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Create Section Header</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('headerResearch.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_section" value="research">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{ old('title') }}" class="form-control {{$errors->first('title')
                        ? "is-invalid": ""}}" id="title" name="title">
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Description</label>
                        <textarea class="form-control {{$errors->first('sub_title')
                            ? "is-invalid": ""}}" name="sub_title" id="" rows="5">{{ old('sub_title') }}</textarea>
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