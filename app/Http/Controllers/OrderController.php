<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Address;
use App\Models\CargoCompany;
use App\Models\Discount;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::where('user_id', Auth::user()->id)->paginate();

        // Auth::user()->id;
        // dd($orders, Auth::user()->id);
        $data = compact('orders');
        return view('admin.orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::where('id', Auth::user()->id)->get();
        $addresses = Address::where('user_id', Auth::user()->id)->get();
        $products = Product::all();
        $cargoCompanies = CargoCompany::all();
        $discounts = Discount::where('expires_at', '>', now())
            ->orWhereNull('expires_at')
            ->get();

            // dump($user->toArray());
            // die();
        return view('admin.orders.create', compact('users', 'addresses', 'products', 'cargoCompanies', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
        $validated = $request->validated();


        dd($validated, $request->all());

        // Calculate subtotal
        $subtotal = 0;
        $items = [];

        foreach ($validated->items as $item) {
            $product = Product::find($item->product_id);
            $price = $product->price;
            $quantity = $item->quantity;

            $items[] = [
                'product_id' => $product->id,
                'price' => $price,
                'quantity' => $quantity,
                'product_attributes' => $item['attributes'] ?? null,
            ];

            $subtotal += $price * $quantity;
        }

        // Get delivery cost (example: fixed $5 or from cargo company)
        $cargoCompany = CargoCompany::first(); // Or get from request
        $deliveryCost = $cargoCompany ? $cargoCompany->base_price : 5.00;

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $validated['address_id'],
            'payment_status' => 'pending',
            'order_status' => 'processing',
            'payment_type' => $validated['payment_type'],
            'cargo_company_id' => $cargoCompany->id ?? null,
            'subtotal' => $subtotal,
            'delivery_cost' => $deliveryCost,
        ]);

        // Add order items
        foreach ($items as $item) {
            $order->items()->create($item);
        }

        // Handle payment based on type
        if ($validated['payment_type'] === 'credit_card') {
            return $this->processCreditCardPayment($order);
        }

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    protected function processCreditCardPayment(Order $order)
    {
        // Implement your credit card payment logic here
        // For example, integrate with Stripe or other payment gateway

        // After successful payment:
        $order->markAsPaid();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Payment processed successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
        if (Auth::user()->cannot('view', $order)) {
            abort(403);
        }
        // $order->load(['items.product', 'address', 'cargoCompany', 'discount']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
        $cargoCompanies = CargoCompany::all();
        return view('admin.orders.edit', compact('order', 'cargoCompanies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
