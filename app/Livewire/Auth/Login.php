<?php

namespace App\Livewire\auth;

use Livewire\Component;
use App\Service\nonuser\Authservice;

class Login extends Component
{
    // inisasi property
    public $username = '';
    public $password = '';
    public string $user_type = 'kasir';

    // mendefinisikan rules untuk validasi input
    public function login(Authservice $authservice){
        // mengecek apakah user sudah mencapai batas percobaan login berdasarkan IP dan username
        $key = 'login-attempts:'.strtolower(trim($this->username)).'|'.request()->ip();

        // memberikan validasi pada inputan username dan password
        $this->validate( $this->rules(), $this->messages());

    }


    public function render()
    {
        return view('livewire.auth.login');
    }


    public function setUserType(string $type)
    {
        $this->user_type = $type;
    }
}
