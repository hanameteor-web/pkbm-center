        @extends('layouts.app')

        @section('content')

        {{-- =========================
        HEADER
        ========================= --}}

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            gap:15px;
            flex-wrap:wrap;
        ">

        <h1 style="
            color:#172b4d;
            font-size:28px;
            font-weight:bold;
            margin:0;
        ">
            Data Guru
        </h1>


        <a
            href="{{ route('teachers.create') }}"
            style="
                background:#2dce89;
                color:white;
                padding:10px 15px;
                border-radius:8px;
                text-decoration:none;
                display:inline-flex;
                align-items:center;
                gap:7px;
            "
        >
            <i class="fa-solid fa-user-plus"></i>
            Tambah Guru
        </a>


        </div>

        {{-- =========================
        ALERT SUCCESS
        ========================= --}}

        @if(session('success'))

        <div style="
            background:#2dce89;
            color:white;
            padding:12px 15px;
            border-radius:8px;
            margin-bottom:20px;
        ">
            {{ session('success') }}
        </div>

        @endif

        {{-- =========================
        ERROR
        ========================= --}}

        @if($errors->any())

        <div style="
            background:#f5365c;
            color:white;
            padding:12px 15px;
            border-radius:8px;
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

        {{-- =========================
        SEARCH
        ========================= --}}

        <form
            action="{{ route('teachers.index') }}"
            method="GET"
            style="
                display:flex;
                align-items:center;
                gap:8px;
                margin-bottom:20px;
                flex-wrap:wrap;
            "
        >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari guru..."
            style="
                padding:10px 12px;
                border:1px solid #ddd;
                border-radius:8px;
                min-width:220px;
                outline:none;
            "
        >


        <button
            type="submit"
            style="
                background:#5e72e4;
                color:white;
                border:none;
                padding:10px 15px;
                border-radius:8px;
                cursor:pointer;
            "
        >
            <i class="fa-solid fa-search"></i>
            Cari
        </button>


        @if(request('search'))

            <a
                href="{{ route('teachers.index') }}"
                style="
                    background:#8898aa;
                    color:white;
                    padding:10px 15px;
                    border-radius:8px;
                    text-decoration:none;
                "
            >
                Reset
            </a>

        @endif

        </form>

        {{-- =========================
        TABLE
        ========================= --}}

        <div style="
            width:100%;
            overflow-x:auto;
        ">

        <table style="
            width:100%;
            border-collapse:collapse;
            min-width:900px;
            background:white;
            border:1px solid #e5e7eb;
        ">

            {{-- HEADER TABLE --}}

            <thead>

                <tr style="
                    background:#5e72e4;
                    color:white;
                ">

                    <th style="
                        width:7%;
                        padding:12px 10px;
                        text-align:center;
                        border:1px solid rgba(255,255,255,0.35);
                    ">
                        No
                    </th>


                    <th style="
                        width:10%;
                        padding:12px 10px;
                        text-align:center;
                        border:1px solid rgba(255,255,255,0.35);
                    ">
                        Foto
                    </th>


                    <th style="
                        width:20%;
                        padding:12px 10px;
                        text-align:center;
                        border:1px solid rgba(255,255,255,0.35);
                    ">
                        Nama Guru
                    </th>


                    <th style="
                        width:18%;
                        padding:12px 10px;
                        text-align:center;
                        border:1px solid rgba(255,255,255,0.35);
                    ">
                        Mata Pelajaran
                    </th>


                    <th style="
                        width:15%;
                        padding:12px 10px;
                        text-align:center;
                        border:1px solid rgba(255,255,255,0.35);
                    ">
                        NIP
                    </th>


                    <th style="
                        width:18%;
                        padding:12px 10px;
                        text-align:center;
                        border:1px solid rgba(255,255,255,0.35);
                    ">
                        Email
                    </th>


                    <th style="
                        width:12%;
                        padding:12px 10px;
                        text-align:center;
                        border:1px solid rgba(255,255,255,0.35);
                    ">
                        Aksi
                    </th>

                </tr>

            </thead>


            {{-- BODY TABLE --}}

            <tbody>

                @forelse($teachers as $teacher)

                    <tr style="
                        border-bottom:1px solid #e5e7eb;
                    ">


                        {{-- NO --}}

                        <td style="
                            padding:12px 10px;
                            text-align:center;
                            vertical-align:middle;
                            color:#525f7f;
                            border:1px solid #e5e7eb;
                        ">
                            {{ $teachers->firstItem() + $loop->index }}
                        </td>


                        {{-- FOTO --}}

                        <td style="
                            padding:12px 10px;
                            text-align:center;
                            vertical-align:middle;
                            border:1px solid #e5e7eb;
                        ">

                            @if($teacher->photo)

                                <img
                                    src="{{ asset('teacher_uploads/' . $teacher->photo) }}"
                                    width="55"
                                    height="55"
                                    style="
                                        width:55px;
                                        height:55px;
                                        object-fit:cover;
                                        border-radius:50%;
                                        display:block;
                                        margin:auto;
                                    "
                                >

                            @else

                                <div style="
                                    width:55px;
                                    height:55px;
                                    border-radius:50%;
                                    background:#f1f3f9;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    color:#8898aa;
                                    margin:auto;
                                ">
                                    <i class="fa-solid fa-user"></i>
                                </div>

                            @endif

                        </td>


                        {{-- NAMA --}}

                        <td style="
                            padding:12px 10px;
                            text-align:center;
                            vertical-align:middle;
                            font-weight:600;
                            color:#172b4d;
                            border:1px solid #e5e7eb;
                        ">
                            {{ $teacher->name }}
                        </td>


                        {{-- MAPEL --}}

                        <td style="
                            padding:12px 10px;
                            text-align:center;
                            vertical-align:middle;
                            color:#525f7f;
                            border:1px solid #e5e7eb;
                        ">
                            {{ $teacher->subject }}
                        </td>


                        {{-- NIP --}}

                        <td style="
                            padding:12px 10px;
                            text-align:center;
                            vertical-align:middle;
                            color:#525f7f;
                            border:1px solid #e5e7eb;
                        ">
                            {{ $teacher->nip ?? '-' }}
                        </td>


                        {{-- EMAIL --}}

                        <td style="
                            padding:12px 10px;
                            text-align:center;
                            vertical-align:middle;
                            color:#525f7f;
                            word-break:break-word;
                            border:1px solid #e5e7eb;
                        ">
                            {{ $teacher->email ?? '-' }}
                        </td>


                        {{-- AKSI --}}

                        <td style="
                            padding:12px 10px;
                            text-align:center;
                            vertical-align:middle;
                            border:1px solid #e5e7eb;
                        ">

                            <div style="
                                display:flex;
                                justify-content:center;
                                align-items:center;
                                gap:6px;
                                flex-wrap:wrap;
                            ">


                                {{-- EDIT --}}

                                <a
                                    href="{{ route('teachers.edit', $teacher->id) }}"
                                    style="
                                        background:#fb6340;
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:8px;
                                        text-decoration:none;
                                        font-size:13px;
                                        display:inline-flex;
                                        align-items:center;
                                        gap:5px;
                                    "
                                >
                                    <i class="fa-solid fa-pen"></i>
                                    Edit
                                </a>


                                {{-- HAPUS --}}

                                <form
                                    action="{{ route('teachers.destroy', $teacher->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data guru ini?')"
                                    style="margin:0;"
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
                                            display:inline-flex;
                                            align-items:center;
                                            gap:5px;
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
                            colspan="7"
                            style="
                                text-align:center;
                                padding:25px;
                                color:#8898aa;
                                border:1px solid #e5e7eb;
                            "
                        >

                            <i class="fa-solid fa-users"></i>

                            <br>

                            Data guru belum tersedia.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        </div>

        {{-- =========================
        PAGINATION
        ========================= --}}

        @if($teachers->hasPages())

        <div style="
            margin-top:20px;
        ">
            {{ $teachers->links() }}
        </div>


        @endif

        @endsection
