<?php

namespace App\Http\Controllers\Kahani;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function index()
    {
        // curl https://api.unsplash.com/search/photos?query=canada █
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();
        $products = Product::select('id', 'name', 'slug', 'thumbnail_image')->limit('10')->get();

        $data = compact('categories', 'products');

        return view('kahani-apparel.index')->with($data);
    }

    public function products()
    {
        $products = Product::paginate(16);

        return view('kahani-apparel.product', compact('products'));
    }

    public function product($slug)
    {
        // $product = Product::where('slug', $slug)->first();

        $product = Product::where('slug', $slug)->firstOrFail();
        $product->load('reviews', 'sizes', 'colors');
        $data = compact('product');
        // dd($data);

        return view('kahani-apparel.product-view')->with($data);
    }

    public function panel()
    {
        return view('kahani-apparel.panel.index');
    }
}
