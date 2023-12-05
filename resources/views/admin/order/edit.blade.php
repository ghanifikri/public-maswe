@extends('admin.layouts.app')

@section('title','Edit Status Order')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('order.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Order Status</label>
                    <select name="order_status" class="form-control" id="">
                        <option value="n"{{ $order->order_status == 'n' ? 'selected' : NULL }}>Unconfirmed</option>
                        <option value="y" {{ $order->order_status == 'y' ? 'selected' : NULL }}>Confirmed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info btn-block">UPDATE STATUS</button>
            </form>
        </div>
    </div>
@endsection