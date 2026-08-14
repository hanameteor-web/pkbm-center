@extends('layouts.app')

@section('content')

<h1 style="
    color:#172b4d;
    font-size:28px;
    font-weight:bold;
    margin-bottom:25px;
">
    Tambah Guru
</h1>

<form
    action="{{ route('teachers.store') }}"
    method="POST"
    enctype="multipart/form-data"
>


@csrf


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
        value="{{ old('name') }}"
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


{{-- MAPEL --}}

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
        value="{{ old('subject') }}"
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


{{-- NIP OPSIONAL --}}

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
            font-weight:normal;
            font-size:13px;
        ">
            (Opsional)
        </span>
    </label>

    <input
        type="text"
        name="nip"
        value="{{ old('nip') }}"
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
        value="{{ old('email') }}"
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


{{-- FOTO --}}

<div style="margin-bottom:25px;">

    <label style="
        display:block;
        margin-bottom:8px;
        font-weight:bold;
        color:#172b4d;
    ">
        Foto Guru
    </label>

    <input
        type="file"
        name="photo"
        accept="image/*"
    >

    <p style="
        color:#8898aa;
        font-size:13px;
        margin-top:6px;
    ">
        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
    </p>

</div>


{{-- BUTTON --}}

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
    Simpan Guru
</button>


<a
    href="{{ route('teachers.index') }}"
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
    Kembali
</a>


</form>

@endsection
