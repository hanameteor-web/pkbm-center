<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class AttendanceReportController extends Controller
{

   public function index(Request $request)
{

    $month = $request->month ?? Carbon::now()->format('Y-m');


    $attendances = Attendance::with([
        'student',
        'schoolClass'
    ])
    ->where('date','like',$month.'%')
    ->get();



    $summary = [

        'hadir' => $attendances
            ->where('status','hadir')
            ->count(),

        'izin' => $attendances
            ->where('status','izin')
            ->count(),

        'sakit' => $attendances
            ->where('status','sakit')
            ->count(),

        'alpha' => $attendances
            ->where('status','alpha')
            ->count(),

    ];



    return view('attendance.report', compact(

        'attendances',
        'month',
        'summary'

    ));

}



   public function pdf(Request $request)
{

    $month = $request->month ?? Carbon::now()->format('Y-m');


    $attendances = Attendance::with([
        'student',
        'schoolClass'
    ])
    ->where('date','like',$month.'%')
    ->get();



    $summary = [

        'hadir' => $attendances
            ->where('status','hadir')
            ->count(),

        'izin' => $attendances
            ->where('status','izin')
            ->count(),

        'sakit' => $attendances
            ->where('status','sakit')
            ->count(),

        'alpha' => $attendances
            ->where('status','alpha')
            ->count(),

    ];



    $pdf = Pdf::loadView(
        'attendance.report-pdf',
        compact(
            'attendances',
            'month',
            'summary'
        )
    );


    return $pdf->stream(
        'laporan-absensi-'.$month.'.pdf'
    );

}

}