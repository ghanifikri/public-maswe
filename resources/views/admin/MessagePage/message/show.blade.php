@extends('admin.layouts.app')
@section('title', 'Pesan')

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header ">
                <div class="row align-items-center">
                    <div class="col-md-6">Pesan</div>
                    <div class="col-md-6"><a href="{{ route('message.index') }}" class="btn btn-info float-right">Kembali</a></div>
                </div>
            </div>
            <div class="card-body">
                @if($message)
                @if($message->photo)
                <img src="{{$message->photo}}" class="rounded-circle " style="margin-left:44%;">
                @else
                <img src="{{asset('template_admin/img/avatar.png')}}" class="rounded-circle " style="margin-left:44%;">
                @endif
                <div class="py-4">From: <br>
                    Name :{{$message->name}}<br>
                    Email :{{$message->email}}<br>
                </div>
                <hr />
                <h5 class="text-center" style="text-decoration:underline"><strong>Subject :</strong>
                    {{$message->subject}}</h5>
                <p class="py-5">{{$message->message}}</p>

                @endif

            </div>
        </div>
    </div>
</div>

@endsection
