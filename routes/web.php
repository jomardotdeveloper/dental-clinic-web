<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EndAppointmentController;
use App\Http\Controllers\EndCalendarController;
use App\Http\Controllers\EndDashboardController;
use App\Http\Controllers\EndLoginController;
use App\Http\Controllers\EndProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('endmob', [EndLoginController::class, 'index'])->name('end.login');
Route::post("end-login", [EndLoginController::class, "authenticate"])->name("end.authenticate");
Route::post("end-logout", [EndLoginController::class, "logout"])->name("end.logout");
Route::get('endreg', [EndLoginController::class, 'register'])->name('end.register');
Route::post("end-register", [EndLoginController::class, "store"])->name("end.store");
Route::get('enddash', [EndDashboardController::class, 'index'])->name('end.dashboard');
Route::get('endcalendar', [EndCalendarController::class, 'calendar'])->name('end.calendar');
Route::resource('endappointments', EndAppointmentController::class);
Route::get('endappointments/approve/{id}', [EndAppointmentController::class, 'approve'])->name('endappointments.approve');
Route::get('endappointments/reject/{id}', [EndAppointmentController::class, 'reject'])->name('endappointments.reject');
Route::get('endappointments/complete/{id}', [EndAppointmentController::class, 'complete'])->name('endappointments.complete');
Route::get('endappointments/cancel/{id}', [EndAppointmentController::class, 'cancel'])->name('endappointments.cancel');

Route::get('queue', [QueueController::class, 'index'])->name('queue');

Route::get('endprofile', [EndProfileController::class, 'profile'])->name('end.profile');
Route::post('endprofile/profile', [EndProfileController::class, 'updateProfile'])->name('end.update-profile');
Route::post('endprofile/password', [EndProfileController::class, 'changePassword'])->name('end.change-password');


Route::get('/', function () {
    return view('login');
})->name("login.page");

Route::post("login", [LoginController::class, "authenticate"])->name("login");
Route::post("logout", [LoginController::class, "logout"])->name("logout");

Route::prefix("/admin")->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('contacts', ContactController::class);
    Route::post('contacts/{contact}/grant-user', [ContactController::class, 'grantUserAccount'])->name('contacts.grant-user');
    Route::resource('services', ServiceController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('payments', PaymentController::class);
});

