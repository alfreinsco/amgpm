@extends('layouts.app')

@section('title', 'Jadwal Ulang Tahun - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900">Jadwal Ulang Tahun</h1>
                <p class="mt-2 text-sm text-gray-500">Daftar ulang tahun anggota AMGPM Ranting Parthenos</p>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-birthday-cake text-2xl text-pink-500"></i>
                <span class="text-lg font-semibold text-gray-700">{{ $bulanList[$selectedMonth] }} {{ date('Y') }}</span>
            </div>
        </div>

        <!-- Filter Bulan -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <form method="GET" action="{{ route('ulang-tahun.index') }}" class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Filter Bulan
                    </label>
                    <select id="bulan"
                            name="bulan"
                            class="select select-bordered w-full"
                            onchange="this.form.submit()">
                        @foreach($bulanList as $key => $nama)
                            <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>
                                {{ $nama }}
                                @if($key == $currentMonth)
                                    (Bulan Ini)
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>
            </form>
        </div>

        @if($anggota->count() > 0)
            <!-- Statistics Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 p-6 rounded-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm">Total Ulang Tahun</p>
                            <p class="text-2xl font-bold">{{ $anggota->count() }}</p>
                        </div>
                        <i class="fas fa-birthday-cake text-3xl text-pink-200"></i>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-6 rounded-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm">Bulan Dipilih</p>
                            <p class="text-2xl font-bold">{{ $bulanList[$selectedMonth] }}</p>
                        </div>
                        <i class="fas fa-calendar text-3xl text-purple-200"></i>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 p-6 rounded-lg text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Minggu Ini</p>
                            <p class="text-2xl font-bold">
                                {{ $anggota->filter(function($item) {
                                    $birthday = \Carbon\Carbon::parse($item->tanggal_lahir)->setYear((int)date('Y'));
                                    return $birthday->isCurrentWeek();
                                })->count() }}
                            </p>
                        </div>
                        <i class="fas fa-gift text-3xl text-blue-200"></i>
                    </div>
                </div>
            </div>

            <!-- Birthday List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($anggota as $item)
                    @php
                        $birthday = \Carbon\Carbon::parse($item->tanggal_lahir);
                        $birthdayThisYear = $birthday->copy()->setYear((int)date('Y'));
                        $age = $birthday->age;
                        $daysUntilBirthday = $birthdayThisYear->diffInDays(\Carbon\Carbon::now(), false);
                        $isToday = $birthdayThisYear->isToday();
                        $isPast = $birthdayThisYear->isPast() && !$isToday;
                        $isThisWeek = $birthdayThisYear->isCurrentWeek();
                    @endphp

                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300 {{ $isToday ? 'ring-2 ring-pink-500 bg-gradient-to-br from-pink-50 to-rose-50' : '' }}">
                        <!-- Header -->
                        <div class="p-6 {{ $isToday ? 'bg-gradient-to-r from-pink-500 to-rose-500 text-white' : 'bg-gradient-to-r from-blue-500 to-purple-600 text-white' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-white bg-opacity-20 text-blue-500 rounded-full flex items-center justify-center text-lg font-bold mr-3">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg">{{ $item->nama }}</h3>
                                        @if($item->is_admin)
                                            <span class="text-xs bg-white bg-opacity-20 px-2 py-1 rounded-full">
                                                <i class="fas fa-user-shield mr-1"></i>Admin
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($isToday)
                                    <div class="text-right">
                                        <i class="fas fa-birthday-cake text-2xl animate-bounce"></i>
                                        <p class="text-xs mt-1">HARI INI!</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="space-y-4">
                                <!-- Tanggal Lahir -->
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-day text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                                        <p class="text-gray-900 font-semibold">
                                            {{ $birthday->format('d F Y') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Umur -->
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-hourglass-half text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Umur</p>
                                        <p class="text-gray-900 font-semibold">
                                            {{ $age }} tahun
                                            @if($isToday)
                                                → {{ $age + 1 }} tahun
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-purple-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Status</p>
                                        @if($isToday)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                                <i class="fas fa-birthday-cake mr-1"></i>
                                                Ulang Tahun Hari Ini!
                                            </span>
                                        @elseif($isThisWeek && !$isPast)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Minggu Ini
                                            </span>
                                        @elseif($isPast)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <i class="fas fa-check mr-1"></i>
                                                Sudah Lewat
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-calendar-plus mr-1"></i>
                                                Akan Datang
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($item->whatsapp)
                                    <!-- WhatsApp -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->whatsapp) }}?text=Selamat%20ulang%20tahun%20{{ urlencode($item->nama) }}!%20🎉🎂"
                                           target="_blank"
                                           class="btn btn-sm bg-green-500 hover:bg-green-600 text-white w-full">
                                            <i class="fab fa-whatsapp mr-2"></i>
                                            Ucapkan Selamat
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Info -->
            @if($anggota->count() > 0)
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        Menampilkan {{ $anggota->count() }} anggota yang berulang tahun di bulan {{ $bulanList[$selectedMonth] }}
                    </p>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white p-12 rounded-lg shadow-xl text-center border border-gray-100">
                <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-birthday-cake text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Tidak Ada Ulang Tahun</h3>
                <p class="text-gray-500 mb-6">
                    Tidak ada anggota yang berulang tahun di bulan {{ $bulanList[$selectedMonth] }}.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('ulang-tahun.index', ['bulan' => $currentMonth]) }}" class="btn btn-primary">
                        <i class="fas fa-calendar mr-2"></i>
                        Lihat Bulan Ini
                    </a>
                    @if(Auth::check() && Auth::user()->is_admin)
                        <a href="{{ route('anggota.index') }}" class="btn btn-outline">
                            <i class="fas fa-users mr-2"></i>
                            Kelola Anggota
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
