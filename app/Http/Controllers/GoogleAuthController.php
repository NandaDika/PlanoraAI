<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $google = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $google->email)->first();

            if ($user) {
                // linkkan akuk ketika user sudah ada
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $google->id,
                        'avatar' => $google->avatar,
                    ]);
                }
            } else {
                // Buat user baru dari data google
                $user = User::create([
                    'name' => $google->getName(),
                    'email' => $google->getEmail(),
                    'google_id' => $google->getId(),
                    'avatar' => $google->getAvatar(),
                    'password' => bcrypt(str()->random(16)),
                    'role' => 'user',
                    'is_google' => 1,
                ]);
            }

            Auth::login($user, true);
            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')
            ->with('error', 'Login Google dibatalkan atau gagal.');
        }
    }
}
