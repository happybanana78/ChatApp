<div x-data="{popBg: false, chat: false}" id="main">
    <div class="container absolute left-1/2 py-10 -translate-x-1/2 top-12
    text-light text-3xl justify-center space-x-10 font-bold flex">
        <a class="hover:text-blue-500 cursor-pointer" 
        x-on:click="chat = !chat, popBg = !popBg, 
        document.getElementById('body').classList.add('hide-scroll')">
            <i class="fa-solid fa-comments mr-3"></i>Chat</a>
        <a class="hover:text-blue-500" href="#">
            <i class="fa-solid fa-gear mr-3"></i>Settings</a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="hover:text-red-500">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>Logout</button>
        </form>
    </div>
<script>
    function test() {
        var test = document.getElementById("test");
        test.scrollTop = test.scrollHeight;
    }
</script>
@include('partials._chat')
<div class="container rounded-lg mx-auto p-20 w-full bg-slate-900 mt-52">
    <div id="test" class="container mx-auto w-full p-5 h-56 bg-white rounded-lg
    overflow-auto text-xl">
        @foreach ($chat as $message)
            <p class=""><b>{{auth()->user()->username}}: </b>{{$message}}</p>
        @endforeach
    </div>
    <form wire:submit.prevent="newEntry({{auth()->user()->id}})" 
        class="flex space-x-3" method="POST" onkeydown="test()">
        @if (!$isActive)
        <input wire:model="entry" class="p-1 px-3 w-full rounded-lg mt-2" type="text"
        placeholder="Write a message..." disabled>
        <button type="button" class="text-4xl text-slate-900 bg-blue-500 py-1 px-5
        rounded-lg mt-2" x-on:click="chat = !chat, popBg = !popBg">
        <i class="fa-solid fa-paper-plane hover:text-light" onclick="test()"></i></button>
        @endif
        @if ($isActive)
            <input wire:model="entry" class="p-1 px-3 w-full rounded-lg mt-2" type="text"
            placeholder="Write a message...">
            <button type="submit" class="text-4xl text-slate-900 bg-blue-500 py-1 px-5
            rounded-lg mt-2"><i class="fa-solid fa-paper-plane hover:text-light" onclick="test()"></i></button>
        @endif
    </form>
</div>
</div>