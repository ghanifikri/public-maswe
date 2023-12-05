@extends('admin.layouts.app')
@section('title', 'Title News')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Judul Berita</h1>
<div class="row">

    <div class="col-12 col-md-6 col-lg-6">
        <img src="{{ $titleNews->background }}" class="img-fluid" alt="">
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="20%">Title</th>
                        <td width="5%">:</td>
                        <td width="75%" class="{{ $fontTitle->type_fonts }}">{{ $titleNews->title }}</td>
                    </tr>
                    <tr>
                        <th>Sub Title</th>
                        <td>:</td>
                        <td class="{{ $fontSubTitle->type_fonts }}">{{ $titleNews->sub_title }}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-2">
                        <a href="{{ route('change-font.titleNews') }}" class="btn btn-primary btn-block">Change Font</a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <a href="{{ route('title.edit', $titleNews->id) }}" class="btn btn-success btn-block">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
