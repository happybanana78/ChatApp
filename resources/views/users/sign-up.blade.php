@extends('layout')

@section('signup')

<div class="container mx-auto bg-slate-900 p-10 mt-40 mb-20 rounded-lg">
    <div class="text-center mb-10">
        <h2 class="text-white font-bold text-4xl">Create an Account</h2>
    </div>
    <form action="/create" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-light font-bold text-xl mb-1" for="email">Email</label>
            <input class="w-full py-1 rounded px-3 text-xl bg-slate-600
            text-white focus:outline-blue-800 focus:border-2 focus:shadow-sm" 
            type="email" name="email" id="email" autocomplete="off">
            @error('email')
                <p class="text-red-500 text-xl mt-2">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-light font-bold text-xl mb-1" for="username">Username</label>
            <input class="w-full py-1 rounded px-3 text-xl bg-slate-600
            text-white focus:outline-blue-800 focus:border-2 focus:shadow-sm" 
            type="text" name="username" id="username" autocomplete="off">
            @error('username')
                <p class="text-red-500 text-xl mt-2">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-light font-bold text-xl mb-1" for="password">Password</label>
            <input class="w-full py-1 rounded px-3 text-xl bg-slate-600
            text-white focus:outline-blue-800 focus:border-2 focus:shadow-sm" 
            type="password" name="password" id="password" autocomplete="off">
            @error('password')
                <p class="text-red-500 text-xl mt-2">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-light font-bold text-xl mb-1" 
            for="password_confirmation">Repeat Password</label>
            <input class="w-full py-1 rounded px-3 text-xl bg-slate-600
            text-white focus:outline-blue-800 focus:border-2 focus:shadow-sm" 
            type="password" name="password_confirmation" id="password_confirmation" autocomplete="off">
            @error('password_confirmation')
                <p class="text-red-500 text-xl mt-2">{{$message}}</p>
            @enderror
        </div>
        <div class="text-right mt-10">
            <button class="p-3 px-8 bg-blue-900 text-white rounded-md text-xl
            hover:border-2 hover:border-white border-2 border-slate-900">Create Account</button>
        </div>
    </form>
</div>

@endsection