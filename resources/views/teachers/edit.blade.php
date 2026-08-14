@extends('layouts.app')

@section('content')

<div style="
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
">

    <h1 style="
        color:#172b4d;
        font-size:28px;
        font-weight:bold;
        margin:0 0 25px 0;
    ">
        Edit Guru
    </h1>


    {{-- PESAN ERROR --}}

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
        action="{{ route('teachers.update', $teacher->id) }}"
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
                Nama Guru
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $teacher->name) }}"
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


        {{-- MATA PELAJARAN --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
            ">
                Mata Pelajaran
            </label>

            <input
                type="text"
                name="subject"
                value="{{ old('subject', $teacher->subject) }}"
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


        {{-- NIP --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
            ">
                NIP

                <span style="
                    color:#8898aa;
                    font-size:13px;
                    font-weight:normal;
                ">
                    (Opsional)
                </span>
            </label>

            <input
                type="text"
                name="nip"
                value="{{ old('nip', $teacher->nip) }}"
                placeholder="Masukkan NIP jika ada"
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                "
            >

        </div>


        {{-- EMAIL --}}

        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
            ">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $teacher->email) }}"
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


        {{-- FOTO GURU --}}

        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:10px;
                font-weight:bold;
                color:#172b4d;
            ">
                Foto Guru
            </label>


            {{-- FOTO SAAT INI --}}

            @if($teacher->photo)

                <div style="
                    margin-bottom:15px;
                ">

                    <img
                        src="{{ asset('teacher_uploads/' . $teacher->photo) }}"
                        alt="Foto {{ $teacher->name }}"
                        style="
                            width:110px;
                            height:110px;
                            object-fit:cover;
                            border-radius:50%;
                            display:block;
                            border:4px solid #f1f3f9;
                        "
                    >

                    <small style="
                        display:block;
                        color:#8898aa;
                        margin-top:8px;
                    ">
                        Foto saat ini
                    </small>

                </div>


                {{-- CHECKBOX HAPUS FOTO --}}

                <label style="
                    display:flex;
                    align-items:center;
                    gap:8px;
                    margin-bottom:15px;
                    color:#f5365c;
                    cursor:pointer;
                    font-size:14px;
                ">

                    <input
                        type="checkbox"
                        name="remove_photo"
                        value="1"
                        style="
                            width:16px;
                            height:16px;
                        "
                    >

                    <span>
                        Hapus foto saat ini
                    </span>

                </label>

            @else

                {{-- BELUM ADA FOTO --}}

                <div style="
                    width:110px;
                    height:110px;
                    border-radius:50%;
                    background:#f1f3f9;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    color:#8898aa;
                    margin-bottom:10px;
                ">

                    <i class="fa-solid fa-user fa-2x"></i>

                </div>

                <small style="
                    display:block;
                    color:#8898aa;
                    margin-bottom:15px;
                ">
                    Belum ada foto
                </small>

            @endif


            {{-- UPLOAD FOTO BARU --}}

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:bold;
                color:#172b4d;
                font-size:14px;
            ">
                Upload Foto Baru
            </label>

            <input
                type="file"
                name="photo"
                accept="image/jpeg,image/png,image/jpg"
                style="
                    width:100%;
                    padding:10px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                    background:#fff;
                "
            >

            <p style="
                color:#8898aa;
                font-size:13px;
                margin-top:7px;
                margin-bottom:0;
            ">
                Jika tidak memilih foto baru, foto lama akan tetap digunakan.
            </p>

        </div>


        {{-- BUTTON --}}

        <div style="
            display:flex;
            gap:10px;
            align-items:center;
        ">

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
                Update Guru
            </button>


            <a
                href="{{ route('teachers.index') }}"
                style="
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

        </div>

    </form>

</div>

@endsection