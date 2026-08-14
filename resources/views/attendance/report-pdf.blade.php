<!DOCTYPE html>
<html>

<head>

<title>
Laporan Absensi
</title>

<h3>
Ringkasan Kehadiran
</h3>


<table>

<tr>

<td>
Hadir
</td>

<td>
{{ $summary['hadir'] }}
</td>


<td>
Izin
</td>

<td>
{{ $summary['izin'] }}
</td>


<td>
Sakit
</td>

<td>
{{ $summary['sakit'] }}
</td>


<td>
Alpha
</td>

<td>
{{ $summary['alpha'] }}
</td>


</tr>

</table>

<style>

body{
font-family:Arial;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
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
Laporan Absensi PKBM Center
</h2>


<p>
Bulan :
{{ $month }}
</p>



<table>


<tr>

<th>No</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Status</th>
<th>Catatan</th>

</tr>



@foreach($attendances as $i=>$attendance)


<tr>

<td>
{{ $i+1 }}
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



</table>


</body>

</html>