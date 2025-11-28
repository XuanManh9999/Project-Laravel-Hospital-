<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Receptionist\ReceptionistController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Payment\VNPayController;
use App\Http\Controllers\Session\HeartbeatController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Public post routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User management
    Route::resource('users', UserController::class);
    
    // Service management
    Route::resource('services', ServiceController::class);
    
    // Post management
    Route::resource('posts', AdminPostController::class);
    
    // Appointment management
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{id}/accept', [AdminAppointmentController::class, 'accept'])->name('appointments.accept');
    Route::post('/appointments/{id}/reject', [AdminAppointmentController::class, 'reject'])->name('appointments.reject');
    Route::delete('/appointments/{id}', [AdminAppointmentController::class, 'destroy'])->name('appointments.destroy');
    
    // Payment management
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::patch('/payments/{payment}/status', [AdminPaymentController::class, 'updateStatus'])->name('payments.update-status');
    
    // Refund management
    Route::get('/refunds', [RefundController::class, 'index'])->name('refunds.index');
    Route::post('/refunds/{id}/process', [RefundController::class, 'process'])->name('refunds.process');
    Route::post('/refunds/{id}/reject', [RefundController::class, 'reject'])->name('refunds.reject');
    Route::post('/refunds/bulk-action', [RefundController::class, 'bulkAction'])->name('refunds.bulk-action');
});

// Doctor routes
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('profile');
    Route::put('/profile', [DoctorController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [DoctorController::class, 'changePassword'])->name('profile.change-password');
    Route::get('/appointments', [DoctorController::class, 'appointments'])->name('appointments.index');
    Route::get('/appointments/{id}', [DoctorController::class, 'showAppointment'])->name('appointments.show');
    Route::post('/appointments/{id}/accept', [DoctorController::class, 'acceptAppointment'])->name('appointments.accept');
    Route::post('/appointments/{id}/reject', [DoctorController::class, 'rejectAppointment'])->name('appointments.reject');
    Route::post('/appointments/{id}/start-examination', [DoctorController::class, 'startExamination'])->name('appointments.start-examination');
    Route::post('/appointments/{id}/complete', [DoctorController::class, 'completeAppointment'])->name('appointments.complete');
    Route::get('/history', [DoctorController::class, 'history'])->name('history');
});

// Receptionist routes
Route::middleware(['auth', 'role:receptionist'])->prefix('receptionist')->name('receptionist.')->group(function () {
    Route::get('/dashboard', [ReceptionistController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ReceptionistController::class, 'profile'])->name('profile');
    Route::put('/profile', [ReceptionistController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [ReceptionistController::class, 'changePassword'])->name('profile.change-password');
    Route::get('/appointments', [ReceptionistController::class, 'appointments'])->name('appointments.index');
});

// Patient routes
Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PatientController::class, 'profile'])->name('profile');
    Route::put('/profile', [PatientController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [PatientController::class, 'changePassword'])->name('profile.change-password');
    Route::get('/doctors', [PatientController::class, 'doctors'])->name('doctors.index');
    Route::get('/doctors/{id}', [PatientController::class, 'showDoctor'])->name('doctors.show');
    Route::get('/doctors/{id}/appointments/create', [PatientController::class, 'createAppointment'])->name('appointments.create');
    Route::post('/appointments', [PatientController::class, 'storeAppointment'])->name('appointments.store');
    Route::get('/appointments/{id}', [PatientController::class, 'showAppointment'])->name('appointments.show');
    Route::post('/appointments/{id}/cancel', [PatientController::class, 'cancelAppointment'])->name('appointments.cancel');
    Route::get('/history', [PatientController::class, 'history'])->name('history');
});

// Payment routes
Route::middleware('auth')->prefix('vnpay')->name('vnpay.')->group(function () {
    Route::post('/create/{appointmentId}', [VNPayController::class, 'createPayment'])->name('create');
    Route::get('/return', [VNPayController::class, 'return'])->name('return');
});

Route::middleware('auth')->post('/session/heartbeat', HeartbeatController::class)->name('session.heartbeat');

