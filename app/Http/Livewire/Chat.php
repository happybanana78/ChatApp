<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Chat extends Component
{

    // Chat room proprieties
    public $entry;
    public $chat = array();

    // Create chat room proprieties
    public $roomName;

    // Show new chat entry on screen
    public function newEntry() {
        if (!empty($this->entry)) {
            array_push($this->chat, $this->entry);
            $this->entry = "";
        }
    }

    // Create new chat room
    public function createRoom() {

    }

    public function logout() {
        auth()->logout();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
