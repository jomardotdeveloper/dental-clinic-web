<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class EndDashboardController extends Controller
{
    public function index()
    {
        return view("end.dashboard", [
            'available_dentists' => Contact::availableDentistsToday()->get(),
        ]);
    }
}
