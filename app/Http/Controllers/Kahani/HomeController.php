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
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();
        $products = Product::paginate(16);

        return view('kahani-apparel.product', compact('products', 'categories'));
    }

    public function product($slug)
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        $product = Product::where('slug', $slug)->firstOrFail();
        $product->load('reviews', 'sizes', 'colors');

        $currentProduct = Product::find($product->id);
        $relatedProducts = Product::whereHas('categories', function ($query) use ($currentProduct) {
            $query->whereIn('categories.id', $currentProduct->categories()->pluck('categories.id'));
        })
        ->where('id', '!=', $currentProduct->id)
        ->inRandomOrder()  // Use this to get random results
        ->limit(4)          // Limit to 4 products
        ->get();

        $data = compact('product', 'categories', 'relatedProducts');
        // dd($data);

        return view('kahani-apparel.product-view')->with($data);
    }

    public function panel()
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        return view('kahani-apparel.panel.index', compact('categories'));
    }

    public function about()
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        return view('kahani-apparel.about', compact('categories'));
    }

    public function faq()
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        return view('kahani-apparel.faq', compact('categories'));
    }

    public function category($slug)
    {
        // dd($slug);
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        $category = Category::where('slug', $slug)->firstOrFail();
        $category->load('products');
        $products = $category->products()->paginate(16);
        $data = compact('category', 'products', 'categories');

        return view('kahani-apparel.product')->with($data);
        // return view('');
    }

    public function privacypolicy()
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        return view('kahani-apparel.privacypolicy', compact('categories'));
    }

    public function contact()
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        return view('kahani-apparel.contact', compact('categories'));
    }
}
