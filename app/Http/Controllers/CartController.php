<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Contracts\Service\Attribute\Required;

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

        return view('front.cart.checkOut', ['data'=>$data]);
    }
}
