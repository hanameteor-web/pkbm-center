@extends('layouts.app')

@section('content')


<div style="
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
">


    <h1 style="
    color:#172b4d;
    font-size:28px;
    font-weight:bold;
    ">
        Data Absensi
    </h1>



    <a href="{{ route('attendance.create') }}"
    style="
    background:#5e72e4;
    color:white;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
    ">

        <i class="fa-solid fa-plus"></i>
        Tambah Absensi

    </a>


</div>





@if(session('success'))

<div style="
background:#2dce89;
color:white;
padding:12px;
border-radius:10px;
margin-bottom:20px;
">

    {{ session('success') }}

</div>

@endif





<div class="table-container">


<table style="
width:100%;
border-collapse:collapse;
table-layout:fixed;
">


<thead>


<tr>


<th style="
width:8%;
text-align:center;
">
No
</th>


<th style="
width:15%;
text-align:center;
">
Tanggal
</th>


<th style="
width:25%;
text-align:center;
">
Nama Siswa
</th>


<th style="
width:20%;
text-align:center;
">
Kelas
</th>


<th style="
width:15%;
text-align:center;
">
Status
</th>


<th style="
width:17%;
text-align:center;
">
Aksi
</th>


</tr>


</thead>





<tbody>


@forelse($attendances as $i => $attendance)


<tr>


<td style="
text-align:center;
">

{{ ($attendances->currentPage()-1) * $attendances->perPage() + $i + 1 }}

</td>





<td style="
text-align:center;
">

{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}

</td>





<td style="
text-align:center;
font-weight:600;
">

{{ $attendance->student->name ?? '-' }}

</td>





<td style="
text-align:center;
">

{{ $attendance->schoolClass->name ?? '-' }}

</td>





<td style="
text-align:center;
">


@if($attendance->status == 'hadir')


<span style="
background:#2dce89;
color:white;
padding:5px 12px;
border-radius:20px;
font-size:13px;
font-weight:bold;
">

Hadir

</span>



@elseif($attendance->status == 'izin')


<span style="
background:#fb6340;
color:white;
padding:5px 12px;
border-radius:20px;
font-size:13px;
font-weight:bold;
">

Izin

</span>




@elseif($attendance->status == 'sakit')


<span style="
background:#5e72e4;
color:white;
padding:5px 12px;
border-radius:20px;
font-size:13px;
font-weight:bold;
">

Sakit

</span>




@else


<span style="
background:#f5365c;
color:white;
padding:5px 12px;
border-radius:20px;
font-size:13px;
font-weight:bold;
">

Alpha

</span>



@endif


</td>





<td style="
text-align:center;
">


<div class="table-action">



<a href="{{ route('attendance.edit',$attendance->id) }}"
style="
background:#fb6340;
color:white;
padding:6px 12px;
border-radius:8px;
text-decoration:none;
font-size:13px;
">

<i class="fa-solid fa-pen"></i>

Edit

</a>





<form action="{{ route('attendance.destroy',$attendance->id) }}"
method="POST"
onsubmit="return confirm('Yakin ingin menghapus data absensi ini?')">


@csrf
@method('DELETE')



<button type="submit"
style="
background:#f5365c;
color:white;
border:none;
padding:6px 12px;
border-radius:8px;
cursor:pointer;
font-size:13px;
">

<i class="fa-solid fa-trash"></i>

Hapus

</button>


</form>



</div>


</td>



</tr>





@empty


<tr>

<td colspan="6"
style="
text-align:center;
padding:20px;
">

Belum ada data absensi.

</td>

</tr>


@endforelse




</tbody>


</table>






@if($attendances->hasPages())

    <div style="
        display:flex;
        justify-content:center;
        align-items:center;
        gap:8px;
        margin-top:20px;
    ">

        {{-- SEBELUMNYA --}}

        @if($attendances->onFirstPage())

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
                href="{{ $attendances->previousPageUrl() }}"
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


        {{-- HALAMAN --}}

        <span style="
            padding:8px 12px;
            background:#172b4d;
            color:white;
            border-radius:8px;
        ">

            Halaman
            {{ $attendances->currentPage() }}
            dari
            {{ $attendances->lastPage() }}

        </span>


        {{-- BERIKUTNYA --}}

        @if($attendances->hasMorePages())

            <a
                href="{{ $attendances->nextPageUrl() }}"
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