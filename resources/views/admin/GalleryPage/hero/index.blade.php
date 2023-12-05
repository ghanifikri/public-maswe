@extends('admin.layouts.app')
@section('title', 'Title Gallery')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Judul Gallery</h1>
<div class="row">

    <div class="col-12 col-md-6 col-lg-6">
        <img src="{{ $titleGallery->background }}" class="img-fluid" alt="">
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="20%">Title</th>
                        <td width="5%">:</td>
                        <td width="75%" class="">{{ $titleGallery->title }}</td>
                    </tr>
                    <tr>
                        <th>Sub Title</th>
                        <td>:</td>
                        <td class="">{{ $titleGallery->sub_title }}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-2">
                        <a href="" class="btn btn-primary btn-block">Change Font</a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <a href="{{ route('galleryHero.edit', $titleGallery->id) }}" class="btn btn-success btn-block">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
