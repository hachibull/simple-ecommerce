<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
   public function index(){
       $products=Product::select(['id','title','slug','price','sale_price'])->where('active',1)->paginate(9);
       return view('front.main',['products'=> $products]);
   }
}
