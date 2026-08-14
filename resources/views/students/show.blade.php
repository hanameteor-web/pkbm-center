@extends('layouts.app')

@section('content')

<h2 style="
    color:#172b4d;
    margin-bottom:20px;
    font-size:24px;
    font-weight:700;
">
    Detail Siswa
</h2>

{{-- FOTO SISWA --}}
@if($student->photo)


<img
    src="{{ asset('student_uploads/'.$student->photo) }}"
    width="120"
    style="
        border-radius:12px;
        margin-bottom:25px;
        display:block;
        object-fit:cover;
    "
>


@endif

{{-- INFORMASI SISWA --}}

<table style="
    width:100%;
    margin-bottom:30px;
    border-collapse:collapse;
    background:#fff;
">


<tbody>

    <tr style="border-bottom:1px solid #eee;">
        <td style="
            width:180px;
            padding:12px 15px;
            color:#525f7f;
            font-weight:600;
        ">
            Nama
        </td>

        <td style="
            padding:12px 15px;
            color:#172b4d;
        ">
            {{ $student->name }}
        </td>
    </tr>


    <tr style="border-bottom:1px solid #eee;">
        <td style="
            padding:12px 15px;
            color:#525f7f;
            font-weight:600;
        ">
            NIS
        </td>

        <td style="
            padding:12px 15px;
            color:#172b4d;
        ">
            {{ $student->nis }}
        </td>
    </tr>


    <tr style="border-bottom:1px solid #eee;">
        <td style="
            padding:12px 15px;
            color:#525f7f;
            font-weight:600;
        ">
            Kelas
        </td>

        <td style="
            padding:12px 15px;
            color:#172b4d;
        ">
            {{ $student->schoolClass->name }}
        </td>
    </tr>


    <tr>
        <td style="
            padding:12px 15px;
            color:#525f7f;
            font-weight:600;
            vertical-align:top;
        ">
            Alamat
        </td>

        <td style="
            padding:12px 15px;
            color:#172b4d;
        ">
            {{ $student->address ?: '-' }}
        </td>
    </tr>

</tbody>


</table>

{{-- RIWAYAT ABSENSI --}}

<h3 style="
    margin-bottom:15px;
    color:#172b4d;
    font-size:20px;
    font-weight:700;
">
    Riwayat Absensi
</h3>

<div style="
    width:100%;
    overflow-x:auto;
    background:#fff;
    border-radius:8px;
">

<table style="
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
">


<thead>

    <tr style="
        background:#5e72e4;
        color:white;
    ">

        <th style="
            width:18%;
            padding:13px 15px;
            text-align:center;
            font-size:14px;
            font-weight:600;
        ">
            Tanggal
        </th>

        <th style="
            width:22%;
            padding:13px 15px;
            text-align:center;
            font-size:14px;
            font-weight:600;
        ">
            Kelas
        </th>

        <th style="
            width:20%;
            padding:13px 15px;
            text-align:center;
            font-size:14px;
            font-weight:600;
        ">
            Status
        </th>

        <th style="
            width:40%;
            padding:13px 15px;
            text-align:center;
            font-size:14px;
            font-weight:600;
        ">
            Catatan
        </th>

    </tr>

</thead>


<tbody>

    @forelse($student->attendances as $attendance)

        <tr style="
            border-bottom:1px solid #eee;
            background:#fff;
        ">

            <td style="
                padding:12px 15px;
                text-align:center;
                color:#525f7f;
                vertical-align:middle;
            ">
                {{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}
            </td>


            <td style="
                padding:12px 15px;
                text-align:center;
                color:#525f7f;
                vertical-align:middle;
            ">
                {{ $attendance->schoolClass->name }}
            </td>


            <td style="
                padding:12px 15px;
                text-align:center;
                vertical-align:middle;
            ">

                @if($attendance->status == 'hadir')

                    <span style="
                        color:#2dce89;
                        font-weight:600;
                    ">
                        Hadir
                    </span>

                @elseif($attendance->status == 'izin')

                    <span style="
                        color:#fb6340;
                        font-weight:600;
                    ">
                        Izin
                    </span>

                @elseif($attendance->status == 'sakit')

                    <span style="
                        color:#5e72e4;
                        font-weight:600;
                    ">
                        Sakit
                    </span>

                @else

                    <span style="
                        color:#f5365c;
                        font-weight:600;
                    ">
                        Alpha
                    </span>

                @endif

            </td>


            <td style="
                padding:12px 15px;
                text-align:center;
                color:#525f7f;
                vertical-align:middle;
                word-break:break-word;
            ">
                {{ $attendance->note ?: '-' }}
            </td>

        </tr>

    @empty

        <tr>

            <td
                colspan="4"
                style="
                    text-align:center;
                    padding:25px;
                    color:#8898aa;
                "
            >
                Belum ada riwayat absensi.
            </td>

        </tr>

    @endforelse

</tbody>


</table>

</div>

{{-- TOMBOL KEMBALI --}}

<div style="
    margin-top:20px;
">


<a
    href="{{ route('students.index') }}"
    style="
        display:inline-block;
        background:#5e72e4;
        color:white;
        padding:10px 16px;
        border-radius:7px;
        text-decoration:none;
        font-weight:500;
    "
>
    Kembali
</a>


</div>

@endsection
