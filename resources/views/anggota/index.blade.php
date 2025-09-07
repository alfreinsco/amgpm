@extends('layouts.app')

@section('title', 'Database Anggota - ' . config('app.name', 'Laravel'))

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900">Database Anggota</h1>
                <p class="mt-2 text-sm text-gray-500">Kelola data anggota AMGPM Ranting Parthenos</p>
            </div>
            <a href="{{ route('anggota.create') }}" class="btn bg-blue-600 text-white hover:bg-blue-700 shadow-md">
                <i class="fas fa-plus mr-2"></i>
                Tambah Anggota
            </a>
        </div>

        @if (session('success'))
            <div role="alert" class="alert alert-success mb-6 rounded-lg border-l-4 border-green-500 bg-green-50 text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search and Filter Form -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <form method="GET" action="{{ route('anggota.index') }}" class="space-y-4">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-search mr-1"></i>
                            Cari Anggota
                        </label>
                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari berdasarkan nama, email, whatsapp, atau tempat lahir..."
                               class="input input-bordered w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Filter Options -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div>
                            <label for="golongan_darah" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tint mr-1"></i>
                                Golongan Darah
                            </label>
                            <select id="golongan_darah"
                                    name="golongan_darah"
                                    class="select select-bordered focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua</option>
                                <option value="A" {{ request('golongan_darah') === 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ request('golongan_darah') === 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ request('golongan_darah') === 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ request('golongan_darah') === 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>

                        <div>
                            <label for="is_admin" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user-shield mr-1"></i>
                                Status Admin
                            </label>
                            <select id="is_admin"
                                    name="is_admin"
                                    class="select select-bordered focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua</option>
                                <option value="1" {{ request('is_admin') === '1' ? 'selected' : '' }}>Admin</option>
                                <option value="0" {{ request('is_admin') === '0' ? 'selected' : '' }}>User Biasa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-2 pt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline">
                        <i class="fas fa-times mr-2"></i>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if($anggota->count() > 0)
            <!-- Table View -->
            <div class="bg-white rounded-lg shadow-xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="text-left font-semibold text-gray-700">Nama</th>
                                <th class="text-left font-semibold text-gray-700">Email</th>
                                <th class="text-left font-semibold text-gray-700">WhatsApp</th>
                                <th class="text-left font-semibold text-gray-700">Tempat, Tanggal Lahir</th>
                                <th class="text-left font-semibold text-gray-700">Jenis Kelamin</th>
                                <th class="text-left font-semibold text-gray-700">Gol. Darah</th>
                                <th class="text-left font-semibold text-gray-700">Status</th>
                                <th class="text-center font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="font-medium text-gray-900">{{ $item->nama }}</td>
                                    <td class="text-gray-600">{{ $item->email ?? '-' }}</td>
                                    <td class="text-gray-600">{{ $item->whatsapp ?? '-' }}</td>
                                    <td class="text-gray-600">{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td class="text-gray-600">{{ $item->jk }}</td>
                                    <td>
                                        <span class="badge badge-outline badge-sm">{{ $item->golongan_darah }}</span>
                                    </td>
                                    <td>
                                        @if($item->is_admin)
                                            <span class="badge badge-success badge-sm">
                                                <i class="fas fa-user-shield mr-1"></i>
                                                Admin
                                            </span>
                                        @else
                                            <span class="badge badge-ghost badge-sm">
                                                <i class="fas fa-user mr-1"></i>
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center gap-1">
                                            <a href="{{ route('anggota.show', $item) }}"
                                               class="btn btn-sm btn-ghost text-blue-600 hover:bg-blue-50"
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('anggota.edit', $item) }}"
                                               class="btn btn-sm btn-ghost text-yellow-600 hover:bg-yellow-50"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('anggota.reset-password', $item) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin mereset password ke format default (tanggal lahir)?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="btn btn-sm btn-ghost text-orange-600 hover:bg-orange-50"
                                                        title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('anggota.destroy', $item) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination Component -->
            <x-pagination :paginator="$anggota" label="anggota" />
        @else
            <div class="bg-white p-12 rounded-lg shadow-xl text-center border border-gray-100">
                <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-users text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Belum Ada Data Anggota</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan data anggota pertama.</p>
                <a href="{{ route('anggota.create') }}" class="btn bg-blue-600 text-white hover:bg-blue-700 shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Anggota Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
