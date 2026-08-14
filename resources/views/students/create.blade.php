@extends('layouts.app')

@section('content')

<div style="
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
">

    {{-- JUDUL --}}
    <h2 style="
        margin-bottom:20px;
        color:#172b4d;
    ">
        Tambah Siswa
    </h2>


    {{-- ERROR VALIDASI --}}
    @if($errors->any())

        <div style="
            background:#f5365c;
            color:white;
            padding:12px 15px;
            border-radius:8px;
            margin-bottom:20px;
        ">

            <strong>
                <i class="fa-solid fa-circle-exclamation"></i>
                Data belum dapat disimpan.
            </strong>

            <ul style="
                margin:8px 0 0 20px;
                padding:0;
            ">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('students.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- NAMA --}}
        <div style="margin-bottom:15px;">

            <label style="font-weight:600;">
                Nama
            </label>

            <br>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid #ddd;
                    margin-top:6px;
                "
            >

        </div>


        {{-- NIS --}}
        <div style="margin-bottom:15px;">

            <label style="font-weight:600;">
                NIS
            </label>

            <br>

            <input
                type="text"
                name="nis"
                value="{{ old('nis') }}"
                required
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid #ddd;
                    margin-top:6px;
                "
            >

        </div>


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
                {{ old('class_id') == $class->id ? 'selected' : '' }}
            >
                {{ $class->name }}
            </option>

        @endforeach

    </select>

</div>

        {{-- ALAMAT --}}
        <div style="margin-bottom:15px;">

            <label style="font-weight:600;">
                Alamat
            </label>

            <br>

            <textarea
                name="address"
                rows="3"
                required
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid #ddd;
                    margin-top:6px;
                "
            >{{ old('address') }}</textarea>

        </div>


        {{-- FOTO --}}
        <div style="margin-bottom:20px;">

            <label style="font-weight:600;">
                Foto
            </label>

            <br>

            <input
                type="file"
                name="photo"
                accept="image/jpeg,image/png,image/jpg"
                style="margin-top:8px;"
            >

            <div style="
                margin-top:5px;
                color:#8898aa;
                font-size:13px;
            ">
                Format: JPG, JPEG, PNG. Maksimal 2 MB.
            </div>

        </div>


        {{-- BUTTON --}}
        <button
            type="submit"
            style="
                background:#2dce89;
                color:white;
                padding:10px 18px;
                border:none;
                border-radius:8px;
                cursor:pointer;
            "
        >

            <i class="fa-solid fa-save"></i>
            Simpan

        </button>


        <a
            href="{{ route('students.index') }}"
            style="
                display:inline-block;
                background:#8898aa;
                color:white;
                padding:10px 18px;
                border-radius:8px;
                text-decoration:none;
                margin-left:5px;
            "
        >

            <i class="fa-solid fa-arrow-left"></i>
            Kembali

        </a>

    </form>

</div>

@endsection