@extends('layouts.app')

@section('title', 'Beranda - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-2xl border border-gray-100 mb-8 flex flex-col md:flex-row items-center">
            <div class="md:w-3/4 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight">Selamat Datang di <br> Sistem Informasi AMGPM</h1>
                <p class="mt-4 text-lg text-gray-600">
                    Ranting Parthenos
                </p>
                <p class="mt-6 text-base text-gray-500">
                    Kelola data keanggotaan dan informasi ranting dengan mudah dan efisien.
                </p>
            </div>
            <div class="md:w-1/4 mt-8 md:mt-0 flex justify-center">
                <img src="{{ asset('img/logo-amgpm.png') }}" alt="AMGPM Logo" class="h-32 md:h-48">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Jumlah Anggota Ranting</h3>
                    <p class="mt-1 text-4xl font-extrabold text-blue-600">{{ $totalAnggota }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Kegiatan Mendatang</h3>
                    <p class="mt-1 text-2xl font-bold text-gray-800">{{ $kegiatanMendatang }}</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fas fa-calendar-check text-yellow-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Ulang Tahun Bulan Ini</h3>
                    <p class="mt-1 text-2xl font-bold text-gray-800">{{ $ulangTahunBulanIni }}</p>
                </div>
                <div class="p-3 bg-pink-100 rounded-full">
                    <i class="fas fa-birthday-cake text-pink-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Ulang Tahun Minggu Ini</h3>
                    <p class="mt-1 text-2xl font-bold text-gray-800">{{ $ulangTahunMingguIni->count() }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fas fa-gift text-purple-600 text-2xl"></i>
                </div>
            </div>

        </div>

        @if($ulangTahunMingguIni->count() > 0)
            <!-- Widget Ulang Tahun Minggu Ini -->
            <div class="mt-8 bg-gradient-to-r from-purple-500 to-pink-500 p-8 rounded-2xl shadow-2xl text-white">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center">
                            <i class="fas fa-birthday-cake mr-3 text-yellow-300"></i>
                            Ulang Tahun Minggu Ini
                        </h2>
                        <p class="text-white opacity-90 mt-1">Jangan lupa ucapkan selamat!</p>
                    </div>
                    <div class="text-right">
                        <span class="text-3xl font-bold text-white">{{ $ulangTahunMingguIni->count() }}</span>
                        <p class="text-white opacity-90 text-sm">Anggota</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($ulangTahunMingguIni as $anggota)
                        @php
                            $birthday = \Carbon\Carbon::parse($anggota->tanggal_lahir);
                            $birthdayThisYear = $birthday->copy()->setYear((int)date('Y'));
                            $isToday = $birthdayThisYear->isToday();
                            $age = $birthday->age;
                        @endphp

                        <div class="bg-white bg-opacity-25 backdrop-blur-sm rounded-lg p-4 border border-white border-opacity-40 shadow-lg {{ $isToday ? 'ring-2 ring-yellow-300 animate-pulse' : '' }}">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-lg font-bold mr-3 text-purple-800">
                                        {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $anggota->nama }}</h3>
                                        @if($anggota->is_admin)
                                            <span class="text-xs bg-yellow-300 text-purple-800 px-2 py-1 rounded-full font-medium">
                                                <i class="fas fa-user-shield mr-1"></i>Admin
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($isToday)
                                    <div class="text-yellow-300">
                                        <i class="fas fa-star text-xl animate-bounce"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-2 text-sm">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-calendar-day mr-2 w-4 text-purple-600"></i>
                                    <span>{{ $birthday->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-hourglass-half mr-2 w-4 text-purple-600"></i>
                                    <span>{{ $age }} tahun{{ $isToday ? ' → ' . ($age + 1) . ' tahun' : '' }}</span>
                                </div>
                                @if($isToday)
                                    <div class="mt-3 text-center">
                                        <span class="bg-yellow-300 text-purple-800 px-3 py-1 rounded-full text-xs font-bold">
                                            🎉 HARI INI! 🎂
                                        </span>
                                    </div>
                                @endif
                            </div>

                            @if($anggota->whatsapp)
                                <div class="mt-4">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $anggota->whatsapp) }}?text=Selamat%20ulang%20tahun%20{{ urlencode($anggota->nama) }}!%20🎉🎂"
                                       target="_blank"
                                       class="btn btn-sm bg-green-500 hover:bg-green-600 text-white w-full border-none">
                                        <i class="fab fa-whatsapp mr-2"></i>
                                        Ucapkan Selamat
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('ulang-tahun.index') }}" class="btn bg-white text-purple-600 hover:bg-purple-50 border-none">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Lihat Semua Jadwal Ulang Tahun
                    </a>
                </div>
            </div>
        @endif

        <div class="mt-8 text-center text-gray-400">
            <p>&copy; 2025 AMGPM Ranting Parthenos. Hak Cipta Dilindungi.</p>
        </div>

    </div>
</div>
@endsection
