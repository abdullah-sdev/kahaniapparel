<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Auth;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->cannot('viewAny', Color::class)) {
            abort(403);
        }
        $colors = Color::paginate(10);
        $data = compact('colors');

        return view('admin.colors.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::user()->cannot('create', Color::class)) {
            abort(403);
        }

        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        //
        if (Auth::user()->cannot('create', Color::class)) {
            abort(403);
        }
        Color::create($request->validated());

        return redirect()->route('admin.colors.index')->with('success', 'Color created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
        if (Auth::user()->cannot('view', $color)) {
            abort(403);
        }

        return view('admin.colors.show', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        //
        if (Auth::user()->cannot('update', $color)) {
            abort(403);
        }

        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        //
        if (Auth::user()->cannot('update', $color)) {
            abort(403);
        }
        $color->update($request->validated());

        return redirect()->route('admin.colors.index')->with('success', 'Color updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        //
    }
}
