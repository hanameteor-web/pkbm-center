<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();

        $totalTeachers = Teacher::count();

        $totalClasses = SchoolClass::count();


        $classes = SchoolClass::withCount('students')->get();


        $todayAttendance = Attendance::whereDate(
            'date',
            Carbon::today()
        )->count();


        $attendanceStats = [
            'hadir' => Attendance::where('status','hadir')->count(),
            'izin'  => Attendance::where('status','izin')->count(),
            'sakit' => Attendance::where('status','sakit')->count(),
            'alpha' => Attendance::where('status','alpha')->count(),
        ];

            $latestStudents = Student::latest()
                ->take(5)
                ->get();

            $latestAttendance = Attendance::with('student')
                ->latest()
                ->take(5)
                ->get();

        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalClasses',
            'classes',
            'todayAttendance',
            'attendanceStats',
            'latestStudents',
            'latestAttendance'
        ));
    }
}