@extends('layouts.app')

@section('content')

<div style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
">

    <div>

        <h1 style="
            color:#172b4d;
            font-size:28px;
            font-weight:bold;
            margin:0 0 5px 0;
        ">
            Data Kelas
        </h1>

        <p style="
            color:#8898aa;
            margin:0;
        ">
            Kelola data kelas PKBM Center.
        </p>

    </div>


    <a
        href="{{ route('classes.create') }}"
        style="
        background:#5e72e4;
        color:white;
        padding:10px 15px;
        border-radius:10px;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:7px;
        "
    >

        <i class="fa-solid fa-plus"></i>
        Tambah Kelas

    </a>

</div>


{{-- SUCCESS --}}

@if(session('success'))

<div style="
    background:#2dce89;
    color:white;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:20px;
">

    <i class="fa-solid fa-circle-check"></i>
    {{ session('success') }}

</div>

@endif


{{-- ERROR --}}

@if(session('error'))

<div style="
    background:#f5365c;
    color:white;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:20px;
">

    <i class="fa-solid fa-circle-exclamation"></i>
    {{ session('error') }}

</div>

@endif


<div class="table-container">


    {{-- SEARCH --}}

    <form
        method="GET"
        action="{{ route('classes.index') }}"
        style="
        display:flex;
        gap:10px;
        margin-bottom:20px;
        "
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama kelas..."
            style="
            flex:1;
            padding:10px;
            border:1px solid #ddd;
            border-radius:8px;
            outline:none;
            "
        >


        <button
            type="submit"
            style="
            padding:10px 15px;
            background:#5e72e4;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            "
        >

            <i class="fa-solid fa-search"></i>
            Cari

        </button>


        {{-- RESET --}}

        @if(request('search'))

            <a
                href="{{ route('classes.index') }}"
                style="
                padding:10px 15px;
                background:#8898aa;
                color:white;
                border-radius:8px;
                text-decoration:none;
                display:inline-flex;
                align-items:center;
                gap:5px;
                "
            >

                <i class="fa-solid fa-rotate-left"></i>
                Reset

            </a>

        @endif

    </form>


    {{-- TABLE --}}

    <table>

        <thead>

            <tr>

                <th style="
                    width:10%;
                    text-align:center;
                ">
                    No
                </th>

                <th style="
                    width:60%;
                    text-align:center;
                ">
                    Nama Kelas
                </th>

                <th style="
                    width:30%;
                    text-align:center;
                ">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>

        @forelse($classes as $i => $class)

            <tr>

                {{-- NO --}}

                <td style="text-align:center;">

                    {{ ($classes->currentPage() - 1) * $classes->perPage() + $i + 1 }}

                </td>


                {{-- NAMA --}}

                <td style="
                    text-align:center;
                    font-weight:600;
                    color:#172b4d;
                ">

                    <i
                        class="fa-solid fa-school"
                        style="
                        color:#5e72e4;
                        margin-right:6px;
                        "
                    ></i>

                    {{ $class->name }}

                </td>


                {{-- AKSI --}}

                <td style="text-align:center;">

                    <div class="table-action">

                        <a
                            href="{{ route('classes.edit', $class->id) }}"
                            style="
                            background:#fb6340;
                            color:white;
                            padding:6px 10px;
                            border-radius:8px;
                            text-decoration:none;
                            font-size:13px;
                            "
                        >

                            <i class="fa-solid fa-pen"></i>
                            Edit

                        </a>


                        <form
                            action="{{ route('classes.destroy', $class->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kelas ini?')"
                        >

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
                                "
                            >

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
                    colspan="3"
                    style="
                    text-align:center;
                    padding:25px;
                    color:#8898aa;
                    "
                >

                    @if(request('search'))

                        Kelas dengan kata pencarian
                        "<strong>{{ request('search') }}</strong>"
                        tidak ditemukan.

                    @else

                        Data kelas belum tersedia.

                    @endif

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>


    {{-- PAGINATION --}}

    @if($classes->hasPages())

        <div style="
            display:flex;
            justify-content:center;
            align-items:center;
            gap:8px;
            margin-top:20px;
        ">

            @if($classes->onFirstPage())

                <span style="
                    padding:8px 12px;
                    background:#eee;
                    color:#999;
                    border-radius:8px;
                ">
                    ‹ Sebelumnya
                </span>

            @else

                <a
                    href="{{ $classes->previousPageUrl() }}"
                    style="
                    padding:8px 12px;
                    background:#5e72e4;
                    color:white;
                    border-radius:8px;
                    text-decoration:none;
                    "
                >
                    ‹ Sebelumnya
                </a>

            @endif


            <span style="
                padding:8px 12px;
                background:#172b4d;
                color:white;
                border-radius:8px;
            ">

                Halaman {{ $classes->currentPage() }}
                dari {{ $classes->lastPage() }}

            </span>


            @if($classes->hasMorePages())

                <a
                    href="{{ $classes->nextPageUrl() }}"
                    style="
                    padding:8px 12px;
                    background:#5e72e4;
                    color:white;
                    border-radius:8px;
                    text-decoration:none;
                    "
                >
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