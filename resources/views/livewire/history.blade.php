<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Tanggal Pesan</td>
                            <td>Kode Pemesanan</td>
                            <td>Pesanan</td>
                            <td>Status</td>
                            <td><strong>Total Harga</strong></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse ($pesanans as $pesanan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pesanan->created_at }}</td>
                            <td>{{ $pesanan->kode_pemesanan }}</td>
                            <td>
                                <?php $pesanan_details = \App\PesananDetail::where('pesanan_id', $pesanan->id)->get(); ?>
                                @foreach ($pesanan_details as $pesanan_detail)
                                {{ $pesanan_detail->product->title }}
                                <br>
                                @endforeach
                            </td>
                            <td>
                            {{ $pesanan->status }}
                               
                            </td>
                            <td><strong>Rp. {{ number_format($pesanan->total_harga) }}</strong></td>
                            @if($pesanan->status =='SUCCESS')
                            <td><img src="{{ url('frontend/images/ic_mail.png') }} " width="50"alt="" /> check your mail</td>
                                @else
                               <td></td>
                            
                               
                               
                              
                                @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Data Kosong</td>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <p>Untuk pembayaran silahkan dapat transfer di rekening dibawah ini : </p>
                    <div class="media">
                        <img class="mr-3" src="{{ url('assets/bri.png') }}" alt="Bank BRI" width="60">
                        <div class="media-body">
                            <h5 class="mt-0">BANK BRI</h5>
                            No. Rekening 012345-678-910 atas nama <strong>Fikri Sukmajaya</strong>
                            </div>
                            <img class="mr-3" src="{{ url('assets/WA.png') }}" alt="Wa" width="60">
                            <div class="media-body">
                            
                        
                        
                            <h5 class="mt-0">WhatApp</h5>
                            <strong>089505993003</strong>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>