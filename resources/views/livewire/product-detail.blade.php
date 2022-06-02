
@section('title', 'Detail paket')

<main>
<section class="section-details-header"></section>
<section class="section-details-content">
  <div class="container">
      <div class="row mt-4 mb-2">
          <div class="col">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-dark">View All Item</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Item Detail</li>
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

      <div class="row">
        <div class="col-lg-8 pl-lg-0">
          <div class="card card-details card-lef">
            <h1>{{ $product->title }}</h1>
              <p>
                {{ $product->location }}
              </p>
                  @if($product->productgalery->count() > 0)
                <div class="gallery">
                  <div class="xzoom-container">
                    <img
                      class="xzoom"
                      id="xzoom-default"
                      src="{{ Storage::url($product->productgalery->first()->image) }}"
                      xoriginal="{{ Storage::url($product->productgalery->first()->image) }}"
                    />
                    <div class="xzoom-thumbs">
                      @foreach($product->productgalery as $gallery)
                        <a href="{{ Storage::url($gallery->image) }}"
                          ><img
                            class="xzoom-gallery"
                            width="128"
                            src="{{ Storage::url($gallery->image) }}"
                            xpreview="{{ Storage::url($gallery->image) }}"
                        /></a>
                      
                      @endforeach
                    </div>
                  </div>
                  @endif
                  <h2>About</h2>
                  <p>
                    {!! $product->about !!}
                  </p>
                </div>
          </div>
        </div>  
        <div class="col-lg-4">
      
        <?php $no =\Carbon\Carbon::now()->format("Y-m-d") ?>

          <form wire:submit.prevent="masukkanKeranjang"> 
              <div class="card card-details card-right">
                <h2>paket Informations</h2>
                <table class="trip-informations">
                <tr>
                      <th width="50%">Name</th>
                      <td width="50%" class="text-right">{{$product->title}}</td>
                </tr>
                    <tr>
                      <th width="50%">Category</th>
                      <td width="50%" class="text-right">{{$product->category->nama}}</td>
                    </tr>
                    <tr>
                      <th width="50%">Price</th>
                      <td width="50%" class="text-right">Rp {{ number_format($product->price) }}</td>
                    </tr>

                    <tr>
                      <th colspan="2">jumlah item</th>
                    </tr>
                    
                    <tr>
                    <th colspan="2">
                        <input id="jumlah_pesanan" type="number"
                              class="form-control @error('jumlah_pesanan') is-invalid @enderror"
                              wire:model="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}" required
                              autocomplete="name" autofocus min="0">
                                    @error('jumlah_pesanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                      </th>
                    </tr>      
                    <tr>
                      <th colspan="2">departure date</th>
                    </tr>
                    <tr>
                      <th colspan="2">
                    
                        <input id="date" type="date"
                              class="form-control @error('date') is-invalid @enderror"
                              wire:model="date" value="{{ old('date') }}"
                              autocomplete="name" autofocus min={{$no}}
                        >

                        @error('date')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </th>
                    </tr>
                    
                    </table> 
                    </div>      
                    <div class="join-container">
                        @auth
                            <button type="submit" class="btn btn-block btn-join-now mt-3 py-2" ><i class="fas fa-shopping-cart"></i>  Input To Cart</button>
                        </div>
                        @endauth
                        @guest
                      <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">
                          Login or Register to Join
                      </a>
                      @endguest
                    </div>
            </form>
              
              </div>

        </div>
      </div>
  </div>
  </section>
</main>



@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
      $(document).ready(function() {
        $('.xzoom, .xzoom-gallery').xzoom({
          zoomWidth: 500,
          title: false,
          tint: '#333',
          Xoffset: 15
        });
      });
    </script>
@endpush


@push('prepend-style')
  <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}" />
@endpush

@push('addon-script')
  <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        uiLibrary: 'bootstrap4',
        icons: {
          rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" />'
        }
      });
    });
  </script>
@endpush

