@extends('admin.layouts.app')
@section('title', 'Add Categories')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Kategori</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori">Category</label>
                        <input type="text" class="form-control {{$errors->first('nama_kategori')
                        ? "is-invalid": ""}}" id="nama_kategori" name="nama_kategori" placeholder="Enter nama kategori">
                        <div class="invalid-feedback">
                            {{$errors->first('nama_kategori')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control {{$errors->first('slug')
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
