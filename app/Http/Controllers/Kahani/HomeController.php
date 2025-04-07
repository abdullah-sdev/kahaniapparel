<?php

namespace App\Http\Controllers\Kahani;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // curl https://api.unsplash.com/search/photos?query=canada █
        $categories = Category::select('id', 'name')->limit('4')->get();
        $products = Product::select('id', 'name')->limit('10')->get();

        $data = compact('categories', 'products');
        return view('kahani-apparel.index')->with($data);
    }
    public function products()
    {
        return view('kahani-apparel.product');
    }
    public function product()
    {
        return view('kahani-apparel.product-view');
    }
}
