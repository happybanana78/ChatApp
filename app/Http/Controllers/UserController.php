<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function createAccount(Request $request) {
        $data = $request->validate([
                    "email" => ["required", "unique:users,email"],
                    "username" => ["required", "unique:users,username"],
                    "password" => ["required", "min:5", "confirmed"]
                ]);
        $user = User::create([
            "username" => $data["username"],
            "email" => $data["email"],
            "password" => password_hash($data["password"], PASSWORD_DEFAULT)
        ]);
        auth()->login($user);
        return redirect()->to("/login");
    }

    public function login(Request $request) {
        
    }
}
