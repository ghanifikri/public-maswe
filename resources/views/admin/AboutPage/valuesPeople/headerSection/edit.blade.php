@extends('admin.layouts.app')
@section('title', 'Edit Header Section')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Section Header</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('headerPeople.update', $headerSection->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_section" value="headerPeople">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input value="{{ old('title') ? old('title') : $headerSection->title }}" type="text" value="{{ old('title') }}" class="form-control {{$errors->first('title')
                        ? "is-invalid": ""}}" id="title" name="title">
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sub_title">Description</label>
                        <textarea class="form-control {{$errors->first('sub_title')
                            ? "is-invalid": ""}}" name="sub_title" id="" rows="5">{{ old('sub_title') ? old('sub_title') : $headerSection->sub_title }}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('sub_title')}}
                        </div>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('headerPeople.index') }}" class="btn btn-outline-info px-4 mr-2">Back</a>
                        <button type="submit" class="btn btn-success px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection