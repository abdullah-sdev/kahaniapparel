<?php

namespace App\Http\Controllers;

use App\Models\Sizes;
use App\Http\Requests\StoreSizesRequest;
use App\Http\Requests\UpdateSizesRequest;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sizes $sizes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sizes $sizes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizesRequest $request, Sizes $sizes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sizes $sizes)
    {
        //
    }
}
