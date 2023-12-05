@extends('admin.layouts.app')
@section('title', 'detail post')

@section('css')
<style>
    .post-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if (file_exists(public_path($post->thumbnail)))
                <!-- thumbnail:true -->
                <div class="post-tumbnail" style="background-image: url('{{ $post->thumbnail }}');">
                </div>
                @else
                <!-- thumbnail:false -->
                <svg class="img-fluid" width="100%" height="400" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                    <rect width="100%" height="100%" fill="#868e96"></rect>
                    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#dee2e6"
                        dy=".3em" font-size="24">
                        {{ $post->judul }}
                    </text>
                </svg>
                @endif


                <!-- title -->
                <h2 class="my-1 {{ $fontTitle->type_fonts }}">
                    {{ $post->judul }}
                </h2>
                <!-- categories -->
                @foreach ($post->kategori as $item)
                    <span class="badge badge-primary">{{ $item->nama_kategori }}</span>
                @endforeach

                <!-- content -->
                <div class="py-1 {{ $fontSubTitle->type_fonts }}">
                    {!! $post->content !!}
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('post.index') }}" class="btn btn-primary mx-1" role="button">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
