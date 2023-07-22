<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('services.index', [
            'title' => 'Services',
            'services' => Service::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Service::create($request->all());
        return redirect()->route('services.index')->with(['success'=> ['Service created successfully.']]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
        return redirect()->route('services.index')->with(['success' => ['Service updated successfully.']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with(['success'=> ['Service deleted successfully.']]);
    }
}
