<li>
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 transition-colors duration-200 text-gray-700 hover:text-blue-600 font-medium">
        <i class="fas fa-home text-blue-600"></i>
        <span>Beranda</span>
    </a>
</li>
<li>
    <a href="{{ route('ibadah.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-purple-50 transition-colors duration-200 text-gray-700 hover:text-purple-600 font-medium">
        <i class="fas fa-church text-purple-600"></i>
        <span>Jadwal Ibadah</span>
    </a>
</li>
<li>
    <a href="{{ route('ulang-tahun.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-pink-50 transition-colors duration-200 text-gray-700 hover:text-pink-600 font-medium">
        <i class="fas fa-birthday-cake text-pink-600"></i>
        <span>Jadwal Ulang Tahun</span>
    </a>
</li>
{{-- <li>
    <a href="{{ route('dokumentasi.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-indigo-50 transition-colors duration-200 text-gray-700 hover:text-indigo-600 font-medium">
        <i class="fas fa-book text-indigo-600"></i>
        <span>Dokumentasi</span>
    </a>
</li> --}}
@if(Auth::check() && Auth::user()->is_admin)
    <li>
        <a href="{{ route('anggota.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-50 transition-colors duration-200 text-gray-700 hover:text-green-600 font-medium">
            <i class="fas fa-users text-green-600"></i>
            <span>Database Anggota</span>
        </a>
    </li>
@endif
