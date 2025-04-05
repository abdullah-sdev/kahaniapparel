<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->cannot('viewAny', Address::class)) {
            abort(403);
        }
        $addresses = Address::with('user')->paginate(10);
        $data = compact('addresses');

        return view('admin.address.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->cannot('create', Address::class)) {
            abort(403);
        }

        return view('admin.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        //
        if (Auth::user()->cannot('create', Address::class)) {
            abort(403);
        }
        Address::create($request->validated());

        return redirect()->route('addresses.index')->with('success', 'Address created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
        if (Auth::user()->cannot('view', $address)) {
            abort(403);
        }

        return view('admin.address.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
        if (Auth::user()->cannot('update', $address)) {
            abort(403);
        }

        return view('admin.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        //
        if (Auth::user()->cannot('update', $address)) {
            abort(403);
        }
        $address->update($request->validated());

        return redirect()->route('addresses.index')->with('success', 'Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
        if (Auth::user()->cannot('delete', $address)) {
            abort(403);
        }
        Address::destroy($address->id);

        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully');
    }
}
