@extends('layouts.app')

@section('content')

<div style="
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
    max-width:700px;
    margin:0 auto;
">

    {{-- JUDUL --}}
    <div style="
        margin-bottom:25px;
        border-bottom:1px solid #eee;
        padding-bottom:15px;
    ">

        <h1 style="
            color:#172b4d;
            font-size:26px;
            font-weight:bold;
            margin:0 0 5px 0;
        ">
            Edit Kelas
        </h1>

        <p style="
            color:#8898aa;
            margin:0;
            font-size:14px;
        ">
            Perbarui nama kelas yang sudah terdaftar.
        </p>

    </div>


    {{-- ERROR VALIDASI --}}
    @if($errors->any())

        <div style="
            background:#fef0f0;
            color:#f5365c;
            padding:12px 15px;
            border-radius:10px;
            margin-bottom:20px;
        ">

            <strong>Terjadi kesalahan:</strong>

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


    {{-- FORM --}}
    <form
        action="{{ route('classes.update', $class->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- NAMA KELAS --}}
        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:8px;
                color:#172b4d;
                font-weight:bold;
                font-size:14px;
            ">
                Nama Kelas
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $class->name) }}"
                placeholder="Contoh: Paket A"
                required
                autofocus
                style="
                    width:100%;
                    padding:12px 14px;
                    border:1px solid #ddd;
                    border-radius:10px;
                    box-sizing:border-box;
                    font-size:14px;
                    outline:none;
                "
            >

            <small style="
                display:block;
                color:#8898aa;
                margin-top:7px;
                font-size:12px;
            ">
                Masukkan nama kelas yang ingin digunakan.
            </small>

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
                    padding:11px 18px;
                    border-radius:10px;
                    cursor:pointer;
                    font-size:14px;
                    font-weight:600;
                "
            >

                <i class="fa-solid fa-floppy-disk"></i>
                Update Kelas

            </button>


            <a
                href="{{ route('classes.index') }}"
                style="
                    background:#8898aa;
                    color:white;
                    padding:11px 18px;
                    border-radius:10px;
                    text-decoration:none;
                    font-size:14px;
                    font-weight:600;
                "
            >

                <i class="fa-solid fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </form>

</div>

@endsection