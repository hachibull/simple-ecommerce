@extends('master')
@section('content')

<div class="container">
    <br>
    <p class="text-center">Checkout</p>
    <hr>
    @guest
    <div class="alert alert-info">
        you need to <a href="{{ route('login') }}">Login </a>for complete your order.
    </div>
    @else
    <div class="alert alert-info">
        you r ordering as,{{ auth()->user()->name }}.
    </div>
    @endguest

</div>



<div class="container">


    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill">5</span>
            </h4>

            @foreach($data['cart'] as $product)




            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">{{ $product['title'] }}</h6>
                        <small class="text-muted">{{ $product['quantity'] }}</small>
                    </div>
                    <span class="text-muted">657</span>
                </li>

                @endforeach



                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (BDT)</span>
                    <strong>343</strong>
                </li>
            </ul>

            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
            </form>
        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing address</h4>
            @include('front.message')
            <form action="{{ route('order') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label">name</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">name</span>
                            <input type="text" name="customer_name" value="{{ auth()->user()->name }}"
                                class="form-control" id="name" placeholder="name" required>

                        </div>
                    </div>

                    <div class="col-12">
                        <label for="phone_number" class="form-label">phone</label>
                        <input type="number" name="customer_phone_number" value="{{ auth()->user()->phone_number }}"
                            class="form-control">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" required></textarea>
                    </div>


                    <div class="col-md-5 mb-3">
                        <label for="city">City</label>
                        <input type="text" name="city" placeholder="city">
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="postal_code" class="form-label">postal_code</label>
                        <input type="text" name="postal_code" placeholder="postal_code">
                    </div>
                </div>
                <hr class="my-4">
                <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
            </form>

        </div>
    </div>

</div>

@endsection