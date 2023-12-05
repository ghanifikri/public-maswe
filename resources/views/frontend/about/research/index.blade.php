@extends('frontend.layouts.app')

@section('style')

@endsection

@section('hero')
<section id="hero-history" class="d-flex align-items-center"
    style="background: url('{{ asset($heroSection->background) }}') top left; background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <h1>{{ $heroSection->title }}</h1>
                    <h2>{{ $heroSection->description }}</h2>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section id="about" class="about">
    <div class="container">
        <header class="section-header">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h2>{{ $headerResearch->title }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 content">
                    <p>{{ $headerResearch->sub_title }}</p>
                </div>
            </div>
        </header>
    </div>
</section>
<section class="research" id="research">
    @foreach ($research as $item)
        @if ($item->id % 2 == 0)
        <div class="row tm-section tm-mb-30 align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0 text-center">
                <img src="{{ asset($item->image) }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="p-5">
                    <div class="text-center">
                        <h2>{{ $item->nama_research }}</h2>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row tm-section tm-mb-30 align-items-center tm-col-md-reverse">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="p-5">
                    <div class="text-center">
                        <h2>{{ $item->nama_research }}</h2>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-0 text-center">
                <img src="{{ asset($item->image) }}" alt="Image" class="img-fluid">
            </div>
        </div>
        @endif
    @endforeach
</section>
<div id="image-link" class="image-link">
    <div class="container-fluid px-0">
        <div class="row no-gutters image-link-container">
            @foreach ($linkImage as $item)
            <div class="col-lg-4 col-md-4 image-link-item">
                <a href="{{ $item->route }}">
                    <img src="{{ asset($item->background) }}" class="img-fluid" alt="">
                    <div class="image-link-info">
                        <h2>{!! $item->title_link !!}</h2>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
