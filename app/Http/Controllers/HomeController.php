<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // return view('user_template.layouts.homeTemplate');
        $allProducts = Product::latest()->get();
        return view('user_template.home',compact('allProducts'));
    }
}
