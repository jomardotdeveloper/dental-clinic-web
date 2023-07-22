<?php

namespace App\Http\Controllers;

use App\Http\Traits\ContactTrait;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EndLoginController extends Controller
{
    use ContactTrait;
    public function index()
    {
        return view('end.login');
    }

    public function register()
    {
        return view('end.register');
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->with(["error" => $validator->errors()->all()]);
        }
       
        $user = User::create([
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
        ]);

        $request->merge([
            "is_patient" => true,
            "user_id" => $user->id
        ]);

        $contact = Contact::create($request->all());

        return redirect()->route("end.login")->with(["success" => ["Successfully Registered"]]);

    }

    public function authenticate(Request $request){
        $validated = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $user = User::where("email", $validated["email"])->first();
        if($user && $user->contact->is_admin){
            return back()->with(["error" => ["Invalid Credentials"]]);
        }


        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();
            return redirect()->intended("/enddash");
        }

        // dd("JOMAR");
        return back()->with(["error" => ["Invalid Credentials"]]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("end.login");
    }
}
