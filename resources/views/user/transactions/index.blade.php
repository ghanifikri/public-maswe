@extends('user.layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Transaction</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Transaction</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                              <th>Code</th>
                              <th>Barang</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th>Payment Status</th>
                              <th>Order Status</th>
                              <th>Total Price</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($transactions as $item)
                            <tr>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quant }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    @if ($item->transaction->payment_status == 'waiting')
                                        <span class="badge badge-warning">{{ $item->transaction->payment_status }}</span>
                                    @elseif ($item->transaction->payment_status == 'paid')
                                        <span class="badge badge-success">{{ $item->transaction->payment_status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $item->transaction->payment_status }}</span>
                                    @endif
                                    
                                </td>
                                <td>
                                    @if ($item->transaction->order_status == 'n')
                                        <span class="badge badge-warning">Unconfirmed</span>
                                    @else
                                        <span class="badge badge-success">Confirmed</span>
                                    @endif
                                </td>
                                <td>{{ moneyFormat($item->amount) }}</td>
                                <td>
                                    @if ($item->transaction->payment_status == 'waiting')
                                        <a href="{{ $item->midtrans_url }}" target="_blank" class="btn btn-success">Pay Here</a>
                                    @elseif ($item->transaction->payment_status == 'paid')
                                    <a href=" https://wa.me/6285880125608/?text=halo%20maswe%20saya%20sudah%20melakukan%20pembayaran%20{{ $item->product->name }}" target="_blank" class="btn btn-success">Hubungi Penjual</a>
                                    @else
                                    <a href="#"  class="btn btn-danger">No Action</a>
                                    @endif
                                    
                                </td>
                            </tr>
                            @empty
                                
                            @endforelse
                            
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection