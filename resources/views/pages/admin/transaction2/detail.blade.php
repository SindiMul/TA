@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Transaksi {{ $item->user->name }}</h1>
      </div>

      <!-- Content Row -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $item->id }}</td>
                    </tr>
                    <tr>
                        <th>Order Code </th>
                        <td>{{ $item->kode_pemesanan }}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{ $item->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Status Transaksi</th>
                        <td>{{ $item->status }}</td>
                    </tr>
                    <tr>
                        <th>Pembelian</th>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Item</th>
                                    <th>Departure Date</th>
                                    <th>Price</th>
                                    <th>Total Order </th>
                                    <th>Total Price</th>
                                </tr>
                                @foreach($item->pesanan_details as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>{{ $detail->product->title }}</td>
                                        <td>{{ $detail->date }}</td>
                                        <td>{{ $detail->product->price }}</td>
                                        <td>{{ $detail->jumlah_pesanan }}</td>
                                        <td>{{ number_format($detail->total_harga) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                      <th>Total Price</th>
                      <th >Rp {{ number_format($item->total_harga) }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
