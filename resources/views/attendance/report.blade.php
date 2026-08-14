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
        Laporan Absensi
    </h1>

</div>


<div class="table-container">

    <form method="GET"
          style="
          display:flex;
          align-items:end;
          gap:10px;
          margin-bottom:25px;
          flex-wrap:wrap;
          ">

        <div>

            <label style="
            display:block;
            margin-bottom:6px;
            font-weight:bold;
            ">
                Pilih Bulan
            </label>

            <input
                type="month"
                name="month"
                value="{{ $month }}"
                style="
                padding:10px;
                border:1px solid #ddd;
                border-radius:8px;
                ">

        </div>


        <button
            type="submit"
            style="
            background:#5e72e4;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
            ">

            <i class="fa-solid fa-filter"></i>
            Tampilkan

        </button>


        <a href="{{ route('attendance.report.pdf',['month'=>$month]) }}"
           style="
           background:#f5365c;
           color:white;
           padding:10px 15px;
           border-radius:8px;
           text-decoration:none;
           ">

            <i class="fa-solid fa-file-pdf"></i>
            Export PDF

        </a>

    </form>



    <div style="
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:20px;
    margin-bottom:30px;
    ">

        <div class="card green">
            <h3>Hadir</h3>
            <h1>{{ $summary['hadir'] }}</h1>
        </div>

        <div class="card orange">
            <h3>Izin</h3>
            <h1>{{ $summary['izin'] }}</h1>
        </div>

        <div class="card blue">
            <h3>Sakit</h3>
            <h1>{{ $summary['sakit'] }}</h1>
        </div>

        <div class="card red">
            <h3>Alpha</h3>
            <h1>{{ $summary['alpha'] }}</h1>
        </div>

    </div>



    <table>

    <thead>

        <tr>

            <th style="width:8%;text-align:center;">
                No
            </th>

            <th style="width:15%;text-align:center;">
                Tanggal
            </th>

            <th style="width:27%;text-align:center;">
                Nama Siswa
            </th>

            <th style="width:18%;text-align:center;">
                Kelas
            </th>

            <th style="width:15%;text-align:center;">
                Status
            </th>

            <th style="width:17%;text-align:center;">
                Catatan
            </th>

        </tr>

    </thead>


    <tbody>


    @forelse($attendances as $i => $attendance)


        <tr>


            <td style="text-align:center;">
                {{ $i + 1 }}
            </td>



            <td style="text-align:center;">
                {{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}
            </td>



            <td style="text-align:center;">
                {{ $attendance->student->name ?? '-' }}
            </td>



            <td style="text-align:center;">
                {{ $attendance->schoolClass->name ?? '-' }}
            </td>



            <td style="text-align:center;">


                @if($attendance->status=='hadir')

                    <span style="
                    background:#2dce89;
                    color:white;
                    padding:5px 12px;
                    border-radius:20px;
                    font-size:13px;
                    ">
                        Hadir
                    </span>


                @elseif($attendance->status=='izin')


                    <span style="
                    background:#fb6340;
                    color:white;
                    padding:5px 12px;
                    border-radius:20px;
                    font-size:13px;
                    ">
                        Izin
                    </span>


                @elseif($attendance->status=='sakit')


                    <span style="
                    background:#5e72e4;
                    color:white;
                    padding:5px 12px;
                    border-radius:20px;
                    font-size:13px;
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
                    ">
                        Alpha
                    </span>


                @endif


            </td>



            <td style="text-align:center;">
                {{ $attendance->note ?: '-' }}
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


    @if(method_exists($attendances,'links'))

        <div style="margin-top:20px;">
            {{ $attendances->links() }}
        </div>

    @endif

</div>

@endsection