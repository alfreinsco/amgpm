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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Jumlah Anggota Ranting</h3>
                    <p class="mt-1 text-4xl font-extrabold text-blue-600">125</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Kegiatan Mendatang</h3>
                    <p class="mt-1 text-2xl font-bold text-gray-800">1</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fas fa-calendar-check text-yellow-600 text-2xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Ulang Tahun Bulan ini</h3>
                    <p class="mt-1 text-2xl font-bold text-gray-800">2</p>
                </div>
                <div class="p-3 bg-red-100 rounded-full">
                    <i class="fas fa-bullhorn text-red-600 text-2xl"></i>
                </div>
            </div>

        </div>

        <div class="mt-8 text-center text-gray-400">
            <p>&copy; 2025 AMGPM Ranting Parthenos. Hak Cipta Dilindungi.</p>
        </div>

    </div>
</div>
@endsection
