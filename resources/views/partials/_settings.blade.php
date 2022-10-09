<div x-show="settings" x-cloak x-data="{userEdit: false}"
class="absolute top-40 w-full lg:px-80 h-1/2 z-30">
    <div class="p-5 container mx-auto h-full bg-slate-900 rounded-lg">
        <div class="text-4xl text-right hidden lg:block">
            <a class="cursor-pointer text-light" 
            x-on:click="settings = false, popBg = false,
            document.getElementById('body').classList.remove('hide-scroll')">
                <i class="fa-solid fa-xmark"></i></a>
        </div>
        <div class="flex items-center justify-center lg:p-5 relative max-h-full
        mt-14 lg:mt-0">
            <div class="flex flex-col relative items-center space-y-5 w-1/4 p-3">
                <div class="container bg-blue-500 rounded-full  w-40">
                    <img src="{{auth()->user()->avatar}}" class="w-full cursor-pointer"
                    onclick="document.getElementById('avatarFile').click()">
                </div>
                <form wire:submit.prevent="changeAvatar({{auth()->user()->id}})"
                    method="POST" class="hidden" id="avatarForm">
                    @csrf
                    <input wire:model="userAvatar" id="avatarFile" type="file"
                    onchange="setTimeout(function () {document.getElementById('avatarBtn').click()}, 2000)">
                    <button type="submit" id="avatarBtn"></button>
                </form>
                <div class="text-center text-2xl text-white flex space-x-3">
                    <b>{{auth()->user()->username}}</b>
                    <div x-on:click="userEdit = !userEdit">
                        <i class="fa-solid fa-pen-to-square cursor-pointer"></i>
                    </div>
                </div>
                <div x-show="userEdit" x-cloak>
                    <form wire:submit.prevent="editUsername({{auth()->user()->id}})" method="POST" 
                        class="flex space-x-3">
                        @csrf
                        <input wire:model.defer="newUsername" type="text" class="py-1 px-3 text-md rounded-lg" 
                        placeholder="Enter new username...">
                        <button class="px-5 py-2 bg-blue-500 rounded-lg border-slate-900
                        hover:border-light text-white border-2">Change</button>
                    </form>
                    @error('newUsername')
                    <div class="text-center text-xl mt-3">
                        <p class="text-red-500">{{$message}}</p>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>