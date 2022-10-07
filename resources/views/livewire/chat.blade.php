<div x-data="{popBg: false, chat: false, settings: false}" id="main">
    <div class="container absolute left-1/2 py-10 -translate-x-1/2 top-12
    text-light text-3xl justify-center space-x-10 font-bold flex">
        <a class="hover:text-blue-500 cursor-pointer" 
        x-on:click="chat = !chat, popBg = !popBg, 
        document.getElementById('body').classList.add('hide-scroll')">
            <i class="fa-solid fa-comments mr-3"></i>Chat</a>
        <a class="hover:text-blue-500 cursor-pointer"
        x-on:click="popBg = !popBg, settings = !settings">
            <i class="fa-solid fa-gear mr-3"></i>Settings</a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="hover:text-red-500">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>Logout</button>
        </form>
    </div>
@include('partials._chat')
@include('partials._settings')
<div class="container rounded-lg mx-auto p-20 w-full bg-slate-900 mt-52">
    @php
        // Prevent error when user logs in with no room id aggigned yet
        $group = 0;
    @endphp
    @if (auth()->user()->groups != NULL)
        @php
            $group = auth()->user()->groups;
        @endphp
    @endif
    <div wire:poll.750ms.keep-alive="updateMsg({{$group}})" id="chatBox" 
        class="container mx-auto w-full p-5 pr-10 h-56 bg-white rounded-lg
        overflow-y-auto overflow-x-hidden text-xl flex flex-col-reverse">
        <div class="flex flex-col">
        @if (auth()->user()->groups != NULL)
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