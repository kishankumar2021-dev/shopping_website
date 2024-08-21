<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Home;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        $product = new Product;
        $PopularProduct = $product->orderBy('desc')->limit(10)->get();
        $LatestProduct =  $product->orderBy('desc')->limit(5)->get();
        return view('index',compact('PopularProducts','LatestProducts'));
    }
}
