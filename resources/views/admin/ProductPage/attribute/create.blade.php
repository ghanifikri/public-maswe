@extends('admin.layouts.app')
@section('title', 'Tambah Atribut')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Atribut</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('attribute.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Atribut</label>
                        <input value="{{ old('name') }}" type="text" class="form-control {{$errors->first('name')
                        ? "is-invalid": ""}}" id="name" name="name">
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
