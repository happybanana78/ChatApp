<?php

namespace App\Http\Livewire;

use App\Models\Rooms;
use App\Models\User;
use App\Models\Chats;
use Livewire\Component;
use Livewire\WithFileUploads;

class Chat extends Component
{

    use WithFileUploads;

    // Chat room proprieties
    public $entry;
    public $isActive;
    public $roomMsg;
    public $roomStatus;

    // Create chat room proprieties
    public $roomName;
    public $roomCapacity;
    public $rooms;

    // User proprieties
    public $userName;
    public $newUsername;
    public $userAvatar;

    public function __construct()
    {
        $this->rooms = Rooms::latest()->get();
        $this->isActive = false;
        $this->roomStatus = false;
        $this->roomMsg = array();
    }

    // Show new chat entry on screen
    public function newEntry($userId) {
        if (!empty($this->entry)) {
            if (str_contains($this->entry, "http")) {
                $urlPattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';   
                $this->entry = preg_replace($urlPattern, 
                '<a class="text-blue-500" href="$0" target="_blank">$0</a>', $this->entry);
            }
            switch ($this->entry) {
                case str_contains($this->entry, ":)"):
                    $this->entry = str_replace(":)", "&#128512;", $this->entry);
                    break;
                case str_contains($this->entry, ":D"):
                    $this->entry = str_replace(":D", "&#128513;", $this->entry);
                    break;
                case str_contains($this->entry, ":')"):
                    $this->entry = str_replace(":')", "&#128514;", $this->entry);
                    break;
                case str_contains($this->entry, "^^"):
                    $this->entry = str_replace("^^", "&#128516;", $this->entry);
                    break;
                case str_contains($this->entry, "><"):
                    $this->entry = str_replace("><", "&#128518;", $this->entry);
                    break;
                case str_contains($this->entry, ";)"):
                    $this->entry = str_replace(";)", "&#128521;", $this->entry);
                    break;
                case str_contains($this->entry, ":P"):
                    $this->entry = str_replace(":P", "&#128540;", $this->entry);
                    break;
                case str_contains($this->entry, ":("):
                    $this->entry = str_replace(":(", "&#128543;", $this->entry);
                    break;
                case str_contains($this->entry, ":'("):
                    $this->entry = str_replace(":'(", "&#128546;", $this->entry);
                    break;
                case str_contains($this->entry, "zzzz"):
                    $this->entry = str_replace("zzzz", "&#128564;", $this->entry);
                    break;
                default:
                    break;
            }
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
        $this->roomMsg = Chats::where("roomId", "=", $roomId)->orderBy("id")->get();
    }

    // Join chat room
    public function joinRoom($userId, $roomId) {
        $user = User::find($userId);
        $group = Rooms::find($roomId);
        $roomUsers = explode(",", $group->users);
        $userCounter = count($roomUsers);
        if (!(($userCounter + 1) > $group->capacity)) {
            $user->groups = $roomId;
            $user->update();
            if (!in_array($userId, $roomUsers)) {
                if (is_null($group->users)) {
                    $group->users = $userId;
                    $group->update();
                } else {
                    $group->users = $group->users . "," . $userId;
                    $group->update();
                }
            }
            $this->isActive = true;
            $this->roomStatus = true;
        }
    }

    // Delete chat room
    public function deleteRoom($roomId, $userId) {
        $room = Rooms::find($roomId);
        if ($room->Authority == $userId) {
            $room->delete();
            $users = User::all();
            foreach ($users as $user) {
                if ($user->groups == $roomId) {
                    $user->groups = null;
                    $this->isActive = false;
                }
            }
            $user->update();
            $chat = Chats::where("roomId", "=", $roomId);
            $chat->delete();
            $this->roomMsg = array();
            $this->chat = array();
            $this->rooms = Rooms::latest()->get();
        }
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

    // Edit username
    public function editUsername($userId) {
        $user = User::find($userId);
        $data = $this->validate([
            "newUsername" => "required|unique:users,username"
        ]);
        $user->username = $this->newUsername;
        $user->update();
    }

    // Change user profile avatar
    public function changeAvatar($userId) {
        //dd($this->userAvatar);
        $data = $this->validate([
                    "userAvatar" => "file|max:1024",
                ]);
        $this->userAvatar->storeAs("public/photos", $userId . ".png");
        $user = User::find($userId);
        $user->avatar = "/storage/photos/" . $userId . ".png";
        $user->update();
        $this->userAvatarPath = "/storage/photos/" . $userId . ".png";
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
