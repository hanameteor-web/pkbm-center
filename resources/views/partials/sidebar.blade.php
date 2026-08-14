@if(auth()->check() && auth()->user()->role == 'admin')

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}"
       href="{{ route('teachers.index') }}">
        Data Guru
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}"
       href="{{ route('classes.index') }}">
        Data Kelas
    </a>
</li>

@endif