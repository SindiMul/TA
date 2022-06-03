<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('keranjang') }}" class="text-dark">Keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ route('keranjang') }}" class="btn btn-login"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <h4>Informasi Pembayaran</h4>
            <hr>
            <p>Untuk pembayaran silahkan dapat transfer di rekening dibawah ini sebesar : <strong> Rp. {{ number_format($total_harga) }}</strong> </p>
            <div class="media">
                <img class="mr-3" src="{{ url('assets/bri.png') }}" alt="Bank BRI" width="60">
                <div class="media-body">
                    <h5 class="mt-0">BANK BRI</h5>
                    No. Rekening <strong>012345-678-910 </strong> atas nama <strong>Sindi Mulyawati</strong>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>Bukti Pembayaran</h4>
            <hr>
            <form wire:submit.prevent="checkout" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="">Upload bukti pembayaran format gambar</label>
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image"
                    value="{{ old('image') }}" autocomplete="name" autofocus accept="image/*">

                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <button type="submit" class="btn btn-login btn-block"> <i class="fas fa-arrow-right"></i> Checkout </button>
            </form>
        </div>
    </div>

    
</div>