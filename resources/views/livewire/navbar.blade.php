<div class="container">
      <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="{{ route('home')}}">
          <img src="{{ url('frontend/images/logo.png') }}" alt="" />
        </a>
        <button
          class="navbar-toggler navbar-toggler-right"
          type="button"
          data-toggle="collapse"
          data-target="#navb"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navb">
          <ul class="navbar-nav ml-auto mr-3">
              <li class="nav-item mx-md-2">
                  <a href="{{ route('home')}}" class="nav-link active">Home</a>
              </li>
              <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            List category
                        </a>
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($categories as $category)
                            <a class="dropdown-item"
                                href="{{ route('products.category', $category->id) }}">{{ $category->nama }}</a>
                            @endforeach
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('products') }}">All Item</a>
                        </div>
              </li>
              <li class="nav-item mx-md-2">
                    @auth
                  <a href="{{  url('history') }}" class="nav-link">history</a>
                  @endauth
              </li>
              @guest
                  <a href="{{  url('login') }}" class="nav-link">history</a>
                  @endguest
              <li class="nav-item">
                        <a class="nav-link" href="{{ route('keranjang') }}">
                            Cart <i class="fas fa-shopping-bag"></i>
                            @if($jumlah_pesanan !==0)
                            <span class="badge badge-danger">{{ $jumlah_pesanan }}</span>
                            @endif
                        </a>
                    </li>
              <li class="nav-item mx-md-2">
                  <a href="{{  url('register') }}" class="nav-link">Register</a>
              </li>
          </ul>


          @guest
      <!-- Mobile Button -->
      <form class="form-inline d-sm-block d-md-none">
        <button class="btn btn-login my-2 my-sm-0" type="button"
                onclick="event.preventDefault(); location.href='{{ url('login') }}';">
          Masuk
        </button>
      </form>

      <!-- Desktop Button -->
      <form class="form-inline my-2 my-lg-0 d-none d-md-block">
        <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button"
                onclick="event.preventDefault(); location.href='{{ url('login') }}';">
          Masuk
        </button>
      </form>
    @endguest

    @auth
    <!-- Mobile Button -->
        <form class="form-inline d-sm-block d-md-none" action="{{  url('logout') }}" method="POST">
            @csrf
            <button class="btn btn-login my-2 my-sm-0" type="submit">
                Keluar
            </button>
        </form>

        <!-- Desktop Button -->
        <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{  url('logout') }}" method="POST">
            @csrf
            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                Keluar
            </button>
        </form>
    @endauth
        </div>
      </nav>
    </div>
    