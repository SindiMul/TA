<main>
  <section class="section-details-header"></section>
  <section class="section-details-content">
    <div class="container">
      <div class="row">
        <div class="row mt-4 mb-2">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
              </ol>
            </nav>
          </div>
        </div>
      </div> 
      <div class="row"> 
        <div class="col-lg-8 pl-lg-0">
          <div class="card card-details">
          @if(session()->has('message'))
                <div class="alert alert-danger">{ session('message') }}</div>
                    @endif
            <h1>Who is Going?</h1>
            <p>
            dasdwds
            </p>
            <div class="attendee">
                <table class="table table-responsive-sm text-center">
                        <thead>
                        <tr>
                            <td>no</td>
                            <td>Name</td>
                            <td>jumlah</td>
                            <td>price</td>
                            <td>total</td>
                            <td>departure Datae</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1 ?>
                            @forelse ($pesanan_details as $pesanan_detail)
                            <tr>
                            <td class="align-middle">{{ $no++ }}</td>
                            <td class="align-middle">{{ $pesanan_detail->product->title }}</td>
                            <td class="align-middle">{{ $pesanan_detail->jumlah_pesanan }}</td>
                            <td class="align-middle">Rp. {{ number_format($pesanan_detail->product->price) }}</td>
                            <td class="align-middle">Rp. {{ number_format($pesanan_detail->total_harga) }}</td>
                            <td class="align-middle">{{ $pesanan_detail->nama }}</td>
                            <td><img src="{{ url('frontend/images/ic_remove.png') }}" wire:click="destroy({{ $pesanan_detail->id }})" alt="" />
                            </td>
                            </tr>    
                            @empty
                            <tr><td colspan="7">Data Kosong</td> </tr>   
                            @endforelse
                        </tbody>
                </table>
            </div>
            <div class="member mt-3">
              <h2>Add Member</h2>
              <form class="form-inline" method="post" action="#">
                @csrf
                <label for="username" class="sr-only">Name</label>
                <input
                  type="text"
                  name="username"
                  class="form-control mb-2 mr-sm-2"
                  id="inputUsername"
                  placeholder="Username"
                />


                <label for="departure_date" class="sr-only"
                  >Departure Date</label
                >
                <div class="input-group mb-2 mr-sm-2">
                  <input
                    type="text"
                    name="departure_date"
                    class="form-control datepicker"
                    id="departure_date"
                    placeholder="departure date"
                  />
                </div>

                <button type="submit" class="btn btn-add-now mb-2 px-4">
                  Add Now
                </button>
              </form>
              <h3 class="mt-2 mb-0">Note</h3>
              <p class="disclaimer mb-0">
                You are only able to invite member that has registered in
                Jasa Karunia.
              </p>
            </div>
          </div>
        </div>
        @if(!empty($pesanan))
        <div class="col-lg-4">
          <div class="card card-details card-right">
            <h2>Checkout Informations</h2>
            
            <table class="trip-informations">
            <tr>
                            <th width="50%">Total Harga</th>
                              <td width="50%" class="text-right">
                                Rp. {{ number_format($pesanan->total_harga) }} </td>
                          </tr>
              <tr>
                <th width="50%">Trip Price</th>
                <td width="50%" class="text-right">
                  Rp ,00 / person
                </td>
              </tr>
              <tr>
                <th width="50%">Total </th>
                <td width="50%" class="text-right text-total">
                  <span class="text-blue">Rp </span
                  >
                </td>
              </tr>
            </table>

            <hr />
            <h2>Payment Instructions</h2>
            <p class="payment-instructions">
              Please complete your payment before to continue the wonderful
              trip
            </p>
            <div class="bank">
              <div class="bank-item pb-3">
                <img
                  src="{{ url('frontend/images/ic_bank.png') }}"
                  alt=""
                  class="bank-image"
                />
                <div class="description">
                  <h3>PT Panca Media Travel</h3>
                  <p>
                    0881 8829 8800
                    <br />
                    Bank Central Asia
                  </p>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="bank-item pb-3">
                <img
                  src="{{ url('frontend/images/ic_bank.png') }}"
                  alt=""
                  class="bank-image"
                />
                <div class="description">
                  <h3>PT Panca Media Travel </h3>
                  <p>
                    0899 8501 7888
                    <br />
                    Bank HSBC
                  </p>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <div class="join-container">
                         <a href="{{ route('checkout') }}" class="btn btn-block btn-join-now mt-3 py-2">
                            Check Out
                         </a>
                        </div>
                        @endif
          
          
        </div>
      </div>
    </div>
  </section>
</main>