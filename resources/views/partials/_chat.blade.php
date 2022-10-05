<div x-show="popBg" x-cloak 
x-on:click="chat = false, popBg = false,
document.getElementById('body').classList.remove('hide-scroll')" 
class="absolute pop-bg w-full left-0 right-0 top-0 h-screen"></div>
<div class="absolute top-0 w-full top-40">
    <div class="container relative left-1/2 -translate-x-1/2 w-1/2 h-1/3 rounded-lg bg-slate-900
    p-5" x-show="chat" x-cloak>
        <div class="text-4xl text-right">
            <a class="cursor-pointer text-light" 
            x-on:click="chat = false, popBg = false,
            document.getElementById('body').classList.remove('hide-scroll')">
                <i class="fa-solid fa-xmark"></i></a>
        </div>
        <div class="flex justify-between px-10 items-center mt-5 space-x-5 relative
        pb-5" 
        x-data="{createRoom1: true, createRoom2: false}">
            <div class="bg-slate-700 relative overflow-auto h-40 w-1/2 rounded-lg p-5
            flex flex-col">
                @foreach ($rooms as $room)
                    <div class="text-slate-900 text-xl flex flex-col mb-5">
                        <div class="flex flex-row space-x-3 items-center">
                            <p class="cursor-pointer bg-blue-500 py-1
                            px-3 rounded-lg w-full" 
                            wire:click="joinRoom({{auth()->user()->id}}, {{$room->id}})"
                            x-on:click="chat = false, popBg = false, scroll2()">{{$room->name}}</p>
                            <form wire:submit.prevent="deleteRoom({{$room->id}})" method="POST">
                                <button type="submit" class="px-3 py-1 text-white bg-red-500
                                rounded-lg hover:bg-red-600">
                                    <i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div x-show="createRoom1">
                <button class="px-3 py-2 text-2xl bg-blue-500 text-white
                rounded-lg hover:border-2 hover:border-white border-2
                border-slate-900"
                x-on:click="createRoom1 = !createRoom1, createRoom2 = !createRoom2">Create New Room</button>
            </div>
            <div class="container w-1/2 px-10" x-show="createRoom2">
                <form wire:submit.prevent="createRoom" method="POST" class="flex flex-col
                justify-center items-center space-y-3">
                    @csrf
                    @error('roomName')
                    <div class="text-center">
                        <h2 class="text-red-500">{{$message}}</h2>
                    </div>
                    @enderror
                    @error('roomCapacity')
                    <div class="text-center">
                        <h2 class="text-red-500">{{$message}}</h2>
                    </div>
                    @enderror
                    <div class="flex space-x-3">
                        <input class="w-full px-3 py-1 rounded-lg text-xl" type="text"
                        placeholder="Room Name" wire:model="roomName">
                        <input class="w-1/2 px-3 py-1 rounded-lg text-xl" type="number"
                        wire:model="roomCapacity" placeholder="N#">
                    </div>
                    <button class="px-3 py-1 text-xl bg-blue-500 text-white
                    rounded-lg hover:border-2 hover:border-white border-2
                    border-slate-900">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>