<div x-show="popBg" x-on:click="chat = false, popBg = false" 
class="absolute pop-bg w-full left-0 right-0 top-0 h-screen"></div>
<div class="container absolute left-1/2 -translate-x-1/2 w-1/2 h-1/3 rounded-lg bg-slate-900 top-56
p-5" x-show="chat">
    <div class="text-4xl text-right">
        <a class="cursor-pointer text-light" x-on:click="chat = false, popBg = false">
            <i class="fa-solid fa-xmark"></i></a>
    </div>
    <div class="flex justify-between px-20 items-center" 
    x-data="{createRoom1: true, createRoom2: false}">
        <div class="container bg-light overflow-auto h-56 w-1/2 rounded-lg"></div>
        <div x-show="createRoom1">
            <button class="px-5 py-3 text-2xl bg-blue-500 text-white
            rounded-lg hover:border-2 hover:border-white border-2
            border-slate-900"
            x-on:click="createRoom1 = !createRoom1, createRoom2 = !createRoom2">Create New Room</button>
        </div>
        <div class="container w-1/2 px-20" x-show="createRoom2">
            <form wire:submit.prevent="createRoom" method="POST" class="flex flex-col
            justify-center items-center space-y-3">
                @csrf
                <input class="w-full px-3 py-1 rounded-lg text-xl" type="text"
                placeholder="Room Name" wire:model="roomName">
                <button class="px-3 py-1 text-xl bg-blue-500 text-white
                rounded-lg hover:border-2 hover:border-white border-2
                border-slate-900">Create</button>
            </form>
        </div>
    </div>
</div>