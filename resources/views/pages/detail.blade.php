@extends('layouts.app')
@section('title', 'Detail paket')

@section('content')
<main>
      <section class="section-details-header"></section>
      <section class="section-details-content">
        <div class="container">
          <div class="row">
            <div class="col p-0">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page">
                    Paket Outbond Event
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Details
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 pl-lg-0">
              <div class="card card-details">
                <h1>{{ $item->title }}</h1>
                <p>
                {{ $item->location }}
                </p>
                @if($item->galleries->count() > 0)
                <div class="gallery">
                  <div class="xzoom-container">
                    <img
                      class="xzoom"
                      id="xzoom-default"
                      src="{{ Storage::url($item->galleries->first()->image) }}"
                      xoriginal="{{ Storage::url($item->galleries->first()->image) }}"
                    />
                    <div class="xzoom-thumbs">
                    @foreach($item->galleries as $gallery)
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
                  <h2>Tentang Wisata</h2>
                  <p>
                  {!! $item->about !!}
                  </p>
                  <div class="features row pt-3">
                    <div class="col-md-4">
                      <img
                        src="{{ url('frontend/images/ic_event.png') }}"
                        alt=""
                        class="features-image"
                      />
                      <div class="description">
                        <h3>Featured Ticket</h3>
                        <p>{{ $item->featured_event }}</p>
                      </div>
                    </div>
                    
                    <div class="col-md-4 border-left">
                      <img
                        src="{{ url('frontend/images/ic_foods.png') }}"
                        alt=""
                        class="features-image"
                      />
                      <div class="description">
                        <h3>Foods</h3>
                        <p>{{ $item->foods }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
            <form action="{{ route('checkout_process', $item->id) }}" method="post">
                  @csrf
              <div class="card card-details card-right">
              @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
              
                <h2>paket Informations</h2>
                <table class="trip-informations">
                  
                  <tr>
                    <th width="50%">Duration</th>
                    <td width="50%" class="text-right">{{ $item->duration }}</td>
                  </tr>
                  <tr>
                    <th width="50%">Type</th>
                    <td width="50%" class="text-right">{{ $item->type}}</td>
                  </tr>
                  <tr>
                    <th width="50%">Price</th>
                    <td width="50%" class="text-right">Rp {{ number_format($item->price) }}</td>
                  </tr>
                  <tr>
                    <th colspan="2">departure date</th>
                  </tr>
                  <tr>
                    <th colspan="2">
                    <input
                    type="date"
                    name="departure_date"
                    class="form-control datepicker "
                    id="departure_date"
                    placeholder="departure date"
                    required/>
                  
                    </th>
                  </tr>
                </table>
              </div>
              <div class="join-container">
              @auth
              
                  <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                      Join Now
                  </button>
              </form>
              @endauth
              @guest
                  <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">
                      Login or Register to Join
                  </a>
              @endguest
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    @endsection

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
