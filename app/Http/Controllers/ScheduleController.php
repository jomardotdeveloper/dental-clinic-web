<?php

namespace App\Http\Controllers;

use App\Http\Traits\ScheduleTrait;
use App\Models\Contact;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use ScheduleTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('schedules.index', [
            'title' => 'Schedules',
            'schedules' => Schedule::all(),
            'dentists' => Contact::where('is_dentist', true)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $schedule = $this->createSchedule($request);

        if ($schedule['status'] == 'failed') {
            return redirect()->route('schedules.index')->with(['error' => $schedule['error']]);
        }
        return redirect()->route('schedules.index')->with(['success' => ['Schedule created successfully.']]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $schedule = $this->updateSchedule($request, $schedule->id);
        if ($schedule['status'] == 'failed') {
            return redirect()->route('schedules.index')->with(['error' => $schedule['error']]);
        }
        return redirect()->route('schedules.index')->with(['success' => ['Schedule updated successfully.']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $this->deleteSchedule($schedule->id);
        return redirect()->route('schedules.index')->with(['success' => ['Schedule deleted successfully.']]);
    }
}
