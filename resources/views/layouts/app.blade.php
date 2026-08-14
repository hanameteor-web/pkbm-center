<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PKBM Center</title>

<link rel="icon" type="image/png" href="{{ asset('images/tutwuri.png') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<style>


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}



body{

    background:#f8f9fe;

}



/* ================= SIDEBAR ================= */


.sidebar{

    width:260px;

    height:100vh;

    background:#172b4d;

    position:fixed;

    left:0;

    top:0;

    padding:25px;

    color:white;

}



.logo{

    font-size:24px;

    font-weight:bold;

    margin-bottom:40px;

}



.menu a{

    display:flex;

    align-items:center;

    gap:12px;

    color:white;

    text-decoration:none;

    padding:14px;

    margin-bottom:10px;

    border-radius:12px;

    transition:.3s;

}



.menu a:hover,
.menu a.active{

    background:#324cdd;

}



/* ================= MAIN ================= */


.main{

    margin-left:260px;

}



.navbar{

    background:white;

    padding:20px 30px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 2px 10px rgba(0,0,0,.05);

}



.content{

    padding:30px;

}



.profile{

    display:flex;

    align-items:center;

    gap:10px;

}



/* ================= DASHBOARD ================= */


.cards{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

}



.card{

    padding:25px;

    border-radius:18px;

    color:white;

    box-shadow:0 5px 20px rgba(0,0,0,.08);

}



.blue{

    background:linear-gradient(45deg,#5e72e4,#825ee4);

}



.green{

    background:linear-gradient(45deg,#2dce89,#2dcecc);

}



.orange{

    background:linear-gradient(45deg,#fb6340,#fbb140);

}



.red{

    background:linear-gradient(45deg,#f5365c,#f56036);

}



/* ================= TABLE ================= */


.table-container{


    background:white;

    padding:20px;

    border-radius:15px;

    box-shadow:
    0 5px 20px rgba(0,0,0,.05);

    overflow-x:auto;


}



.table-container table{


    width:100%;

    border-collapse:collapse;

    table-layout:fixed;


}



.table-container th{


    background:#5e72e4;

    color:white;

    padding:12px;

    text-align:center;

    font-weight:bold;

    white-space:nowrap;

    border-right:
    1px solid rgba(255,255,255,.3);


}



.table-container td{


    padding:12px;

    border-bottom:1px solid #eee;

    border-right:1px solid #eee;

    vertical-align:middle;


}



.table-container th,
.table-container td{

    vertical-align:middle;

}



.table-container th:last-child,
.table-container td:last-child{

    border-right:none;

}



.table-container tbody tr:hover{


    background:#f8f9fe;


}



/* Nomor */


.table-container th:nth-child(1),
.table-container td:nth-child(1){

    width:5%;

    text-align:center;

}



/* Foto */


.table-container th:nth-child(2),
.table-container td:nth-child(2){

    width:10%;

    text-align:center;

}



/* Nama */


.table-container th:nth-child(3),
.table-container td:nth-child(3){

    width:20%;

}



/* NIS */


.table-container th:nth-child(4),
.table-container td:nth-child(4){

    width:12%;

    text-align:center;

}



/* Kelas */


.table-container th:nth-child(5),
.table-container td:nth-child(5){

    width:15%;

    text-align:center;

}



/* Alamat */


.table-container th:nth-child(6),
.table-container td:nth-child(6){

    width:23%;

    overflow:hidden;

    white-space:nowrap;

    text-overflow:ellipsis;

}



/* Aksi */


.table-container th:nth-child(7),
.table-container td:nth-child(7){

    width:15%;

    text-align:center;

    white-space:nowrap;

}




/* ================= FOTO ================= */


.student-photo{


    width:45px;

    height:45px;

    object-fit:cover;

    border-radius:50%;

    display:block;

    margin:auto;


}



/* ================= BUTTON ACTION ================= */


.table-action{


    display:flex;

    justify-content:center;

    align-items:center;

    gap:8px;


}



button,
a{

    transition:.3s;

}



button:hover,
a:hover{

    opacity:.85;

}



/* ================= FORM ================= */


input,
select,
textarea{

    outline:none;

}



</style>


</head>



<body>



<div class="sidebar">


<div class="logo">

PKBM Center

</div>



<div class="menu">



<a href="{{ route('dashboard') }}"
class="{{ request()->is('dashboard') ? 'active':'' }}">

<i class="fa-solid fa-house"></i>

Dashboard

</a>



<a href="{{ route('students.index') }}"
class="{{ request()->is('students*') ? 'active':'' }}">

<i class="fa-solid fa-users"></i>

Data Siswa

</a>



<a href="{{ route('teachers.index') }}"
class="{{ request()->is('teachers*') ? 'active':'' }}">

<i class="fa-solid fa-chalkboard-user"></i>

Data Guru

</a>



<a href="{{ route('classes.index') }}"
class="{{ request()->is('classes*') ? 'active':'' }}">

<i class="fa-solid fa-school"></i>

Data Kelas

</a>



<a href="{{ route('attendance.index') }}"
class="{{ request()->is('attendance*') ? 'active':'' }}">

<i class="fa-solid fa-calendar-check"></i>

Absensi

</a>



<a href="{{ route('attendance.report') }}"
class="{{ request()->is('attendance-report*') ? 'active':'' }}">

<i class="fa-solid fa-file-lines"></i>

Laporan Absensi

</a>



</div>


</div>





<div class="main">



<div class="navbar">


<h2>
Dashboard Admin
</h2>



<div class="profile">


<strong>

{{ Auth::user()->name }}

</strong>



<form method="POST"
action="{{ route('logout') }}">

@csrf


<button type="submit"
style="
border:none;
background:#f5365c;
color:white;
padding:8px 12px;
border-radius:8px;
cursor:pointer;
">

Logout

</button>


</form>


</div>


</div>





<div class="content">


@if(session('success'))

<div style="
background:#2dce89;
color:white;
padding:15px;
border-radius:10px;
margin-bottom:20px;
font-weight:bold;
">

{{ session('success') }}

</div>

@endif



@yield('content')



</div>



</div>



</body>

</html>