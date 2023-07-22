<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EndProfileController extends Controller
{
    public function profile ()
    {
        return view("end.profile", [
            'contact' => auth()->user()->contact,
        ]);
    }

    public function updateProfile(Request $request) {
        auth()->user()->contact->update($request->all());

        return redirect()->route('end.profile')->with(['success' => ['Profile updated successfully']]);
    }

    public function changePassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error'=> $validator->errors()->all()]);
        }

        if(!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with([
                'error' => ['Incorrect old password'],
            ]);
        }


        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('end.profile')->with(['success' => ['Password updated successfully']]);
    }

}
