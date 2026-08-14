@extends('layouts.app')

@section('content')

<div style="
    max-width:650px;
    margin:0 auto;
">

    {{-- HEADER --}}
    <div style="
        margin-bottom:25px;
    ">

        <h1 style="
            color:#172b4d;
            font-size:28px;
            font-weight:bold;
            margin:0 0 8px 0;
        ">
            Tambah Kelas
        </h1>

        <p style="
            color:#8898aa;
            margin:0;
        ">
            Tambahkan data kelas baru ke dalam sistem.
        </p>

    </div>


    {{-- CARD FORM --}}
    <div style="
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.05);
    ">

        {{-- ERROR --}}
        @if($errors->any())

            <div style="
                background:#f5365c;
                color:white;
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
            action="{{ route('classes.store') }}"
            method="POST"
        >

            @csrf


            {{-- NAMA KELAS --}}
            <div style="
                margin-bottom:20px;
            ">

                <label style="
                    display:block;
                    margin-bottom:8px;
                    color:#172b4d;
                    font-weight:600;
                ">
                    Nama Kelas
                </label>

                <div style="
                    position:relative;
                ">

                    <i
                        class="fa-solid fa-school"
                        style="
                        position:absolute;
                        left:13px;
                        top:13px;
                        color:#8898aa;
                        "
                    ></i>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Paket A"
                        required
                        autofocus
                        style="
                        width:100%;
                        box-sizing:border-box;
                        padding:11px 12px 11px 40px;
                        border:1px solid #ddd;
                        border-radius:9px;
                        outline:none;
                        font-size:14px;
                        "
                    >

                </div>

                <small style="
                    display:block;
                    margin-top:7px;
                    color:#8898aa;
                ">
                    Masukkan nama kelas, misalnya Paket A, Paket B, atau Paket C.
                </small>

            </div>


            {{-- BUTTON --}}
            <div style="
                display:flex;
                justify-content:flex-end;
                gap:10px;
                margin-top:25px;
            ">

                <a
                    href="{{ route('classes.index') }}"
                    style="
                    background:#8898aa;
                    color:white;
                    padding:10px 18px;
                    border-radius:9px;
                    text-decoration:none;
                    display:inline-flex;
                    align-items:center;
                    gap:6px;
                    "
                >

                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali

                </a>


                <button
                    type="submit"
                    style="
                    background:#2dce89;
                    color:white;
                    border:none;
                    padding:10px 18px;
                    border-radius:9px;
                    cursor:pointer;
                    display:inline-flex;
                    align-items:center;
                    gap:6px;
                    font-size:14px;
                    "
                >

                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Kelas

                </button>

            </div>

        </form>

    </div>

</div>

@endsection