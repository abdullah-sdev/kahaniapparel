<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Address;
use App\Models\CargoCompany;
use App\Models\Discount;
use App\Models\Order;
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
        $products = Product::with('colors', 'sizes')->get();
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

        $defaultAttributes = [
            "size" => "M",
            "color" => "yellow"
        ];

        $items = collect($validated['items'])->map(function ($item) use ($defaultAttributes) {
            $product = Product::find($item['product_id']);
            return [
                'product_id' => $item['product_id'],
                'price' => $product ? $product->discounted_price : 0,
                'quantity' => $item['quantity'],
                'product_attributes' => $item['attributes'] ?? $defaultAttributes,
            ];
        });
        $subtotal = $items->sum(fn($item) => $item['price'] * $item['quantity']);
        // Get delivery cost (example: fixed $5 or from cargo company)
        $cargoCompany = CargoCompany::find($validated['cargo_company_id']);
        $deliveryCost = $cargoCompany?->base_price ?? 5.00;

        // dd($items, $subtotal, $deliveryCost);


        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $validated['address_id'], //  ?? $this->createNewAddress($validated['new_address'] ?? []),
            'payment_status' => 'pending',
            'order_status' => 'processing',
            // 'tracking_number' => $validated['tracking_number'],
            'payment_type' => $validated['payment_type'],
            'cargo_company_id' => $cargoCompany->id ?? null,
            'discount_id' => $validated['discount_id'] ?? null,
            'subtotal' => $subtotal,
            'delivery_cost' => $deliveryCost,
        ]);

        // Add order items
        $order->orderItems()->createMany($items->toArray());

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
