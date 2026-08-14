@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div style="
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
flex-wrap:wrap;
gap:15px;
">

    <div>

        <h1 style="
        font-size:30px;
        color:#172b4d;
        margin-bottom:8px;
        ">
            Dashboard PKBM Center
        </h1>

        <p style="
        color:#8898aa;
        font-size:15px;
        ">
            Selamat datang di sistem informasi PKBM
        </p>

    </div>

</div>

{{-- CARD STATISTIK --}}
<div class="cards">

    {{-- TOTAL SISWA --}}
    <div class="card blue">

        <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        ">

            <div>

                <h3>Total Siswa</h3>

                <h1>{{ $totalStudents }}</h1>

            </div>

            <i class="fa-solid fa-users"
               style="font-size:40px; opacity:0.4;"></i>

        </div>

    </div>

    {{-- TOTAL GURU --}}
    <div class="card green">

        <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        ">

            <div>

                <h3>Total Guru</h3>

                <h1>{{ $totalTeachers }}</h1>

            </div>

            <i class="fa-solid fa-chalkboard-user"
               style="font-size:40px; opacity:0.4;"></i>

        </div>

    </div>

    {{-- TOTAL KELAS --}}
    <div class="card orange">

        <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        ">

            <div>

                <h3>Total Kelas</h3>

                <h1>{{ $totalClasses }}</h1>

            </div>

            <i class="fa-solid fa-school"
               style="font-size:40px; opacity:0.4;"></i>

        </div>

    </div>

    {{-- LAPORAN --}}
    <div class="card red">

        <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        ">

            <div>

                <h3>Laporan</h3>

                <h1>20</h1>

            </div>

            <i class="fa-solid fa-file-lines"
               style="font-size:40px; opacity:0.4;"></i>

        </div>

    </div>

</div>

{{-- AKTIVITAS --}}
<div style="
margin-top:30px;
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,0.05);
">

    <h2 style="
    color:#172b4d;
    margin-bottom:20px;
    ">
        Aktivitas Terbaru
    </h2>

    <table>

        <thead>

            <tr>

                <th>Nama</th>
                <th>Aktivitas</th>
                <th>Tanggal</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>Hana</td>
                <td>Menambahkan siswa baru</td>
                <td>22 Mei 2026</td>

            </tr>

            <tr>

                <td>Admin</td>
                <td>Memperbarui data kelas</td>
                <td>22 Mei 2026</td>

            </tr>

            <tr>

                <td>Guru</td>
                <td>Mengupload materi</td>
                <td>21 Mei 2026</td>

            </tr>

        </tbody>

    </table>

</div>

{{-- GRAFIK SISWA --}}
<div style="
margin-top:30px;
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,0.05);
">

    <h2 style="
    color:#172b4d;
    margin-bottom:20px;
    ">
        Grafik Siswa
    </h2>

    <canvas id="studentChart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('studentChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'SMA IPS',
            'SMA IPA',
            'Paket C'
        ],

        datasets: [{

            label: 'Jumlah Siswa',

            data: [
                {{ $smaIps }},
                {{ $smaIpa }},
                {{ $paketC }}
            ],

            borderWidth: 1,
            borderRadius: 10

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                display: true
            }

        }

    }

});

</script>

@endsection