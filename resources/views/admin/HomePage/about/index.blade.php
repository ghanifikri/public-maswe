@extends('admin.layouts.app')
@section('title', 'About')

@section('content')
<h1 class="h3 mb-4 text-gray-800">About</h1>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            @foreach ($about as $item)
            <div class="card-header">
                <span class="float-right">
                    <a href="{{ route('change-font.about') }}" class="btn btn-info">Change Font</a>
                    <a href="{{ route('about.edit', $item->id) }}" class="btn btn-success px-5"> Edit</a>
                </span>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <h2 class="{{ $fontTitle->type_fonts }} text-center">{{ $item->title }}</h2>
                        <div class="{{ $fontSubTitle->type_fonts }}">{!! $item->sub_title !!}</div>
                    </div>
                </div>

            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
