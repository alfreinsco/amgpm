@extends('layouts.app')

@section('title', 'Profil Saya - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div role="alert" class="alert alert-success mb-6 rounded-lg border-l-4 border-green-500 bg-green-50 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-2xl border border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-8 pb-6 border-b border-gray-200">
                <div>
                    <h2 class="text-3xl font-extrabold text-blue-900">Profil Saya</h2>
                    <p class="mt-2 text-sm text-gray-500">Lihat dan kelola informasi profil Anda.</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn bg-blue-600 text-white hover:bg-blue-700 shadow-md mt-4 sm:mt-0">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Profil
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Nama Lengkap</p>
                        <p class="text-lg font-medium text-gray-800">{{ $user->nama ?? 'Belum diisi' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Email</p>
                        <p class="text-lg font-medium text-gray-800">{{ $user->email }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">WhatsApp</p>
                        <p class="text-lg font-medium text-gray-800">{{ $user->whatsapp ?? 'Belum diisi' }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Tempat Lahir</p>
                        <p class="text-lg font-medium text-gray-800">{{ $user->tempat_lahir ?? 'Belum diisi' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Tanggal Lahir</p>
                        <p class="text-lg font-medium text-gray-800">{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : 'Belum diisi' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Golongan Darah</p>
                        <p class="text-lg font-medium text-gray-800">{{ $user->golongan_darah ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-200 text-gray-500">
                <p class="text-xs"><strong>Bergabung sejak:</strong> {{ $user->created_at->format('d F Y') }}</p>
                <p class="text-xs mt-1"><strong>Terakhir diperbarui:</strong> {{ $user->updated_at->format('d F Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
