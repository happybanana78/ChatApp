<div x-data="{popBg: false, chat: false, settings: false}" id="main">
    <div class="container absolute left-1/2 py-10 -translate-x-1/2 top-12
    text-light text-3xl justify-center space-x-10 font-bold sm:flex hidden top-32 md:top-10">
        <a class="hover:text-blue-500 cursor-pointer" 
        x-on:click="chat = !chat, popBg = !popBg, 
        document.getElementById('body').classList.add('hide-scroll')">
            <i class="fa-solid fa-comments mr-3"></i>Chat</a>
        <a class="hover:text-blue-500 cursor-pointer"
        x-on:click="popBg = !popBg, settings = !settings,
        document.getElementById('body').classList.add('hide-scroll')">
            <i class="fa-solid fa-gear mr-3"></i>Settings</a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="hover:text-red-500">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>Logout</button>
        </form>
    </div>
    <!-- Mobile menu -->
    <div x-data="{mobileMenu: false, mobileMenuBg: false}">
        <div class="absolute top-0 left-0 h-screen z-10 w-full"
        x-on:click="mobileMenu = false, mobileMenuBg = false" 
        x-show="mobileMenuBg" x-cloak></div>
        <div class="text-white text-5xl absolute right-5 top-10 block sm:hidden
        cursor-pointer">
            <i class="fa-solid fa-bars" x-on:click="mobileMenu = !mobileMenu,
            mobileMenuBg = !mobileMenuBg"></i>
        </div>
        <div class="container py-10 text-center top-40 absolute z-30 bg-slate-900
        text-light text-3xl justify-center space-y-4 font-bold flex flex-col sm:hidden
        border-b-4 border-blue-500" x-show="mobileMenu" x-cloak>
            <a class="hover:text-blue-500 cursor-pointer" 
            x-on:click="chat = !chat, popBg = !popBg,
            mobileMenu = false, mobileMenuBg = false">
                <i class="fa-solid fa-comments mr-3"></i>Chat</a>
            <a class="hover:text-blue-500 cursor-pointer"
            x-on:click="popBg = !popBg, settings = !settings,
            mobileMenu = false, mobileMenuBg = false">
                <i class="fa-solid fa-gear mr-3"></i>Settings</a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="hover:text-red-500">
                    <i class="fa-solid fa-right-from-bracket mr-3"></i>Logout</button>
            </form>
        </div>
    </div>
@include('partials._chat')
@include('partials._settings')
<div class="container rounded-lg mx-auto lg:p-20 p-5 w-full bg-slate-900 md:mt-52 z-0 relative
sm:mt-72 mt-52">
    @php
        // Prevent error when user logs in with no room id aggigned yet
        $group = 0;
    @endphp
    @if (!is_null(auth()->user()->groups))
        @php
            $group = auth()->user()->groups;
        @endphp
    @endif
    <div wire:poll.750ms.keep-alive="updateMsg({{$group}})" id="chatBox" 
        class="container mx-auto w-full p-5 pr-10 lg:h-56 h-80 bg-white rounded-lg
        overflow-y-auto overflow-x-hidden text-xl flex flex-col-reverse">
        <div class="flex flex-col">
        @if (!is_null(auth()->user()->groups))
            @if ($roomStatus)
                @foreach ($roomMsg as $msg)
                    <div class="flex justify-between">
                        <p style="overflow-wrap: break-word; inline-size: fit-content;" 
                        class="max-w-full mb-2 pr-5"><b>{{$msg["userName"]}}: </b>
                            @php
                                echo trim($msg["message"], '"')
                            @endphp
                        </p>
                        <div wire:click="deleteMsg({{$msg["id"]}}, {{auth()->user()->id}}, {{$msg["RoomId"]}})">
                            <i class="fa-solid fa-trash cursor-pointer"></i>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
                </div>
    </div>
    <form wire:submit.prevent="newEntry({{auth()->user()->id}})" 
        class="flex" method="POST">
        @csrf
        @if (!$isActive)
        <input wire:model.defer="entry" class="p-1 px-3 w-full rounded-lg mt-2" type="text"
        placeholder="Join a group to chat..." disabled>
        <button type="button" class="text-4xl text-slate-900 bg-blue-500 py-1 px-5
        rounded-lg mt-2 ml-3" x-on:click="chat = !chat, popBg = !popBg">
        <i class="fa-solid fa-paper-plane hover:text-light"></i></button>
        @endif
        @if ($isActive)
            <input wire:model.defer="entry" class="p-1 px-3 w-full rounded-lg mt-2" type="text"
            placeholder="Write a message...">
            <button type="submit" class="text-4xl text-slate-900 bg-blue-500 py-1 px-5
            rounded-lg mt-2 ml-3"><i class="fa-solid fa-paper-plane hover:text-light"></i></button>
        @endif
    </form>
</div>
</div>