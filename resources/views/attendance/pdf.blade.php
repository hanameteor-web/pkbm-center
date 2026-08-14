<!DOCTYPE html>
<html>

<head>

<title>
Rekap Absensi
</title>


<style>

body{
    font-family: Arial;
}


table{
    width:100%;
    border-collapse:collapse;
}


th{
    background:#5e72e4;
    color:white;
    padding:8px;
}


td{
    padding:8px;
    border:1px solid #ddd;
}


h2{
    text-align:center;
}


</style>

</head>


<body>


<h2>
Laporan Rekap Absensi
<br>
PKBM Center
</h2>


<p>
Bulan :
{{ $month }}
</p>



<table>


<thead>

<tr>

<th>
Tanggal
</th>

<th>
Siswa
</th>

<th>
Kelas
</th>

<th>
Status
</th>

<th>
Catatan
</th>

</tr>

</thead>



<tbody>


@foreach($attendances as $attendance)

<tr>


<td>

{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}

</td>


<td>

{{ $attendance->student->name }}

</td>


<td>

{{ $attendance->schoolClass->name }}

</td>


<td>

{{ ucfirst($attendance->status) }}

</td>


<td>

{{ $attendance->note ?? '-' }}

</td>


</tr>


@endforeach


</tbody>


</table>


</body>

</html>