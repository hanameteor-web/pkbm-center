<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Menampilkan daftar absensi.
     */
    public function index()
    {
        $attendances = Attendance::with([
            'student',
            'schoolClass'
        ])
            ->latest()
            ->paginate(10);

        return view('attendance.index', compact('attendances'));
    }


    /**
     * Menampilkan form tambah absensi.
     */
    public function create()
    {
        $students = Student::with('schoolClass')
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::orderBy('name')
            ->get();

        return view(
            'attendance.create',
            compact('students', 'classes')
        );
    }


    /**
     * Menyimpan data absensi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'date'            => 'required|date',
            'status'          => 'required|in:hadir,izin,sakit,alpha',
            'note'            => 'nullable|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek apakah siswa sudah memiliki absensi pada tanggal tersebut
        |--------------------------------------------------------------------------
        */

        $exists = Attendance::where('student_id', $validated['student_id'])
            ->whereDate('date', $validated['date'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Siswa tersebut sudah memiliki absensi pada tanggal tersebut.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan absensi
        |--------------------------------------------------------------------------
        */

        Attendance::create($validated);


        return redirect()
            ->route('attendance.index')
            ->with(
                'success',
                'Data absensi berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail absensi.
     */
    public function show(Attendance $attendance)
    {
        $attendance->load([
            'student',
            'schoolClass'
        ]);

        return view(
            'attendance.show',
            compact('attendance')
        );
    }


    /**
     * Menampilkan form edit absensi.
     */
    public function edit(Attendance $attendance)
    {
        $students = Student::with('schoolClass')
            ->orderBy('name')
            ->get();

        $classes = SchoolClass::orderBy('name')
            ->get();

        return view(
            'attendance.edit',
            compact(
                'attendance',
                'students',
                'classes'
            )
        );
    }


    /**
     * Memperbarui data absensi.
     */
    public function update(
        Request $request,
        Attendance $attendance
    ) {
        $validated = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'date'            => 'required|date',
            'status'          => 'required|in:hadir,izin,sakit,alpha',
            'note'            => 'nullable|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek duplikat saat edit
        |--------------------------------------------------------------------------
        */

        $exists = Attendance::where('student_id', $validated['student_id'])
            ->whereDate('date', $validated['date'])
            ->where('id', '!=', $attendance->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Siswa tersebut sudah memiliki absensi pada tanggal tersebut.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Update data
        |--------------------------------------------------------------------------
        */

        $attendance->update($validated);


        return redirect()
            ->route('attendance.index')
            ->with(
                'success',
                'Absensi berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data absensi.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()
            ->route('attendance.index')
            ->with(
                'success',
                'Absensi berhasil dihapus.'
            );
    }
}