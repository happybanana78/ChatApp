<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Chat extends Component
{

    public $entry;
    public $chat = array();

    public function newEntry() {
        if (!empty($this->entry)) {
            array_push($this->chat, $this->entry);
            $this->entry = "";
        }
    }

    public function logout() {
        auth()->logout();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
