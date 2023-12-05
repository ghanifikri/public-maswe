@extends('admin.layouts.app')
@section('title','Header Video')

@section('css')
<style>
    .video {
        max-width: 100%;
        height: auto;
        width: 100%
    }

    table {
        margin-bottom: 0px !important;
    }

</style>
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Header Video</h1>
<div class="row">
    @foreach ($headerVideo as $item)
    <div class="col-12 col-md-6 col-lg-6">
        <video autoplay loop muted plays-inline class="video">
            <source src="{{ asset($item->video) }}" type="video/mp4">
        </video>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="20%">Title</th>
                        <td width="5%">:</td>
                        <td width="75%" class="{{ $fontTitle->type_fonts }}">{{ $item->title }}</td>
                    </tr>
                    <tr>
                        <th>Sub Title</th>
                        <td>:</td>
                        <td class="{{ $fontSubTitle->type_fonts }}">{{ $item->sub_title }}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-2">
                        <a href="{{ route('change-font.headerVideo') }}" class="btn btn-primary btn-block">Change Font</a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <a href="{{ route('header-video.edit', $item->id) }}" class="btn btn-success btn-block">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
