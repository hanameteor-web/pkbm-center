<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">


<title>Data Siswa PKBM Center</title>

<style>

    @page {
        margin: 25px;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
        color: #172b4d;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
        font-size: 20px;
        font-weight: bold;
    }

    .header h2 {
        margin: 5px 0;
        font-size: 15px;
        font-weight: bold;
    }

    .header p {
        margin: 5px 0;
        color: #666;
    }

    .line {
        border-bottom: 2px solid #172b4d;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #172b4d;
        color: white;
        padding: 8px;
        border: 1px solid #172b4d;
        text-align: center;
    }

    td {
        padding: 7px;
        border: 1px solid #ddd;
        vertical-align: middle;
    }

    .no {
        width: 6%;
        text-align: center;
    }

    .foto {
        width: 10%;
        text-align: center;
    }

    .nama {
        width: 20%;
    }

    .nis {
        width: 12%;
        text-align: center;
    }

    .kelas {
        width: 15%;
        text-align: center;
    }

    .alamat {
        width: 37%;
    }

    .student-photo {
        width: 40px;
        height: 50px;
    }

    .no-photo {
        color: #999;
    }

    .total {
        margin-top: 15px;
        font-weight: bold;
    }

    .footer {
        margin-top: 25px;
        text-align: right;
        font-size: 9px;
        color: #777;
    }

</style>


</head>

<body>


<div class="header">

    <h1>PKBM CENTER</h1>

    <h2>DAFTAR DATA SISWA</h2>

    <p>Data seluruh siswa</p>

    <div class="line"></div>

</div>


<table>

    <thead>

        <tr>

            <th class="no">
                No
            </th>

            <th class="foto">
                Foto
            </th>

            <th class="nama">
                Nama Siswa
            </th>

            <th class="nis">
                NIS
            </th>

            <th class="kelas">
                Kelas
            </th>

            <th class="alamat">
                Alamat
            </th>

        </tr>

    </thead>


    <tbody>

        @forelse($students as $student)

            <tr>

                <td class="no">
                    {{ $loop->iteration }}
                </td>


                <td class="foto">

                    @if($student->photo)

                        @php
                            $photoPath = public_path(
                                'student_uploads/' . $student->photo
                            );
                        @endphp

                        @if(file_exists($photoPath))

                            <img
                                src="{{ $photoPath }}"
                                class="student-photo"
                            >

                        @else

                            <span class="no-photo">
                                -
                            </span>

                        @endif

                    @else

                        <span class="no-photo">
                            -
                        </span>

                    @endif

                </td>


                <td class="nama">
                    {{ $student->name }}
                </td>


                <td class="nis">
                    {{ $student->nis }}
                </td>


                <td class="kelas">
                    {{ $student->schoolClass->name ?? '-' }}
                </td>


                <td class="alamat">
                    {{ $student->address ?: '-' }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6" style="text-align:center;">
                    Data siswa belum tersedia.
                </td>

            </tr>

        @endforelse

    </tbody>

</table>


<div class="total">

    Total Siswa:
    {{ $students->count() }}
    orang

</div>


<div class="footer">

    Dicetak pada:
    {{ now()->format('d-m-Y H:i') }}

</div>


</body>

</html>
