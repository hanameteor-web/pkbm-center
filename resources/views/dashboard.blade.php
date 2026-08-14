@extends('layouts.app')

@section('content')

{{-- =========================
HEADER DASHBOARD
========================= --}}

<h1 style="
    font-size:28px;
    margin-bottom:10px;
    color:#172b4d;
    font-weight:bold;
">
    Dashboard PKBM Center
</h1>

<p style="
    color:#8898aa;
    margin-bottom:30px;
    font-size:15px;
">
    Selamat datang di sistem informasi PKBM
</p>

{{-- =========================
RINGKASAN
========================= --}}

<div class="cards">


<div class="card blue">

    <h3>
        Total Siswa
    </h3>

    <h1>
        {{ $totalStudents }}
    </h1>

</div>


<div class="card green">

    <h3>
        Total Guru
    </h3>

    <h1>
        {{ $totalTeachers }}
    </h1>

</div>


<div class="card orange">

    <h3>
        Total Kelas
    </h3>

    <h1>
        {{ $totalClasses }}
    </h1>

</div>


<div class="card red">

    <h3>
        Absensi Hari Ini
    </h3>

    <h1>
        {{ $todayAttendance }}
    </h1>

</div>


</div>

{{-- =========================
STATISTIK KELAS
========================= --}}

<h2 style="
    margin-top:35px;
    margin-bottom:20px;
    color:#172b4d;
    font-size:20px;
">
    Statistik Siswa per Kelas
</h2>

<div class="cards">


@forelse($classes as $class)

    <div class="card blue">

        <h3>
            {{ $class->name }}
        </h3>

        <h1>
            {{ $class->students_count }}
        </h1>

        <p style="
            margin:0;
            color:#ffffff;
            opacity:.55;
        ">
            Siswa
        </p>

    </div>

@empty

    <p style="
        color:#8898aa;
        padding:10px 0;
    ">
        Belum ada data kelas.
    </p>

@endforelse


</div>

{{-- =========================
GRAFIK SISWA PER KELAS
========================= --}}

<h2 style="
    margin-top:35px;
    margin-bottom:20px;
    color:#172b4d;
    font-size:20px;
">
    Grafik Siswa per Kelas
</h2>

<div style="
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
">


<div style="
    position:relative;
    height:300px;
">

    <canvas id="studentChart"></canvas>

</div>


</div>

{{-- =========================
STATISTIK KEHADIRAN
========================= --}}

<h2 style="
    margin-top:35px;
    margin-bottom:20px;
    color:#172b4d;
    font-size:20px;
">
    Statistik Kehadiran
</h2>

<div style="
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
">


<div style="
    position:relative;
    height:300px;
">

    <canvas id="attendanceChart"></canvas>

</div>


</div>

{{-- =========================
PERSENTASE SISWA PER KELAS
========================= --}}

<h2 style="
    margin-top:35px;
    margin-bottom:20px;
    color:#172b4d;
    font-size:20px;
">
    Persentase Siswa per Kelas
</h2>

<div style="
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
">


<div style="
    position:relative;
    height:350px;
    max-width:600px;
    margin:auto;
">

    <canvas id="pieChart"></canvas>

</div>


</div>

{{-- =========================
CHART.JS
========================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /* =========================
       DATA KELAS
    ========================= */

    const classLabels = @json($classes->pluck('name'));

    const classStudents = @json($classes->pluck('students_count'));


    /* =========================
       GRAFIK SISWA PER KELAS
    ========================= */

    new Chart(
        document.getElementById('studentChart'),
        {
            type: 'bar',

            data: {
                labels: classLabels,

                datasets: [{
                    label: 'Jumlah Siswa',
                    data: classStudents,

                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,

                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        }
    );


    /* =========================
       GRAFIK KEHADIRAN
    ========================= */

    new Chart(
        document.getElementById('attendanceChart'),
        {
            type: 'bar',

            data: {
                labels: [
                    'Hadir',
                    'Izin',
                    'Sakit',
                    'Alpha'
                ],

                datasets: [{
                    label: 'Jumlah Kehadiran',

                    data: [
                        {{ $attendanceSummary['hadir'] ?? 0 }},
                        {{ $attendanceSummary['izin'] ?? 0 }},
                        {{ $attendanceSummary['sakit'] ?? 0 }},
                        {{ $attendanceSummary['alpha'] ?? 0 }}
                    ],

                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,

                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        }
    );


    /* =========================
       PIE CHART
    ========================= */

    new Chart(
        document.getElementById('pieChart'),
        {
            type: 'pie',

            data: {
                labels: classLabels,

                datasets: [{
                    data: classStudents,

                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,

                maintainAspectRatio: false
            }
        }
    );

</script>

@endsection
