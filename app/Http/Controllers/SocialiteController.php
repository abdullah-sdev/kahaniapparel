<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Str;

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
            // dd($googleUser, $googleUser->id);

            $user = User::where('google_id', $googleUser->id)->first();
            // dd($user);
            if ($user) {
                Auth::login($user);

                return redirect()->route('kahani.home');
            } else {

                $userdata = User::create([
                    'first_name' => $googleUser->user['given_name'] ?? null,
                    'last_name' => $googleUser->user['family_name'] ?? null,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(32)),
                ]);
                $userdata->assignRole(RoleEnum::CUSTOMER->value);

                if ($userdata) {
                    Auth::login($userdata);

                    return redirect()->route('kahani.home');
                }
            }
        } catch (Exception $e) {
            // dd($e);
            // Log the error
            Log::error('Google Login Error', ['exception' => $e]);

            // Return the User
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
