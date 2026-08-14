<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Menampilkan data guru.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $teachers = Teacher::query()
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('subject', 'like', "%{$search}%")
                      ->orWhere('nip', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('teachers.index', compact('teachers'));
    }


    /**
     * Form tambah guru.
     */
    public function create()
    {
        return view('teachers.create');
    }


    /**
     * Simpan guru baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name'    => 'required|string|max:255',

            'subject' => 'required|string|max:255',

            'nip'     => 'nullable|string|max:100',

            'email'   => 'required|email|max:255',

            'photo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        $photoName = null;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $photoName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('teacher_uploads'),
                $photoName
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan Data Guru
        |--------------------------------------------------------------------------
        */

        Teacher::create([

            'name'    => $validated['name'],

            'subject' => $validated['subject'],

            'nip'     => $validated['nip'] ?: null,

            'email'   => $validated['email'],

            'photo'   => $photoName,

        ]);


        return redirect()
            ->route('teachers.index')
            ->with(
                'success',
                'Data guru berhasil ditambahkan.'
            );
    }


    /**
     * Form edit guru.
     */
    public function edit(Teacher $teacher)
    {
        return view(
            'teachers.edit',
            compact('teacher')
        );
    }


    /**
     * Update data guru.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([

            'name'    => 'required|string|max:255',

            'subject' => 'required|string|max:255',

            'nip'     => 'nullable|string|max:100',

            'email'   => 'required|email|max:255',

            'photo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Foto Lama
        |--------------------------------------------------------------------------
        */

        $photoName = $teacher->photo;


        /*
        |--------------------------------------------------------------------------
        | PILIHAN 1: Hapus Foto
        |--------------------------------------------------------------------------
        */

        if ($request->has('remove_photo') && $request->remove_photo == '1') {

            if (
                $teacher->photo &&
                file_exists(
                    public_path(
                        'teacher_uploads/' . $teacher->photo
                    )
                )
            ) {

                unlink(
                    public_path(
                        'teacher_uploads/' . $teacher->photo
                    )
                );
            }


            $photoName = null;
        }


        /*
        |--------------------------------------------------------------------------
        | PILIHAN 2: Upload Foto Baru
        |--------------------------------------------------------------------------
        */

        elseif ($request->hasFile('photo')) {

            /*
            | Hapus foto lama
            */

            if (
                $teacher->photo &&
                file_exists(
                    public_path(
                        'teacher_uploads/' . $teacher->photo
                    )
                )
            ) {

                unlink(
                    public_path(
                        'teacher_uploads/' . $teacher->photo
                    )
                );
            }


            /*
            | Simpan foto baru
            */

            $file = $request->file('photo');

            $photoName = time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();


            $file->move(
                public_path('teacher_uploads'),
                $photoName
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Update Database
        |--------------------------------------------------------------------------
        */

        $teacher->update([

            'name'    => $validated['name'],

            'subject' => $validated['subject'],

            'nip'     => $validated['nip'] ?: null,

            'email'   => $validated['email'],

            'photo'   => $photoName,

        ]);


        return redirect()
            ->route('teachers.index')
            ->with(
                'success',
                'Data guru berhasil diperbarui.'
            );
    }


    /**
     * Hapus guru.
     */
    public function destroy(Teacher $teacher)
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus file foto
        |--------------------------------------------------------------------------
        */

        if (
            $teacher->photo &&
            file_exists(
                public_path(
                    'teacher_uploads/' . $teacher->photo
                )
            )
        ) {

            unlink(
                public_path(
                    'teacher_uploads/' . $teacher->photo
                )
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus data guru
        |--------------------------------------------------------------------------
        */

        $teacher->delete();


        return redirect()
            ->route('teachers.index')
            ->with(
                'success',
                'Data guru berhasil dihapus.'
            );
    }
}