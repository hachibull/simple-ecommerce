@extends('master')
@section('content')

<div class="container">
    <br>
    <p class="text-center">Cart</p>
    <hr>

@if (session()->has('message'))
<div class="aleart aleart-success">
    {{ session()->get('message') }}
</div>
@endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <td>serial</td>
                <td>product</td>
                <td>quantity</td>
                <td>price</td>
                <td>action</td>
            </tr>
        </thead>
        <tbody>

            @php $i=1
            @endphp

            @foreach($cart as $key=> $product)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $product['title'] }}</td>
                <td>{{ $product['quantity'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td> 
                   
                    <form action="{{ route('cart.remove') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $key }}">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">remove</button>
                    </form>
              
            </td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>total</td>
                <td>{{ $total }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    
    <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>

</div>


@endsection