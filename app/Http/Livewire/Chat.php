<?php

namespace App\Http\Livewire;

use App\Models\Rooms;
use Livewire\Component;

class Chat extends Component
{

    // Chat room proprieties
    public $entry;
    public $chat = array();

    // Create chat room proprieties
    public $roomName;
    public $roomCapacity;
    public $rooms;

    public function __construct()
    {
        $this->rooms = Rooms::all();
    }

    // Show new chat entry on screen
    public function newEntry() {
        if (!empty($this->entry)) {
            array_push($this->chat, $this->entry);
            $this->entry = "";
        }
    }

    // Create new chat room
    public function createRoom() {
        $data = $this->validate([
                "roomName" => ["required", "unique:rooms,name"],
                "roomCapacity" => ["required"]
            ]);
        Rooms::create([
            "name" => $data["roomName"],
            "capacity" => $data["roomCapacity"]
        ]);
        $this->rooms = Rooms::all();
    }

    public function logout() {
        auth()->logout();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
