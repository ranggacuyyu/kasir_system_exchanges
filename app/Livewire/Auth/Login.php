<?php 

namespace App\Livewire\auth;

use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $password = '';
    public string $user_type = 'kasir';

    public function render()
    {
        return view('livewire.auth.login');
    }


    public function setUserType(string $type)
    {
        $this->user_type = $type;        
    }
}