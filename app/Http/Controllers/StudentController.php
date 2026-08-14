<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Menampilkan daftar siswa.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::with('schoolClass')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('students.index', compact('students'));
    }


    /**
     * Form tambah siswa.
     */
    public function create()
    {
        $classes = SchoolClass::orderBy('name')->get();

        return view('students.create', compact('classes'));
    }


    /**
     * Menyimpan data siswa.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'nis'      => 'required|string|max:50|unique:students,nis',
            'class_id' => 'required|exists:school_classes,id',
            'address'  => 'required|string',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photoName = null;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $photoName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('student_uploads'),
                $photoName
            );
        }

        Student::create([
            'name'     => $request->name,
            'nis'      => $request->nis,
            'class_id' => $request->class_id,
            'address'  => $request->address,
            'photo'    => $photoName,
        ]);

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }


    /**
     * Detail siswa.
     */
    public function show(Student $student)
    {
        $student->load([
            'schoolClass',
            'attendances.schoolClass'
        ]);

        return view(
            'students.show',
            compact('student')
        );
    }


    /**
     * Form edit siswa.
     */
    public function edit(Student $student)
    {
        $classes = SchoolClass::orderBy('name')->get();

        return view(
            'students.edit',
            compact('student', 'classes')
        );
    }


    /**
     * Update data siswa.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'nis'      => 'required|string|max:50|unique:students,nis,' . $student->id,
            'class_id' => 'required|exists:school_classes,id',
            'address'  => 'required|string',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->remove_photo == '1') {

            if (
                $student->photo &&
                file_exists(
                    public_path('student_uploads/' . $student->photo)
                )
            ) {
                unlink(
                    public_path('student_uploads/' . $student->photo)
                );
            }

            $validated['photo'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | GANTI FOTO DENGAN FOTO BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if (
                $student->photo &&
                file_exists(
                    public_path('student_uploads/' . $student->photo)
                )
            ) {
                unlink(
                    public_path('student_uploads/' . $student->photo)
                );
            }

            $file = $request->file('photo');

            $photoName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('student_uploads'),
                $photoName
            );

            $validated['photo'] = $photoName;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $student->update($validated);


        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }


    /**
     * Menghapus data siswa.
     */
    public function destroy(Student $student)
    {
        if (
            $student->photo &&
            file_exists(
                public_path('student_uploads/' . $student->photo)
            )
        ) {
            unlink(
                public_path('student_uploads/' . $student->photo)
            );
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }


    /**
     * Export data siswa ke PDF.
     */
    public function exportPdf()
    {
        $students = Student::with('schoolClass')->get();

        $pdf = Pdf::loadView(
            'students.pdf',
            compact('students')
        );

        return $pdf->stream('data-siswa.pdf');
    }
}