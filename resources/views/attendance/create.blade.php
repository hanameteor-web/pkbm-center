@extends('layouts.app')

@section('content')

<div style="
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
">

    <h2 style="
        margin-bottom:25px;
        color:#172b4d;
        font-size:24px;
        font-weight:bold;
    ">
        Tambah Absensi
    </h2>


    {{-- ERROR VALIDASI --}}

    @if($errors->any())

        <div style="
            background:#fef0f0;
            color:#f5365c;
            padding:12px 15px;
            border-radius:10px;
            margin-bottom:20px;
        ">

            <strong>Periksa data berikut:</strong>

            <ul style="
                margin:8px 0 0 20px;
                padding:0;
            ">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- PESAN ERROR --}}

    @if(session('error'))

        <div style="
            background:#fef0f0;
            color:#f5365c;
            padding:12px 15px;
            border-radius:10px;
            margin-bottom:20px;
        ">

            {{ session('error') }}

        </div>

    @endif


    <form
        action="{{ route('attendance.store') }}"
        method="POST"
    >

        @csrf


        {{-- TANGGAL --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                color:#172b4d;
                font-weight:bold;
            ">
                Tanggal
            </label>

            <input
                type="date"
                name="date"
                value="{{ old('date', date('Y-m-d')) }}"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                "
            >

        </div>


        {{-- SISWA --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                color:#172b4d;
                font-weight:bold;
            ">
                Siswa
            </label>

            <select
                id="student"
                name="student_id"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                    background:white;
                "
            >

                <option value="">
                    -- Pilih Siswa --
                </option>

                @foreach($students as $student)

                    <option
                        value="{{ $student->id }}"
                        data-class-id="{{ $student->schoolClass->id ?? '' }}"
                        {{ old('student_id') == $student->id ? 'selected' : '' }}
                    >
                        {{ $student->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- KELAS --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                color:#172b4d;
                font-weight:bold;
            ">
                Kelas
            </label>

            <select
                id="school_class_id"
                name="school_class_id"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                    background:white;
                "
            >

                <option value="">
                    -- Pilih Kelas --
                </option>

                @foreach($classes as $class)

                    <option
                        value="{{ $class->id }}"
                        {{ old('school_class_id') == $class->id ? 'selected' : '' }}
                    >
                        {{ $class->name }}
                    </option>

                @endforeach

            </select>

            <small style="
                display:block;
                margin-top:6px;
                color:#8898aa;
            ">
                Kelas akan otomatis mengikuti siswa, tetapi tetap bisa diganti.
            </small>

        </div>


        {{-- STATUS --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:12px;
                color:#172b4d;
                font-weight:bold;
            ">
                Status
            </label>

            <div style="
                display:flex;
                gap:20px;
                flex-wrap:wrap;
            ">

                <label>
                    <input
                        type="radio"
                        name="status"
                        value="hadir"
                        {{ old('status') == 'hadir' ? 'checked' : '' }}
                        required
                    >
                    Hadir
                </label>

                <label>
                    <input
                        type="radio"
                        name="status"
                        value="izin"
                        {{ old('status') == 'izin' ? 'checked' : '' }}
                    >
                    Izin
                </label>

                <label>
                    <input
                        type="radio"
                        name="status"
                        value="sakit"
                        {{ old('status') == 'sakit' ? 'checked' : '' }}
                    >
                    Sakit
                </label>

                <label>
                    <input
                        type="radio"
                        name="status"
                        value="alpha"
                        {{ old('status') == 'alpha' ? 'checked' : '' }}
                    >
                    Alpha
                </label>

            </div>

        </div>


        {{-- CATATAN --}}

        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:8px;
                color:#172b4d;
                font-weight:bold;
            ">
                Catatan
            </label>

            <textarea
                name="note"
                rows="3"
                placeholder="Tambahkan catatan jika diperlukan..."
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                    resize:vertical;
                "
            >{{ old('note') }}</textarea>

        </div>


        {{-- BUTTON --}}

        <div style="
            display:flex;
            gap:10px;
        ">

            <button
                type="submit"
                style="
                    background:#2dce89;
                    color:white;
                    border:none;
                    padding:11px 20px;
                    border-radius:10px;
                    cursor:pointer;
                    font-weight:600;
                "
            >

                <i class="fa-solid fa-floppy-disk"></i>
                Simpan

            </button>


            <a
                href="{{ route('attendance.index') }}"
                style="
                    background:#8898aa;
                    color:white;
                    padding:11px 20px;
                    border-radius:10px;
                    text-decoration:none;
                    font-weight:600;
                "
            >

                <i class="fa-solid fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </form>

</div>


{{-- JAVASCRIPT --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const student = document.getElementById('student');

    const schoolClass = document.getElementById('school_class_id');


    student.addEventListener('change', function () {

        const selectedOption =
            student.options[student.selectedIndex];

        const classId =
            selectedOption.getAttribute('data-class-id');


        if (classId) {

            schoolClass.value = classId;

        } else {

            schoolClass.value = '';

        }

    });

});

</script>

@endsection