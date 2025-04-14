<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    //

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication()
    {

        try {

            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser);

            $user = User::where('google_id', $googleUser->id)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('kahani.home');
            } else {
                $userdata = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => null,
                ])->syncRoles('customer');

                if ($userdata) {
                    Auth::login($user);
                    return redirect()->route('kahani.home');
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
