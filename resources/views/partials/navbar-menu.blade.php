<li><a href="{{ route('dashboard') }}">Beranda</a></li>
<li><a href="{{ route('ibadah.index') }}">Jadwal Ibadah</a></li>
<li><a href="{{ route('ulang-tahun.index') }}">Jadwal Ulang Tahun</a></li>
@if(Auth::check() && Auth::user()->is_admin)
    <li><a href="{{ route('anggota.index') }}">Database Anggota</a></li>
@endif
