<?php

namespace App\Http\Traits;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait ContactTrait {
    public function createContact($request) {
        $data = [
            "status" => "success",
            "obj" => Contact::create($request->all()),
        ];
        return $data;
    }

    public function updateContact($request, $id) {
        $data = [
            "status" => "success",
            "obj" => Contact::find($id)->update($request->all()),
        ];
        return $data;
    }

    public function deleteContact($id) {
        $data = [
            "status" => "success",
            "obj" => Contact::find($id)->delete(),
        ];
        return $data;
    }

    public function deleteUser($id) {
        $data = [
            "status" => "success",
            "obj" => User::find($id)->delete(),
        ];
        return $data;
    }

    public function createUser($request) {
        $data = [
            "status" => null,
            "obj" => null,
            "error" => null
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users'
        ]);

        if ($validator->fails()) {
            $data["status"] = "failed";
            $data["error"] = $validator->errors()->all();
            return $data;
        }

        $data["status"] = "success";
        $data["obj"] = User::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);


        return $data;
    }

    public function updateUser($request, $id) {
        $data = [
            "status" => null,
            "obj" => null,
            "error" => null
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        if ($validator->fails()) {
            $data["status"] = "failed";
            $data["error"] = $validator->errors()->all();
            return $data;
        }

        $data["status"] = "success";

        $vals = $request->all();

        if($vals['password'] == "JOMARPOGI") {
            unset($vals['password']);
        } else {
            $vals['password'] = Hash::make($vals['password']);
            // dd($vals);
        }
        $user = User::find($id);
        $user->update($vals);

        $data["obj"] = $user;

        return $data;
    }
    
}