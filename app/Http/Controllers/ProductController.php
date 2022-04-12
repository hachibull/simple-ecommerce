<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showDetails($slug){

        $products=Product::where(['slug'=>$slug, 'active'=>1])->first();//perrametre er slug ta ar product table er slug ta milabe ek kina 
        //quary data single hole  ('slug' , $slug) emn hoto

        if($products===null){
            return redirect()->route('frontend.home');
        }
        return view('front.products.details',['products' => $products]);

    }
}
