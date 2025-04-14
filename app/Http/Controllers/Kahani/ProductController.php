<?php

namespace App\Http\Controllers\Kahani;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kahani\UpdateCartRequest as KahaniUpdateCartRequest;
use App\Models\Address;
use App\Models\CargoCompany;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function cart()
    {
        // if user can view the cart
        if (Auth::guest()) {
            return redirect()->route('login');
        }
        if (Auth::user()->cannot('viewCart', Order::class)) {
            return redirect()->back()->with('error', 'Add product to cart first.');
        }

        // get cartItems
        $order = Order::where('user_id', Auth::user()->id)->where('order_status', 'processing')->firstOrFail();
        $order->load('orderItems.product');
        $data = compact('order');

        // dd($data);
        return view('kahani-apparel.cart')->with($data);
    }

    public function store_to_cart(KahaniUpdateCartRequest $request)
    {
        // dd($request->validated(), $request->all());
        // Add to Cart logic
        if ($request->validated()['action'] == 'Add to Cart') {

            if (Auth::check()) {
                $user = Auth::user();
                $cargoCompany = CargoCompany::first();

                if (Auth::user()->cannot('addToCart', Order::class)) {
                    return redirect()->back()->with('error', 'You are not allowed to add to cart.');
                }

                $order = Order::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'order_status' => 'processing',  // pending
                    ],
                    [
                        'user_id' => $user->id,
                        'order_status' => 'processing',  // pending
                        'address_id' => $user->addresses()->first()->id,
                        'payment_status' => 'pending',
                        // 'tracking_number' => null,
                        // 'payment_type' => 'cash',
                        'cargo_company_id' => $cargoCompany->id,
                        // 'discount_id' => null,
                        // 'subtotal' => 0,
                        // 'delivery_cost' => 0
                    ]
                );

                $product = Product::findOrFail($request->validated()['product_id']);
                // $product->load('productAttributes');
                // dd($product);

                $orderItem = $order->orderItems()->create([
                    'product_id' => $product->id,
                    'price' => $product->discounted_price,
                    'quantity' => $request->validated()['quantity'],
                    'product_attributes' => [
                        'size' => $request->validated()['selectedSize'],
                        'color' => $request->validated()['selectedColor'],
                    ],
                ]);

                return redirect()->back()->with('success', 'Product added to cart.');
            } else {
                return redirect()->route('login');
            }
        }

        // Checkout Logic
        if ($request->validated()['action'] == 'Buy Now') {
        }

        return redirect()->back()->with('error', 'Not Implemented.');

        // return $orderItem;
    }

    public function remove_from_cart(OrderItem $orderItem)
    {
        if (Auth::user()->cannot('removeFromCart', $orderItem)) {
            return redirect()->back()->with('error', 'You are not allowed to remove from cart.');
        }

        // dd($orderItem->order->orderItems()->count());
        if ($orderItem->order->orderItems()->count() === 1) {
            $orderItem->order()->delete();

            return redirect()->route('kahani.home')->with('success', 'Product removed from cart.');
        } else {
            $orderItem->delete();
        }

        $orderItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    public function proceedToCheckout(Request $request)
    {
        // dd($request->all());
        return redirect()->route('kahani.checkout');
    }

    public function checkout()
    {
        $user = Auth::user();
        $addresses = Auth::user() ? Address::where('user_id', Auth::user()->id)->get() : [];

        $order = Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'processing')
            ->firstOrFail();

        $order->load('orderItems.product');

        // dd($order);
        return view('kahani-apparel.checkout', compact('addresses', 'user', 'order'));
    }

    public function coupon_apply(Request $request)
    {
        // dd($request->all());

        $order = Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'processing')
            ->firstOrFail();

        if ($order->discount_id) {
            return back()
                ->with('error', 'Coupon already applied.');
        }

        $coupon = Discount::where('code', $request->coupon)->first();

        if (! $coupon || ! $coupon->isValid() || $coupon->isExpired() || ! $coupon->isActive() || $coupon->isUsed()) {
            return back()->with('error', 'Invalid or expired coupon.');
        }

        $order->discount_id = $coupon->id;
        $order->save();

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function coupon_remove(Request $request)
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'processing')
            ->firstOrFail();

        $order->discount_id = null;
        $order->save();

        return back()->with('success', 'Coupon removed successfully!');
    }

}
