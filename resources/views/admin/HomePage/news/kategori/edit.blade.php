@extends('admin.layouts.app')
@section('title','edit category')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Kategori</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_kategori">Category</label>
                        <input value="{{old('nama_kategori')? old('nama_kategori') : $category->nama_kategori}}" type="text" class="form-control {{$errors->first('nama_kategori')
                        ? "is-invalid": ""}}" id="nama_kategori" name="nama_kategori" placeholder="Enter nama_kategori">
                        <div class="invalid-feedback">
                            {{$errors->first('nama_kategori')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input value="{{old('slug')? old('slug') : $category->slug}}" type="text" class="form-control {{$errors->first('slug')
                        ? "is-invalid": ""}}" id="slug" name="slug" placeholder="Auto Generate" readonly>
                        <div class="invalid-feedback">
                            {{$errors->first('slug')}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
        function generateSlug(value) {
            return value.trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, '-')
                .replace(/-+/g, '-').replace(/^-|-$/g, "");
        }

        //event: input title
        $('#nama_kategori').change(function(){
            let nama_kategori = $(this).val();
            $('#slug').val(generateSlug(nama_kategori));
        });
    });

</script>
@endsection
