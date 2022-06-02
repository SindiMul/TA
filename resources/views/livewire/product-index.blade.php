<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View All Item</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <h2>{{$title}}</h2>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input wire:model="search" type="text" class="form-control" placeholder="Search . . ." aria-label="Search"
                    aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
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
                                <a href="{{ route('products.detail', $product->slug)}}"  class="btn btn-event-details px-4"><i class="fas fa-eye"></i>
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
    
</div>