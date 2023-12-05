@extends('admin.layouts.app')
@section('title', 'about area')

@section('content')
<h1 class="h3 mb-4 text-gray-800">About Area</h1>
<div class="row">

    <div class="col-12 col-md-6 col-lg-6">
        <img src="{{ $aboutKaligandu->background }}" class="img-fluid" alt="">
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="20%">Title 1</th>
                        <td width="5%">:</td>
                        <td width="75%" class="{{ $fontTitle1->type_fonts }}">{{ $aboutKaligandu->title_one }}</td>
                    </tr>
                    <tr>
                        <th>Title 2</th>
                        <td>:</td>
                        <td class="{{ $fontTitle2->type_fonts }}">{{ $aboutKaligandu->title_two }}</td>
                    </tr>
                    <tr>
                        <th>Title 3</th>
                        <td>:</td>
                        <td class="{{ $fontTitle3->type_fonts }}">{{ $aboutKaligandu->title_three }}</td>
                    </tr>
                    <tr>
                        <th>Title 4</th>
                        <td>:</td>
                        <td class="{{ $fontTitle4->type_fonts }}">{{ $aboutKaligandu->title_four }}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-2">
                        <a href="{{ route('change-font.titleArea') }}" class="btn btn-primary btn-block">Change Font</a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <a href="{{ route('aboutKaligandu.edit', $aboutKaligandu->id) }}" class="btn btn-success btn-block">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection