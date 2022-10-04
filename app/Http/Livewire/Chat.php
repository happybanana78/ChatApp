<?php

namespace App\Http\Livewire;

use App\Models\Rooms;
use App\Models\User;
use App\Models\Chats;
use Livewire\Component;

class Chat extends Component
{

    // Chat room proprieties
    public $entry;
    public $chat;
    public $isActive;

    // Create chat room proprieties
    public $roomName;
    public $roomCapacity;
    public $rooms;
    public $test;

    public function __construct()
    {
        $this->chat = array();
        $this->rooms = Rooms::latest()->get();
        $this->isActive = false;
    }

    // Show new chat entry on screen
    public function newEntry($userId) {
        if (!empty($this->entry)) {
            array_push($this->chat, $this->entry);
            $user = User::find($userId);
            Chats::create([
                "message" => $this->entry,
                "userId" => $userId,
                "roomId" => $user->groups
            ]);
            $this->entry = "";
        }
    }

    // Create new chat room
    public function createRoom() {
        $data = $this->validate([
                "roomName" => ["required", "unique:rooms,name"],
                "roomCapacity" => "required|numeric|min:2|max:100"
            ]);
        Rooms::create([
            "name" => $data["roomName"],
            "capacity" => $data["roomCapacity"]
        ]);
        $this->roomName = "";
        $this->roomCapacity = "";
        $this->rooms = Rooms::latest()->get();
    }

    // Join chat room
    public function joinRoom($userId, $roomId) {
        $user = User::find($userId);
        $user->groups = $roomId;
        $user->update();
        $group = Rooms::find($roomId);
        $group->users = $group->users . "," . $userId;
        $group->update();
        $this->isActive = true;
        //$this->test = $user;
    }

    // Delete chat room
    public function deleteRoom($id) {
        $room = Rooms::find($id);
        $room->delete();
        $this->rooms = Rooms::latest()->get();
    }

    // Logout
    public function logout() {
        auth()->logout();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
