<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceReportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// ==========================================================================
// REDIRECT HALAMAN UTAMA
// ==========================================================================

Route::get('/', function () {
    return redirect('/login');
});


// ==========================================================================
// ROUTE UNTUK SEMUA USER YANG SUDAH LOGIN
// ==========================================================================

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Profile
    Route::get('/profile', function () {
        return redirect('/dashboard');
    })->name('profile.edit');

});


// ==========================================================================
// ROUTE KHUSUS ADMIN
// ==========================================================================

Route::middleware(['auth', 'admin'])->group(function () {


    // ----------------------------------------------------------------------
    // DATA SISWA
    // ----------------------------------------------------------------------

    // Export / Preview PDF Data Siswa
    // HARUS diletakkan sebelum Route::resource()
    Route::get('/students/pdf', [StudentController::class, 'exportPdf'])
        ->name('students.pdf');

    // CRUD Data Siswa
    Route::resource('students', StudentController::class);


    // ----------------------------------------------------------------------
    // DATA GURU
    // ----------------------------------------------------------------------

    Route::resource('teachers', TeacherController::class);


    // ----------------------------------------------------------------------
    // DATA KELAS
    // ----------------------------------------------------------------------

    Route::resource('classes', SchoolClassController::class);


    // ----------------------------------------------------------------------
    // DATA ABSENSI
    // ----------------------------------------------------------------------

    Route::resource('attendance', AttendanceController::class);


    // ----------------------------------------------------------------------
    // LAPORAN ABSENSI
    // ----------------------------------------------------------------------

    // Halaman laporan absensi
    Route::get('/attendance-report', [
        AttendanceReportController::class,
        'index'
    ])->name('attendance.report');


    // Export / Preview PDF Laporan Absensi
    Route::get('/attendance-report/pdf', [
        AttendanceReportController::class,
        'pdf'
    ])->name('attendance.report.pdf');

});


// ==========================================================================
// AUTHENTICATION BREEZE
// ==========================================================================

require __DIR__ . '/auth.php';
