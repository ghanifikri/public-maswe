@extends('admin.layouts.app')

@section('title', 'Order Show')

@section('css')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endsection

@section('content')
<div class="card">
    <h5 class="card-header">Order Details <a href="#"
            class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i>
            Generate PDF</a>
    </h5>
    <div class="card-body">
        @if($order)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No Transactoin</th>
                    <th>Nama Pembeli</th>
                    <th>Total Produk</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$order->midtrans_booking_code}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->transactionDetails->count()}}</td>
                    <td>{{moneyFormat($order->total_price)}}</td>
                    <td>
                        @if($order->payment_status=='paid')
                        <span class="badge badge-success">{{$order->payment_status}}</span>
                        @elseif($order->payment_status=='waiting')
                        <span class="badge badge-warning">{{$order->payment_status}}</span>
                        @elseif($order->payment_status=='delivered')
                        <span class="badge badge-primary">{{$order->payment_status}}</span>
                        @else
                        <span class="badge badge-danger">{{$order->payment_status}}</span>
                        @endif
                    </td>
                    <td>
                        @can('order_update')
                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary btn-sm float-left mr-1"
                            style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                            data-placement="bottom"><i class="fas fa-edit"></i></a>
                        @endcan
                    </td>

                </tr>
            </tbody>
        </table>

        <section class="confirmation_part section_padding">
            <div class="order_boxes">
                <div class="row">
                    <div class="col-lg-6 col-lx-4">
                        <div class="order-info">
                            <h4 class="text-center pb-4">ORDER INFORMATION</h4>
                            @foreach ($order->transactionDetails as $item)
                            <table class="table">
                                <tr class="">
                                    <td>Order Number</td>
                                    <td> : {{$item->code}}</td>
                                </tr>
                                <tr class="">
                                    <td>Produk</td>
                                    <td> : 
                                         @if ($item->size != '')
                                         {{$item->product->name}} ({{ $item->size }})
                                        @else
                                        {{$item->product->name}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Order Date</td>
                                    <td> : {{$item->created_at->format('D d M, Y')}} at
                                        {{$item->created_at->format('g : i a')}} </td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td> : {{$item->quant}}</td>
                                </tr>
                                <tr>
                                    <td>Order Status</td>
                                    <td> : 
                                        @if ($order->order_status == 'n')
                                            <span class="badge badge-warning">Unconfirmed</span>
                                        @else
                                            <span class="badge badge-success">Confirmed</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Amount</td>
                                    <td> : {{ moneyFormat($item->amount) }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Status</td>
                                    <td> : {{$order->payment_status}}</td>
                                </tr>
                            </table>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-6 col-lx-4">
                        <div class="shipping-info">
                            <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                            <table class="table">
                                <tr class="">
                                    <td>Full Name</td>
                                    <td> : {{$order->user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> : {{$order->user->email}}</td>
                                </tr>
                                <tr>
                                    <td>No. Telp</td>
                                    <td> : {{$order->user->phone_number}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> : {{$order->user->address}}</td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td> : {{$order->user->district->name}}</td>
                                </tr>
                                <tr>
                                    <td>Kabupaten/Kota</td>
                                    <td> : {{$order->user->regencies->name}}</td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td> : {{$order->user->provinces->name}}</td>
                                </tr>
                                <tr>
                                    <td>Negara</td>
                                    <td> : INDONESIA</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

    </div>
</div>
@endsection
