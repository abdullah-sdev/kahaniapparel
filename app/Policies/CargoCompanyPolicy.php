<?php

namespace App\Policies;

use App\Models\CargoCompany;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CargoCompanyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CargoCompany $cargoCompany): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        $authUser = Auth::user();

        // dd($authUser);
        return Auth::check();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CargoCompany $cargoCompany): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CargoCompany $cargoCompany): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CargoCompany $cargoCompany): bool
    {
        return Auth::check();
    }
}
