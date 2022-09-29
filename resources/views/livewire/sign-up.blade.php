<div class="container mx-auto bg-slate-900 p-10 mt-40 mb-20 rounded-lg">
    <div class="text-center mb-10">
        <h2 class="text-white font-bold text-4xl">Create an Account</h2>
    </div>
    <form wire:submit.prevent="createAccount" action="/create" method="POST">
        <div class="mb-4">
            <label class="block text-light font-bold text-xl mb-1" for="email">Email</label>
            <input wire:model="email" class="w-full py-1 rounded px-3 text-xl bg-slate-600
            text-white focus:outline-blue-800 focus:border-2 focus:shadow-sm" 
            type="text" id="email" name="email">
        </div>
        <div class="mb-4">
            <label class="block text-light font-bold text-xl mb-1" for="username">Username</label>
            <input wire:model="username" class="w-full py-1 rounded px-3 text-xl bg-slate-600
            text-white focus:outline-blue-800 focus:border-2 focus:shadow-sm" 
            type="text" name="username" id="username">
        </div>
        <div class="mb-4">
            <label class="block text-light font-bold text-xl mb-1" for="password">Password</label>
            <input wire:model="password" class="w-full py-1 rounded px-3 text-xl bg-slate-600
            text-white focus:outline-blue-800 focus:border-2 focus:shadow-sm" 
            type="text" name="password" id="password">
        </div>
        <div class="text-right mt-10">
            <button class="p-3 px-8 bg-blue-900 text-white rounded-md text-xl
            hover:border-2 hover:border-white border-2 border-slate-900">Create Account</button>
        </div>
    </form>
</div>
