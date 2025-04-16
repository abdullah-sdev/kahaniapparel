<?php

namespace App\Http\Controllers\Kahani;

use App\Enums\OrderTrackingStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\Kahani\UpdateCartRequest as KahaniUpdateCartRequest;
use App\Models\Address;
use App\Models\CargoCompany;
use App\Models\Category;
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
        $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();
        // if user can view the cart
        if (Auth::guest()) {
            return redirect()->route('login');
        }
        if (Auth::user()->cannot('viewCart', Order::class)) {
            return redirect()->back()->with('error', 'Add product to cart first.');
        }

        // get cartItems
        $order = Order::where('user_id', Auth::user()->id)
            ->where('order_status', OrderTrackingStatusEnum::DRAFT->value)
            ->firstOrFail();
        $order->load('orderItems.product');
        $data = compact('order', 'categories');

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
                        'order_status' => OrderTrackingStatusEnum::DRAFT->value,  // pending
                    ],
                    [
                        'user_id' => $user->id,
                        'order_status' => OrderTrackingStatusEnum::DRAFT->value,  // pending
                        // 'address_id' => $user->addresses()->first()->id,
                        'payment_status' => PaymentStatusEnum::DRAFT->value,
                        // 'tracking_number' => null,
                        // 'payment_type' => 'cash',
                        // 'cargo_company_id' => $cargoCompany->id,
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

        // Sends the user directly to Checkout
        if ($request->validated()['action'] == 'Buy Now') {

            $product = Product::findOrFail($request->validated()['product_id']);

            $order = new Order;
            $order->user_id = Auth::user()?->id;
            $order->order_status = OrderTrackingStatusEnum::DRAFT->value;  // pending
            $order->payment_status = PaymentStatusEnum::DRAFT->value;
            // $order->address_id = Auth::user()->addresses()->first()->id;

            $order->save();

            $orderItem = $order->orderItems()->create([
                'product_id' => $product->id,
                'price' => $product->discounted_price,
                'quantity' => $request->validated()['quantity'],
                'product_attributes' => [
                    'size' => $request->validated()['selectedSize'],
                    'color' => $request->validated()['selectedColor'],
                ],

            ]);

            // dd($request->session()->all());
            return redirect()->route('kahani.checkout', ['order' => $order]);
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

    public function proceedToCheckout(Request $request, Order $order)
    {
        return redirect()->route('kahani.checkout', ['order' => $order]);
    }

    public function processCheckout(CheckoutRequest $request, Order $order)
    {
        // Check if user is authorized to checkout this order
        if (Auth::check()) {
            if ($order->user_id !== Auth::user()->id) {
                abort(404, 'Not Found');
            }
        } elseif (Auth::guest()) {
            if ($order->user_id !== null) {
                abort(404, 'Not Found');
            }
        }

        // dd($order);

        // Checking if Order Items are enabled and in stock
        foreach ($order->orderItems as $orderItem) {
            $product = $orderItem->product;

            if (! $product->inStock()) {
                return redirect()->back()->with('error', 'Product '.$product->name.' is out of stock.');
            }
            if (! $product->active()) {
                return redirect()->back()->with('error', 'Product '.$product->name.' is not available at the moment.');
            }
        }
        // store address

        if (Auth::guest()) {

            $validated = $request->validate([
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'address1' => 'required|string|max:255',
                'address2' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'postalCode' => 'required|string|max:255',
            ]);
            // store address to $order

            $order->address_id = Address::create([
                'name' => $validated['fname'].' '.$validated['lname'],
                'address1' => $validated['address1'],
                'address2' => $validated['address2'],
                'city' => $validated['city'],
                'state' => $validated['province'],
                'postalCode' => $validated['postalCode'],
                'country' => 'Pakistan',
                // 'phone' => $validated['phone'],
            ])->id;
        }

        if (Auth::check()) {

            $validated = $request->validated();

            if ($request->input('new_address.use_address') && ! $request->input('address_id')) {
                $order->address_id = Address::create([
                    'user_id' => Auth::user()->id,
                    'name' => $validated['new_address']['full_name'],
                    'email' => $validated['new_address']['email'],
                    'phone' => $validated['new_address']['phone'],
                    'address1' => $validated['new_address']['address_line_1'],
                    'address2' => $validated['new_address']['address_line_2'] ?? null,
                    'city' => $validated['new_address']['city'],
                    'state' => $validated['new_address']['state'],
                    'country' => $validated['new_address']['country'],
                    'postalCode' => $validated['new_address']['postal_code'],
                    'is_default' => $validated['new_address']['is_default'] ?? false,
                ])->id;
            } else {
                $order->address_id = $validated['address_id'];
            }

        }

        // Increments to Product clicks and discounts etc
        $order->orderItems->each(function ($item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->increment('clicks');
            }
        });

        if ($order->discount) {
            $order->discount->increment('usage_count');
        }

        // Calculate Subtotal, delivery_cost and store to order
        $order->subtotal = $order->calculateSubTotal();
        // $order->delivery_cost = 0;
        // $order->total = $order->total();
        // $cargoCompany = CargoCompany::find($validated['cargo_company_id']);

        // $order->save();

        // change order->order_status to CONFIRMED
        $order->order_status = OrderTrackingStatusEnum::CONFIRMED->value;

        // change order->payment_status to PENDING
        $order->payment_status = PaymentStatusEnum::PENDING->value;

        // Email The Customer
        // $order->sendOrderConfirmationEmail();

        $order->save();

        return redirect()->route('kahani.home')->with('success', 'Order created successfully!');

        return redirect()->route('kahani.checkout');
    }

    public function checkout(Order $order)
    {
        // Check if user is authorized to checkout this order
        if (Auth::check()) {
            if ($order->user_id !== Auth::user()->id) {
                abort(404, 'Not Found');
            }
        } elseif (Auth::guest()) {
            if ($order->user_id !== null) {
                abort(404, 'Not Found');
            }
        }

        // dd($order);

        $user = Auth::user();
        // $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        $addresses = Auth::user() ? Address::where('user_id', Auth::user()->id)->get() : [];

        // $order = Order::where('user_id', Auth::user()->id)
        //     ->where('order_status', 'processing')
        //     ->firstOrFail();

        $order->load('orderItems.product');
        // dd($order);
        // if (Auth::check()) {
        //     $order = Order::where('user_id', Auth::user()->id)
        //         ->where('order_status', 'processing')
        //         ->firstOrFail();

        //     $order->load('orderItems.product');
        //     dd($order);
        // } else {
        //     // single cart checkout
        //     // $order = null;

        //     // abort(404);
        // }

        // dd($order);
        return view('kahani-apparel.checkout', compact('addresses', 'user', 'order'));
    }

    public function coupon_apply(Request $request, Order $order)
    {
        // dd($request->all());

        // $order = Order::where('user_id', Auth::user()->id)
        //     ->where('order_status', 'processing')
        //     ->firstOrFail();

        if ($order->discount_id) {
            return back()
                ->with('error', 'Coupon already applied.');
        }

        $coupon = Discount::where('code', $request->coupon)->first();

        if (! $coupon || ! $coupon->isValid() || $coupon->isExpired() || ! $coupon->isActive() || $coupon->isUsed()) {
            return back()->with('error', 'Invalid or expired coupon.');
        }

        // Debugging Coupon code

        // if (! $coupon) {
        //     return back()->with('error', 'Invalid coupon.');
        // }

        // if (! $coupon->isValid()) {
        //     return back()->with('error', 'Coupon is not valid.');
        // }

        // if ($coupon->isExpired()) {
        //     return back()->with('error', 'Coupon has expired.');
        // }

        // if (! $coupon->isActive()) {
        //     return back()->with('error', 'Coupon is not active.');
        // }

        // if ($coupon->isUsed()) {
        //     return back()->with('error', 'Coupon has already been used.');
        // }
        // ==================================================================

        $order->discount_id = $coupon->id;
        $order->save();

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function coupon_remove(Request $request, Order $order)
    {
        // $order = Order::where('user_id', Auth::user()->id)
        //     ->where('order_status', 'processing')
        //     ->firstOrFail();

        $order->discount_id = null;
        $order->save();

        return back()->with('success', 'Coupon removed successfully!');
    }
}
