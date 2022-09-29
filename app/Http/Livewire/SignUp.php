<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SignUp extends Component
{
    public $email;
    public $username;
    public $password;

    public function createAccount() {
        
    }

    public function render()
    {
        return view('livewire.sign-up');
    }
}
