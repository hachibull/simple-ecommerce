@extends('master')
@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator,
                    etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
                <p>
                    <a href="https://getbootstrap.com/docs/4.0/examples/album/#" class="btn btn-primary my-2">Main call to
                        action</a>
                    <a href="https://getbootstrap.com/docs/4.0/examples/album/#" class="btn btn-secondary my-2">Secondary
                        action</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">

                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top"
                                    data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                                    alt="{{ $product->title }}">
                                <div class="card-body">
                                    <p class="card-text" ><a href="{{ route('product.details' , $product->slug) }}">{{ $product->title }}</a></p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <form action="{{ route('cart.add') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">Add to cart</button>
                                            </form>
                                         
                                        </div>
                                        @if($product->sale_price)
                                        <strong class="text-muted"><strike>BDT {{ $product->sale_price }}</strike></strong>  <strong class="text-muted">BDT {{ $product->price }}</strong>
                                        @else
                                        <strong class="text-muted">BDT {{ $product->price }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>

    </main>
@endsection
