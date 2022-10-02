<div x-show="popBg" x-on:click="chat = false, popBg = false" 
class="absolute pop-bg w-full left-0 right-0 top-0 h-screen"></div>
<div class="container absolute left-1/2 -translate-x-1/2 w-1/2 h-1/3 rounded-lg bg-slate-900 top-56
p-5" x-show="chat">
    <div class="text-4xl text-right">
        <a class="cursor-pointer text-light" x-on:click="chat = false, popBg = false">
            <i class="fa-solid fa-xmark"></i></a>
    </div>
    <div class="flex justify-between px-20 items-center">
        <div class="container bg-light overflow-auto h-56 w-1/2 rounded-lg"></div>
        <div>
            <form wire:submit.prevent="createRoom" method="POST">
                @csrf
                <button class="px-5 py-3 text-2xl bg-blue-500 text-white
                rounded-lg hover:border-2 hover:border-white border-2
                border-slate-900">Create New Room</button>
            </form>
        </div>
    </div>
</div>