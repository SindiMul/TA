@extends('layouts.app')
@section('title', 'Product')

@section('content')   

<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="aaa">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List All View</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
            <div class="col-md-9">
                <h2>LIST All</h2>
                <br>
            </div>
        
                <div class="col-md-3">
                    <form action="/search" method="get">
                        <div class="input-group mb-3">
                            <input  type="search" name="search" class="form-control" placeholder="Search . . ." aria-label="Search"
                                aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                                
                                <button type="submit" class="input-group-text"><span  id="basic-addon1">
                                    <i class="fas fa-search"></i>
                                </span></button>
                            </div>
                        </div>
                        </form>
                </div>   
                </div> 
            
        
        <section class="section-event-content" id="eventcontent">
            <div class="container">
                <div class="section-event-list row justify-content-center">
                    @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card-event text-center d-flex flex-column"
                            style="background-image: url('{{ $product->productgalery->count() ? Storage::url
                            ($product->productgalery->first()->image) : '' }}');"
                            >
                                <div class="event-location">{{ $product->location }} </div>
                                <div class="event-name"> {{ $product->title }} </div>
                                <div class="event-button mt-auto">
                                <a href="#"  class="btn btn-event-details px-4"><i class="fas fa-eye"></i>
                                    view detail
                                </a>   
                                </div>

                            </div>
                        </div>
                    @endforeach
                   
                    
                 
                </div>

            </div>

        </section>
       

    
    
        <div class="row">
                    <div class="col">
                        {{ $products->links() }}
                    </div>
</div>
@endsection
