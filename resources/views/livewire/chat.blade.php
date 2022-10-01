<div id="main">
    <div class="container absolute left-1/2 py-10 -translate-x-1/2 top-12
text-light text-3xl text-center space-x-10 font-bold">
    <a class="hover:text-blue-500" href="#">
        <i class="fa-solid fa-comments mr-3"></i>Chat</a>
    <a class="hover:text-blue-500" href="#">
        <i class="fa-solid fa-gear mr-3"></i>Settings</a>
    <a class="hover:text-red-500" href="#" wire:click="logout">
        <i class="fa-solid fa-right-from-bracket mr-3"></i>Logout</a>
</div>
<script>
    function test() {
        var test = document.getElementById("test");
        test.scrollTop = test.scrollHeight;
    }
</script>
<div class="container rounded-lg mx-auto p-20 w-full bg-slate-900 mt-60">
    <div id="test" class="container mx-auto w-full p-5 h-56 bg-white rounded-lg
    overflow-auto text-xl">
        @foreach ($chat as $message)
            <p class=""><b>{{auth()->user()->username}}: </b>{{$message}}</p>
        @endforeach
    </div>
    <form wire:submit.prevent="newEntry" class="flex space-x-3" method="POST" onkeydown="test()">
        <input wire:model="entry" class="p-1 px-3 w-full rounded-lg mt-2" type="text">
        <button class="text-4xl text-slate-900 bg-blue-500 py-1 px-5
        rounded-lg mt-2"><i class="fa-solid fa-paper-plane hover:text-light" onclick="test()"></i></button>
    </form>
</div>
</div>