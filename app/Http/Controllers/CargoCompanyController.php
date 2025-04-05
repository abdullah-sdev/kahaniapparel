<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargoCompanyRequest;
use App\Http\Requests\UpdateCargoCompanyRequest;
use App\Models\CargoCompany;
use Illuminate\Support\Facades\Auth;

class CargoCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->cannot('viewAny', CargoCompany::class)) {
            abort(403);
        }
        $cargoCompanies = CargoCompany::paginate(10);
        $data = compact('cargoCompanies');

        return view('admin.cargocompanies.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->cannot('create', CargoCompany::class)) {
            abort(403);
        }

        return view('admin.cargocompanies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargoCompanyRequest $request)
    {
        //
        if (Auth::user()->cannot('create', CargoCompany::class)) {
            abort(403);
        }
        CargoCompany::create($request->validated());
        redirect()->route('cargo-companies.index')->with('success', 'Cargo Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CargoCompany $cargoCompany)
    {
        //
        // if (Auth::user()->cannot('view', CargoCompany::class)) {
        //     abort(403);
        // }
        return view('admin.cargocompanies.show', compact('cargoCompany'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CargoCompany $cargoCompany)
    {
        //
        // dd(Auth::user()->first_name);
        if (Auth::user()->cannot('update', $cargoCompany)) {
            abort(403);
        }

        return view('admin.cargocompanies.edit', compact('cargoCompany'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCargoCompanyRequest $request, CargoCompany $cargoCompany)
    {
        //
        if (Auth::user()->cannot('update', $cargoCompany)) {
            abort(403);
        }
        $cargoCompany->update($request->validated());

        return redirect()->route('cargo-companies.index')->with('success', 'Cargo Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CargoCompany $cargoCompany)
    {
        //
        $cargoCompany->delete();

        return redirect()->route('cargo-companies.index')->with('success', 'Cargo Company deleted successfully');
    }
}
