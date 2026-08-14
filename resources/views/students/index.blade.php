@extends('layouts.app')

@section('content')

<div style="
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
">

    <h1 style="
    color:#172b4d;
    font-size:28px;
    font-weight:bold;
    margin:0;
    ">
        Data Siswa
    </h1>

    <div style="
    display:flex;
    gap:10px;
    ">

        <a href="{{ route('students.pdf') }}"
           style="
           background:#f5365c;
           color:white;
           padding:10px 15px;
           border-radius:10px;
           text-decoration:none;
           ">

            <i class="fa-solid fa-file-pdf"></i>
            Export PDF

        </a>

        <a href="{{ route('students.create') }}"
           style="
           background:#5e72e4;
           color:white;
           padding:10px 15px;
           border-radius:10px;
           text-decoration:none;
           ">

            <i class="fa-solid fa-user-plus"></i>
            Tambah Siswa

        </a>

    </div>

</div>


@if(session('success'))

<div style="
background:#2dce89;
color:white;
padding:12px;
border-radius:10px;
margin-bottom:20px;
">

    {{ session('success') }}

</div>

@endif


@if(session('error'))

<div style="
background:#f5365c;
color:white;
padding:12px;
border-radius:10px;
margin-bottom:20px;
">

    {{ session('error') }}

</div>

@endif


<div class="table-container">


{{-- SEARCH --}}

<form method="GET"
      action="{{ route('students.index') }}"
      style="
      display:flex;
      gap:10px;
      margin-bottom:20px;
      ">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nama atau NIS siswa..."
        style="
        flex:1;
        padding:10px;
        border:1px solid #ddd;
        border-radius:8px;
        ">


    <button
        type="submit"
        style="
        padding:10px 15px;
        background:#5e72e4;
        color:white;
        border:none;
        border-radius:8px;
        cursor:pointer;
        ">

        <i class="fa-solid fa-search"></i>
        Cari

    </button>


    {{-- RESET --}}

    @if(request('search'))

        <a href="{{ route('students.index') }}"
           style="
           padding:10px 15px;
           background:#8898aa;
           color:white;
           border-radius:8px;
           text-decoration:none;
           display:inline-flex;
           align-items:center;
           gap:5px;
           ">

            <i class="fa-solid fa-rotate-left"></i>
            Reset

        </a>

    @endif

</form>


<table>

    <thead>

        <tr>

            <th style="width:6%;text-align:center;">
                No
            </th>

            <th style="width:10%;text-align:center;">
                Foto
            </th>

            <th style="width:20%;text-align:center;">
                Nama Siswa
            </th>

            <th style="width:12%;text-align:center;">
                NIS
            </th>

            <th style="width:15%;text-align:center;">
                Kelas
            </th>

            <th style="width:22%;text-align:center;">
                Alamat
            </th>

            <th style="width:15%;text-align:center;">
                Aksi
            </th>

        </tr>

    </thead>


    <tbody>

    @forelse($students as $i => $student)

        <tr>

            {{-- NO --}}

            <td style="text-align:center;">

                {{ ($students->currentPage() - 1) * $students->perPage() + $i + 1 }}

            </td>


            {{-- FOTO --}}

            <td style="text-align:center;">

                @if($student->photo)

                    <img
                        src="{{ asset('student_uploads/' . $student->photo) }}"
                        class="student-photo"
                        alt="Foto {{ $student->name }}">

                @else

                    <span style="color:#8898aa;">
                        -
                    </span>

                @endif

            </td>


            {{-- NAMA --}}

            <td style="
            text-align:center;
            font-weight:600;
            ">

                {{ $student->name }}

            </td>


            {{-- NIS --}}

            <td style="text-align:center;">

                {{ $student->nis }}

            </td>


            {{-- KELAS --}}

            <td style="text-align:center;">

                {{ $student->schoolClass->name ?? '-' }}

            </td>


            {{-- ALAMAT --}}

            <td style="
            text-align:center;
            white-space:normal;
            word-break:break-word;
            ">

                {{ $student->address ?: '-' }}

            </td>


            {{-- AKSI --}}

            <td style="text-align:center;">

                <div class="table-action">

                    <a
                        href="{{ route('students.show', $student->id) }}"
                        style="
                        background:#11cdef;
                        color:white;
                        padding:6px 10px;
                        border-radius:8px;
                        text-decoration:none;
                        font-size:13px;
                        ">

                        <i class="fa-solid fa-eye"></i>
                        Detail

                    </a>


                    <a
                        href="{{ route('students.edit', $student->id) }}"
                        style="
                        background:#fb6340;
                        color:white;
                        padding:6px 10px;
                        border-radius:8px;
                        text-decoration:none;
                        font-size:13px;
                        ">

                        <i class="fa-solid fa-pen"></i>
                        Edit

                    </a>


                    <form
                        action="{{ route('students.destroy', $student->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            style="
                            background:#f5365c;
                            color:white;
                            border:none;
                            padding:6px 10px;
                            border-radius:8px;
                            cursor:pointer;
                            font-size:13px;
                            ">

                            <i class="fa-solid fa-trash"></i>
                            Hapus

                        </button>

                    </form>

                </div>

            </td>

        </tr>


    @empty

        <tr>

            <td
                colspan="7"
                style="
                text-align:center;
                padding:20px;
                ">

                @if(request('search'))

                    Siswa dengan kata pencarian
                    "<strong>{{ request('search') }}</strong>"
                    tidak ditemukan.

                @else

                    Data siswa belum tersedia.

                @endif

            </td>

        </tr>

    @endforelse

    </tbody>

</table>


{{-- PAGINATION TANPA TITIK TIGA --}}

@if($students->hasPages())

    <div style="
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    margin-top:20px;
    ">

        @if($students->onFirstPage())

            <span style="
            padding:8px 12px;
            background:#eee;
            color:#999;
            border-radius:8px;
            ">
                ‹ Sebelumnya
            </span>

        @else

            <a href="{{ $students->previousPageUrl() }}"
               style="
               padding:8px 12px;
               background:#5e72e4;
               color:white;
               border-radius:8px;
               text-decoration:none;
               ">
                ‹ Sebelumnya
            </a>

        @endif


        <span style="
        padding:8px 12px;
        background:#172b4d;
        color:white;
        border-radius:8px;
        ">

            Halaman {{ $students->currentPage() }}
            dari {{ $students->lastPage() }}

        </span>


        @if($students->hasMorePages())

            <a href="{{ $students->nextPageUrl() }}"
               style="
               padding:8px 12px;
               background:#5e72e4;
               color:white;
               border-radius:8px;
               text-decoration:none;
               ">
                Berikutnya ›
            </a>

        @else

            <span style="
            padding:8px 12px;
            background:#eee;
            color:#999;
            border-radius:8px;
            ">
                Berikutnya ›
            </span>

        @endif

    </div>

@endif


</div>

@endsection