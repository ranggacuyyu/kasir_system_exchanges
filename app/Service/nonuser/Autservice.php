<?php

namespace App\Service\nonuser;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authservice
{
    public function login(string $username, string $password, string $user_type)
    {
        // mengambil data user yang sesuai dengan username dan user_type yang diberikan
        $user = User::select('id', 'username', 'password', 'user_type', 'is_active')
            ->where('username', $username)
            ->where('user_type', $user_type)
            ->first();

        // melakukan pengecekan apakah user ditemukan dan penyesuaian password hash
        if (!$user || !Hash::check($password, $user->password)) {
            // mengembalikan vaidasi
            return $this->valueReturn(false, 'Username atau password salah.');
        }

        // melakukan pengecekan apakah user aktif
        if (!$user->is_active) {
            // mengembalikan validasi
            return $this->valueReturn(false, 'Akun Anda tidak aktif. Silakan hubungi administrator.');
        }

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

