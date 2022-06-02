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
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
              </ol>
            </nav>
          </div>
        </div>
      </div> 
      <div class="row"> 
        <div class="col-lg-8 pl-lg-0">
          <div class="card card-details">
          @if(session()->has('message'))
                <div class="alert alert-danger"> {{ session('message') }}</div>
                    @endif
            <h1>Your Cart?</h1>
            
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
                            <td class="align-middle">{{ $pesanan->aa }}</td>
                            <td class="align-middle">{{ $pesanan_detail->product->title }}</td>
                            <td class="align-middle">{{ $pesanan_detail->jumlah_pesanan }}</td>
                            <td class="align-middle">Rp. {{ number_format($pesanan_detail->product->price) }}</td>
                            <td class="align-middle">Rp. {{ number_format($pesanan_detail->total_harga) }}</td>
                            <td class="align-middle">{{ $pesanan_detail->date }}</td>
                            <td><img src="{{ url('frontend/images/ic_remove.png') }}" wire:click="destroy({{ $pesanan_detail->id }})" alt="" />
                            </td>
                            </tr>    
                            @empty
                            <tr><td colspan="7">Data Kosong</td> </tr>   
                            @endforelse
                        </tbody>
                </table>
            </div>
            
          </div>
        </div>
        @if(!empty($pesanan))
        <div class="col-lg-4">
          <div class="card card-details card-right">
            <h2>Checkout Informations</h2>
            
            <table class="trip-informations">
            
              <tr>
                <th width="50%">Total price </th>
                <td width="50%" class="text-right text-total">
                  <span class="text-blue">Rp. {{ number_format($pesanan->total_harga) }} </span
                  >
                </td>
              </tr>
            </table>

            <hr />
            <h2>Payment Instructions</h2>
            <p class="payment-instructions">
              Please complete your payment before to continue the 
              trip or event
            </p>
           
          </div>
          <div class="join-container">
                         <a href="{{ route('transaction') }}" class="btn btn-block btn-join-now mt-3 py-2">
                            Check Out
                         </a>
                        </div>
                        @endif
          
          
        </div>
      </div>
    </div>
  </section>
</main>