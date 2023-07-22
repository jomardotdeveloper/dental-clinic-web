<?php

namespace App\Http\Traits;

use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

trait AppointmentTrait {
    public function createAppointment($request) {
        $data = [
            "status" => "",
            "obj" => null,
        ];
        
        $validator = Validator::make($request->all(), [
            'date' => 'required | date | after_or_equal:today',
        ]);


        if ($validator->fails()) {
            $data["status"] = "failed";
            $data["error"] = $validator->errors()->all();
            return $data;
        }

        $data["status"] = "success";
        $data["obj"] = Appointment::create($request->all());

        $services = $request->input('services');
        $data["obj"]->services()->attach($services);
        
        return $data;
    }

    public function updateAppointment($request, $id) {
        $data = [
            "status" => "",
            "obj" => null,
        ];
        
        $validator = Validator::make($request->all(), [
            'date' => 'required | date | after_or_equal:today',
        ]);


        if ($validator->fails()) {
            $data["status"] = "failed";
            $data["error"] = $validator->errors()->all();
            return $data;
        }

        $appointment = Appointment::find($id);
        $appointment->update($request->all());
        $data["status"] = "success";
        $data["obj"] = $appointment;
        $services = $request->input('services');
        $data["obj"]->services()->sync($services);
        
        return $data;
    }

    public function deleteAppointment($id) {
        $data = [
            "status" => "success",
            "obj" => Appointment::find($id)->delete(),
        ];
        return $data;
    }
}