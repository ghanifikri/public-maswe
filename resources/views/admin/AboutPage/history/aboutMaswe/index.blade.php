@extends('admin.layouts.app')
@section('title', 'About MasWe')

@section('content')
<h1 class="h3 mb-4 text-gray-800">About Maswe</h1>
<div class="row">

    <div class="col-12 col-md-6 col-lg-6">
        <img src="{{ $aboutMaswe->background }}" class="img-fluid" alt="">
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="20%">Title</th>
                        <td width="5%">:</td>
                        <td width="75%" class="{{ $fontTitle->type_fonts }}">{{ $aboutMaswe->title_one }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>:</td>
                        <td class="{{ $fontDescription->type_fonts }}">{{ $aboutMaswe->title_two }}</td>
                    </tr>
                    <tr>
                        <th>Other</th>
                        <td>:</td>
                        <td class="{{ $fontOther->type_fonts }}">{{ $aboutMaswe->title_three }}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-2">
                        <a href="{{ route('change-font.titleAboutMaswe') }}" class="btn btn-primary btn-block">Change Font</a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <a href="{{ route('aboutMaswe.edit', $aboutMaswe->id) }}" class="btn btn-success btn-block">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection