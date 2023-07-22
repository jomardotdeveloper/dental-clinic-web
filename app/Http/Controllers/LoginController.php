<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $validated = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $user = User::where("email", $validated["email"])->first();
        if($user && $user->contact->is_patient){
            return back()->with(["error" => ["Invalid Credentials"]]);
        }


        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();
            return redirect()->intended("/admin/dashboard");
        }

        // dd("JOMAR");
        return back()->with(["error" => ["Invalid Credentials"]]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login.page");
    }
}
