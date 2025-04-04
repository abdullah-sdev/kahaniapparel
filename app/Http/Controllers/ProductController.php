<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use App\Models\Category;
use App\Models\Color;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->cannot('viewAny', Product::class)) {
            abort(403);
        }
        $products = Product::paginate(10);
        $data = compact('products');
        return view('admin.products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->cannot('create', Product::class)) {
            abort(403);
        }
        $sizes = Size::all();
        $categories = Category::all();
        $colors = Color::all();
        $data = compact('sizes', 'categories', 'colors');
        return view('admin.products.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        // dd($request->all());
        $validatedData = $request->validated();

        // Handle image upload
        if ($request->hasFile('thumbnail_image')) {
            // Store the first image
            $validatedData['thumbnail_image'] = time() . '-' . $request->name . '-thumbnail-1' . '.' . $request->thumbnail_image->getClientOriginalExtension();
            $request->thumbnail_image->move(public_path('images/products/'), $validatedData['thumbnail_image']);
        }

        if ($request->hasFile('thumbnail_image1')) {
            // Store the second image
            $validatedData['thumbnail_image1'] = time() . '-' . $request->name . '-thumbnail-2' . '.' . $request->thumbnail_image1->getClientOriginalExtension();
            $request->thumbnail_image1->move(public_path('images/products/'), $validatedData['thumbnail_image1']);
        }
        $product = Product::create($validatedData);
        // dd($request->all());
        // Attach colors, sizes and categories to the product
        $product->colors()->sync($request->color_id);
        $product->sizes()->sync($request->size_id);
        $product->categories()->sync($request->category_id);
        // dd($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        // $product->load('colors', 'sizes', 'categories');
        $sizes = Size::all();
        $categories = Category::all();
        $colors = Color::all();
        return view('admin.products.edit', compact('product', 'sizes', 'categories', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $validatedData = $request->validated();

        // Handle image upload
        if ($request->hasFile('thumbnail_image')) {
            // Store the first image
            $validatedData['thumbnail_image'] = time() . '-' . $request->name . '-thumbnail-1' . '.' . $request->thumbnail_image->extension();
            $request->thumbnail_image->move(public_path('images/products/'), $validatedData['thumbnail_image']);
        }

        if ($request->hasFile('thumbnail_image1')) {
            // Store the second image
            $validatedData['thumbnail_image1'] = time() . '-' . $request->name . '-thumbnail-2' . '.' . $request->thumbnail_image1->extension();
            $request->thumbnail_image1->move(public_path('images/products/'), $validatedData['thumbnail_image1']);
        }
        // dd($validatedData);
        // Update the product in the database
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        // Delete associated images from storage
        if ($product->thumbnail_image) {
            \File::delete(public_path('images/products/' . $product->thumbnail_image));
        }
        if ($product->thumbnail_image1) {
            \File::delete(public_path('images/products/' . $product->thumbnail_image1));
        }

        // Delete the product from the database
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');

    }
}
