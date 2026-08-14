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
        Edit Siswa
    </h2>


    {{-- ERROR VALIDASI --}}

    @if($errors->any())

        <div style="
            background:#f5365c;
            color:white;
            padding:12px 15px;
            border-radius:10px;
            margin-bottom:20px;
        ">

            <ul style="
                margin:0;
                padding-left:20px;
            ">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('students.update', $student->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- NAMA --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
            ">
                Nama Siswa
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $student->name) }}"
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


        {{-- NIS --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
            ">
                NIS
            </label>

            <input
                type="text"
                name="nis"
                value="{{ old('nis', $student->nis) }}"
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


        {{-- KELAS --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
            ">
                Kelas
            </label>

            <select
                name="class_id"
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
                        {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}
                    >
                        {{ $class->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- ALAMAT --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
            ">
                Alamat
            </label>

            <textarea
                name="address"
                rows="4"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                    resize:vertical;
                "
            >{{ old('address', $student->address) }}</textarea>

        </div>


        {{-- FOTO --}}

        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:10px;
                font-weight:bold;
                color:#172b4d;
            ">
                Foto Siswa
            </label>


            @if($student->photo)

                <div style="
                    display:flex;
                    align-items:center;
                    gap:15px;
                    margin-bottom:15px;
                ">

                    <img
                        src="{{ asset('student_uploads/' . $student->photo) }}"
                        alt="Foto {{ $student->name }}"
                        style="
                            width:100px;
                            height:100px;
                            object-fit:cover;
                            border-radius:50%;
                            border:3px solid #e9ecef;
                        "
                    >

                    <div>

                        <div style="
                            color:#172b4d;
                            font-weight:bold;
                            margin-bottom:8px;
                        ">
                            Foto saat ini
                        </div>

                        <label style="
                            display:flex;
                            align-items:center;
                            gap:8px;
                            color:#f5365c;
                            cursor:pointer;
                        ">

                            <input
                                type="checkbox"
                                name="remove_photo"
                                value="1"
                            >

                            Hapus foto saat ini

                        </label>

                    </div>

                </div>

            @else

                <div style="
                    width:100px;
                    height:100px;
                    border-radius:50%;
                    background:#f1f3f9;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    color:#8898aa;
                    margin-bottom:12px;
                ">

                    <i class="fa-solid fa-user fa-2x"></i>

                </div>

                <div style="
                    color:#8898aa;
                    margin-bottom:12px;
                ">
                    Belum ada foto
                </div>

            @endif


            {{-- UPLOAD FOTO BARU --}}

            <input
                type="file"
                name="photo"
                accept="image/*"
            >

            <p style="
                color:#8898aa;
                font-size:13px;
                margin-top:8px;
            ">
                Pilih foto baru jika ingin mengganti foto.
            </p>

        </div>


        {{-- TOMBOL --}}

        <button
            type="submit"
            style="
                background:#5e72e4;
                color:white;
                border:none;
                padding:12px 20px;
                border-radius:10px;
                cursor:pointer;
                font-size:15px;
            "
        >

            <i class="fa-solid fa-save"></i>
            Update Siswa

        </button>


        <a
            href="{{ route('students.index') }}"
            style="
                display:inline-block;
                margin-left:8px;
                background:#8898aa;
                color:white;
                padding:12px 20px;
                border-radius:10px;
                text-decoration:none;
                font-size:15px;
            "
        >

            <i class="fa-solid fa-arrow-left"></i>
            Kembali

        </a>

    </form>

</div>

@endsection