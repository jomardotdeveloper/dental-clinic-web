<?php

namespace App\Http\Traits;

use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;

trait ScheduleTrait {

    public function createSchedule($request) {
        $data = [
            "status" => null,
            "obj" => null,
            "error" => null
        ];

        $validator = Validator::make($request->all(), [
            'dentist_id' => 'required|exists:contacts,id',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time'
        ]);

        if ($validator->fails()) {
            $data["status"] = "failed";
            $data["error"] = $validator->errors()->all();
            return $data;
        }


        $data["status"] = "success";
        $data["obj"] = Schedule::create($request->all());
        // dd($data);
        return $data;
    }

    public function updateSchedule($request, $id) {
        $data = [
            "status" => null,
            "obj" => null,
            "error" => null
        ];

        $validator = Validator::make($request->all(), [
            'dentist_id' => 'required|exists:contacts,id',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time'
        ]);

        if ($validator->fails()) {
            $data["status"] = "failed";
            $data["error"] = $validator->errors()->all();
            return $data;
        }

        $data["status"] = "success";
        $schedule = Schedule::find($id);
        $schedule->update($request->all());
        $data["obj"] = $schedule;
        return $data;
    }

    public function deleteSchedule($id) {
        $data = [
            "status" => "success",
            "obj" => Schedule::find($id)->delete(),
        ];
        return $data;
    }

}