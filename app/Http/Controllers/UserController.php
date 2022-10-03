<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Create new user account
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
        return redirect()->to("/");
    }

    // Login user
    public function login(Request $request) {
        $data = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);
        if (auth()->attempt($data)) {
            $request->session()->regenerate();
            return redirect()->to("/control");
        } else {
            $request->session()->regenerate();
            return redirect()->to("/");
        }
    }

    // Logout user
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to("/");
    }
}
