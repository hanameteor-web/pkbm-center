<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Menampilkan daftar kelas.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $classes = SchoolClass::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('classes.index', compact('classes'));
    }


    /**
     * Menampilkan form tambah kelas.
     */
    public function create()
    {
        return view('classes.create');
    }


    /**
     * Menyimpan kelas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SchoolClass::create($validated);

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Kelas berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail kelas.
     */
    public function show(SchoolClass $class)
    {
        return view(
            'classes.show',
            compact('class')
        );
    }


    /**
     * Menampilkan form edit kelas.
     */
    public function edit(SchoolClass $class)
    {
        return view(
            'classes.edit',
            compact('class')
        );
    }


    /**
     * Memperbarui data kelas.
     */
    public function update(
        Request $request,
        SchoolClass $class
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update($validated);

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Data kelas berhasil diperbarui.'
            );
    }


    /**
     * Menghapus kelas.
     */
    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Kelas berhasil dihapus.'
            );
    }
}