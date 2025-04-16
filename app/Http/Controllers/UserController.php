<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::select('id', 'first_name', 'last_name', 'email', 'phone', 'gender', 'dateOfBirth')->withTrashed()->paginate(10);
        $data = compact('users');

        return view('admin.users.index', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if (Auth::user()->cannot('delete', $user)) {
            abort(403);
        }

        if ($user->trashed()) {
            $user->forceDelete();
        } else {
            $user->delete();
        }

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
