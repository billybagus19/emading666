@extends('layouts.main')

@section('title', 'Dashboard Guru - E-Mading')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard Guru</h1>
                    <p class="text-gray-600">Selamat datang, {{ Auth::user()->nama }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('emading.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('guru.artikels') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        <i class="fas fa-newspaper mr-2"></i>Kelola Artikel
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Artikel</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalArtikel }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Artikel Published</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalArtikelPublished }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Menunggu Review</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $artikelsPending->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Articles -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Artikel Menunggu Review</h2>
            </div>
            <div class="p-6">
                @if($artikelsPending->count() > 0)
                    <div class="space-y-4">
                        @foreach($artikelsPending as $artikel)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $artikel->judul }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($artikel->isi, 150) }}</p>
                                    <div class="flex items-center mt-2 text-sm text-gray-500">
                                        <span>{{ $artikel->user->nama }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $artikel->kategori->nama_kategori }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $artikel->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2 ml-4">
                                    <a href="{{ route('guru.artikel.show', $artikel->id_artikel) }}" 
                                       class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                        <i class="fas fa-eye mr-1"></i>Lihat Detail
                                    </a>
                                    <form action="{{ route('guru.artikel.publish', $artikel->id_artikel) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700" 
                                                onclick="return confirm('ACC artikel ini?')">
                                            <i class="fas fa-check mr-1"></i>ACC
                                        </button>
                                    </form>
                                    <form action="{{ route('guru.artikel.reject', $artikel->id_artikel) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700" 
                                                onclick="return confirm('Reject artikel ini?')">
                                            <i class="fas fa-times mr-1"></i>Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-check-circle text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Tidak ada artikel yang menunggu review</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection