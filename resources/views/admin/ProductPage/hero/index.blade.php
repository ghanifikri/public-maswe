@extends('admin.layouts.app')
@section('title', 'Hero Produk')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Hero Produk</h1>
<div class="row">

    <div class="col-12 col-md-6 col-lg-6">
        <img src="{{ $titleProduct->background }}" class="img-fluid" alt="">
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="20%">Title</th>
                        <td width="5%">:</td>
                        <td width="75%" class="">{{ $titleProduct->title }}</td>
                    </tr>
                    <tr>
                        <th>Sub Title</th>
                        <td>:</td>
                        <td class="">{{ $titleProduct->sub_title }}</td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mb-2">
                        <a href="" class="btn btn-primary btn-block">Change Font</a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <a href="{{ route('productHero.edit', $titleProduct->id) }}" class="btn btn-success btn-block">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
