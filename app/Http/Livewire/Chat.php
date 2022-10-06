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
    public $roomMsg;
    public $roomStatus;

    // Create chat room proprieties
    public $roomName;
    public $roomCapacity;
    public $rooms;

    // User proprieties
    public $userName;

    public function __construct()
    {
        $this->chat = array();
        $this->rooms = Rooms::latest()->get();
        $this->isActive = false;
        $this->roomStatus = false;
    }

    // Show new chat entry on screen
    public function newEntry($userId) {
        if (!empty($this->entry)) {
            array_push($this->chat, $this->entry);
            $user = User::find($userId);
            Chats::create([
                "message" => $this->entry,
                "userId" => $userId,
                "userName" => $user->username,
                "roomId" => $user->groups
            ]);
            $this->entry = "";
        }
    }

    // Create new chat room
    public function createRoom($userId) {
        $data = $this->validate([
                "roomName" => ["required", "unique:rooms,name"],
                "roomCapacity" => "required|numeric|min:2|max:100"
            ]);
        Rooms::create([
            "name" => $data["roomName"],
            "capacity" => $data["roomCapacity"],
            "Authority" => $userId
        ]);
         
        $this->roomName = "";
        $this->roomCapacity = "";
        $this->rooms = Rooms::latest()->get();
    }

    // Live update of the chat room
    public function updateMsg($roomId) {
        if ($roomId != 0) {
        $this->roomMsg = array();
        $this->roomMsg = Chats::where("roomId", "=", $roomId)->orderBy("id")->get();
        }
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
        $this->roomStatus = true;
        $this->roomMsg = Chats::where("roomId", "=", $roomId)->get();
    }

    // Delete chat room
    public function deleteRoom($id) {
        $room = Rooms::find($id);
        $room->delete();
        $users = User::all();
        foreach ($users as $user) {
            if ($user->groups == $id) {
                $user->groups = null;
                $this->isActive = false;
            }
        }
        $user->update();
        $chat = Chats::where("roomId", "=", $id);
        $chat->delete();
        $this->roomMsg = array();
        $this->chat = array();
        $this->rooms = Rooms::latest()->get();
    }

    // Delete single message
    public function deleteMsg($msgId, $userId, $roomId) {
        if ($roomId) {
            $msg = Chats::find($msgId);
            $room = Rooms::find($roomId);
            if ($room->Authority == $userId) {
                $msg->delete();
                $this->roomMsg = Chats::where("roomId", "=", $roomId)->get();
            }
        }
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
