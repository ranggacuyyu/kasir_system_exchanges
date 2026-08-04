<?php

namespace App\Service\nonuser;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authservice
{
    // fungsi yang megambil parameter dan controller site
    /**
     * Login user dengan credentials yang diberikan
     * @param array $credentials array yang berisi credentials user
     * @param bool $rememberMe boolean untuk remember user
     * @return array array yang berisi status, message, dan redirect url
     */
    public function login(array $credentials, bool $rememberMe = false): array
    {
        // melakukan login user
        $user = (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => $credentials['role']
        ], $rememberMe)) {
            throw ValidationException::withMessages([
                'email' => 'Username atau password salah.',
            ]);
        };

        $user = Auth::user();

        // mengecek status aktif user
        if ($user->status )

        // melakukan login user
        Auth::login($user);
        // mengatur session untuk mencegah session fixation
        session()->regenerate();

        // mengembalikasn validasi
        return $this->valueReturn(true, 'Login berhasil.', $this->getRedirectUrl($user->user_type));
    }

    public function valueReturn($success, $message, $redirect=null)
    {
        return [
            'success' => $success,
            'message' => $message,
            'redirect' => $redirect
        ];
    }

    public function getRedirectUrl(string $user_type): string
    {
        switch ($user_type) {
            case 'admin':
                return route('admin.dashboard');
            case 'kasir':
                return route('kasir.dashboard');
            default:
                return route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }

}

