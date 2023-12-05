@extends('user.layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
                <h4>Unpaid</h4>
                <p><b>{{ $transactionsCount }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
                <h4>Reviews</h4>
                <p><b>{{ $review }}</b></p>
            </div>
        </div>
    </div>
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
                              <th>Payment Status</th>
                              <th>Total Price</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($transactions as $item)
                            <tr>
                                <td>{{ $item->code }}</td>
                                <td>
                                    @foreach ($item->transactionDetails as $i)
                                        <ul>
                                            <li>
                                                @if ($i->size != '')
                                                    {{ $i->product->name }} ({{ $i->size }})
                                                @else
                                                    {{ $i->product->name }}
                                                @endif
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td><span class="badge badge-warning">{{ $item->payment_status }}</span></td>
                                <td>{{ moneyFormat($item->total_price) }}</td>
                                <td><a href="{{ $item->midtrans_url }}" target="_blank" class="btn btn-success">Pay Here</a></td>
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
