@extends('layouts.main')

@section('title', 'Laporan Artikel - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Laporan Artikel</h1>
            <a href="{{ route('admin.laporan.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                <i class="fas fa-file-pdf mr-2"></i>Download PDF
            </a>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Artikel Diterbitkan</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $artikels->where('status', 'published')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-times-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Artikel Ditolak</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $artikels->where('status', 'rejected')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Artikel</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $artikels->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                @if($artikels->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($artikels as $artikel)
                                <tr>
                                    <td class="px-6 py-4 text-gray-900">{{ $artikel->judul }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $artikel->user->nama }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $artikel->kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($artikel->status == 'published') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $artikel->status == 'published' ? 'Diterbitkan' : 'Ditolak' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">{{ $artikel->tanggal->format('d M Y') }}</td>
                                </tr>
                                @if($artikel->status == 'rejected' && $artikel->alasan_penolakan)
                                <tr class="bg-red-50">
                                    <td colspan="5" class="px-6 py-2 text-sm text-red-700">
                                        <strong>Alasan Penolakan:</strong> {{ $artikel->alasan_penolakan }}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada artikel yang diterbitkan atau ditolak</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection