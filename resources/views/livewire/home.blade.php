@extends('layouts.app')

@section('title')
Jasa Karunia
@endsection

@section('content')
       <!-- header -->
       <header class="text-center">
            <H1>&nbsp <br>
            &nbsp</H1>
                 <P>&nbsp <br>
                 &nbsp
                </P>
        </header>

        <!-- paket -->
       
                   
                    
                 
                </div>

            </div>

        </section>


         <!-- product -->
         <section class="section-event" id="eventpopular">
            <div class="container">
                <div class="row">
                    <div class="col mt-5 mb-5 section-event-heading">
                        <h2> <strong>product Digarut </strong> 
                            <a href="{{ route('products') }}" class="btn btn-get-started ml-auto ">
                                See All
                              </a>
                        </h2>

                    </div>
                </div>
                <div class="row">
             <div class="produk-items">
                 @foreach($products as $product)
                  <div class="item">
                      <img src="{{ Storage::url($product->productgalery->first()->image) }}" />
                      <div class="inner">
                          <div class="info">
                               <h5>{{ $product->title }}</h5>
                               <p>{{ $product->location }}</p>
                               <div class="event-button mt-auto">
                             <a href="{{ route('products.detail', $product->slug)}}"  class="btn btn-event-details px-4">
                                view detail
                             </a>   
                            </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
                  
             </div>
         </div>
            </div>
        </section>
  

       

@endsection
