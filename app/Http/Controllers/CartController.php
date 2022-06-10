<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\Order; 

class CartController extends Controller
{
    public function showCart()
    {
        $data = [];
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'], 'price'));

        return view('front.cart.cart', $data);
    }
    public function addToCart(Request $request)
    {
        //dd($request->all());
        try {
            $this->validate($request, [
                'product_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back();
        }

        $product = Product::findOrFail($request->input('product_id')); //product table e dekhbe request e input dia product id ta ace kina
        $cart = session()->has('cart') ? session()->get('cart') : [];  //session() e cart thakle cart anbo noyto blank array return korbe

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'title' => $product->title,
                'quantity' => 1,
                'price' => ($product->sale_price !== null && $product->sale_price > 0) ? $product->sale_price : $product->price,
            ];
        }

        session(['cart' => $cart]);
        session()->flash('message', $product->title . 'added to cart');

        return redirect()->route('cart.show');
    }
    public function removeFromCart(Request $request)
    {

        // dd($request->all());
        try {
            $this->validate($request, [
                'product_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back();
        } //validation korlo

        $cart = session()->has('cart') ? session()->get('cart') : []; //session er save kora cart er data niye variable e rakhlo
        unset($cart[$request->input('product_id')]); //request er id dhore cart er data delete korlo

        session(['cart' => $cart]); //delete kore session er cart k abr update korlo
        session()->flash('message', 'remove to cart successfully'); //message dekhai dilo
        return redirect()->back();
    }

    public function checkout()
    {
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        $data['total'] = array_sum(array_column($data['cart'], 'price'));

        return view('front.cart.checkOut', ['data' => $data]);
    }
    public function order()
    {
        // dd($request->all());
        $validator = Validator::make(request()->all(), [
            'customer_name' => 'required',
            'customer_phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $cart = session()->has('cart') ? session()->get('cart') : [];
        $total = array_sum(array_column($cart, 'price'));

       $order= Order::create([
            'user_id'=>auth()->user()->id,
            'customer_name'=>request()->input('customer_name'),
            'customer_phone_number'=>request()->input('customer_phone_number'),
            'address'=>request()->input('address'),
            'city'=>request()->input('city'),
            'postal_code'=>request()->input('postal_code'),
            'total_amount'=>$total,
            'paid_amount'=>$total,
            'payment_details'=>'cash on delivery',

        ]);
        foreach($cart as $product_id=>$product){
            $order->products()->create([
                'product_id'=>$product_id,
                'quantity'=>$product['quantity'],
                'price'=>$product['total_price'],

            ]);
        }
        $this->setSuccess('order created');
        return redirect('/');
    }
}
