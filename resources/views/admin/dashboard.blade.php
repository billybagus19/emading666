@extends('layouts.main')

@section('title', 'Dashboard Admin - E-Mading')

@section('content')
<div class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-16 w-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                        {{ substr(Auth::user()->nama, 0, 2) }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
                        <p class="text-gray-600">Kelola dan pantau seluruh aktivitas E-Mading</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.artikels') }}" 
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-newspaper mr-2"></i>Kelola Artikel
                    </a>
                    <a href="{{ route('admin.laporan') }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-chart-bar mr-2"></i>Laporan
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalArtikel }}</div>
                        <div class="text-gray-600 text-sm">Total Artikel</div>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="text-green-600 font-semibold">{{ $totalArtikelPublished }}</span>
                    <span class="text-gray-500">telah dipublikasikan</span>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ $artikelsPending->count() }}</div>
                        <div class="text-gray-600 text-sm">Menunggu Verifikasi</div>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <a href="#pending" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalSiswa }}</div>
                        <div class="text-gray-600 text-sm">Total Siswa</div>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <a href="{{ route('admin.users.siswa') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        Lihat siswa <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-chalkboard-teacher text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalGuru }}</div>
                        <div class="text-gray-600 text-sm">Total Guru</div>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <a href="{{ route('admin.users.guru') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        Lihat guru <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Pending Articles -->
            <div id="pending" class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Artikel Menunggu Verifikasi</h2>
                    <p class="text-gray-600 text-sm mt-1">Artikel yang perlu segera diverifikasi</p>
                </div>
                
                <div class="p-6">
                    @if($artikelsPending->count() > 0)
                        <div class="space-y-4">
                            @foreach($artikelsPending as $artikel)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900 mb-2">
                                                <a href="{{ route('admin.artikel.show', $artikel->id_artikel) }}" 
                                                   class="hover:text-indigo-600 transition-colors">
                                                    {{ $artikel->judul }}
                                                </a>
                                            </h3>
                                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                                <i class="fas fa-user mr-1"></i>
                                                <span>{{ $artikel->user->nama }}</span>
                                                <span class="mx-2">•</span>
                                                <i class="fas fa-calendar mr-1"></i>
                                                <span>{{ $artikel->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-folder mr-1"></i>
                                                <span>{{ $artikel->kategori->nama_kategori }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="ml-4 flex items-center space-x-2">
                                            <a href="{{ route('admin.artikel.show', $artikel->id_artikel) }}" 
                                               class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                                Lihat Detail
                                            </a>
                                            <form action="{{ route('admin.artikel.publish', $artikel->id_artikel) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors"
                                                        title="Publish artikel"
                                                        onclick="return confirm('Publish artikel ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.artikel.reject', $artikel->id_artikel) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-yellow-700 transition-colors"
                                                        title="Reject artikel"
                                                        onclick="return confirm('Reject artikel ini?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.artikels') }}" 
                               class="text-indigo-600 hover:text-indigo-700 font-medium">
                                Lihat semua artikel <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-400 text-4xl mb-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="text-gray-600">Tidak ada artikel menunggu verifikasi</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Aktivitas Terbaru</h2>
                    <p class="text-gray-600 text-sm mt-1">Log aktivitas sistem</p>
                </div>
                
                <div class="p-6">
                    @php
                        $recentLogs = \App\Models\LogAktivitas::with('user')
                            ->orderBy('waktu', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @if($recentLogs->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentLogs as $log)
                                <div class="flex items-start space-x-3">
                                    <div class="h-8 w-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                        {{ substr($log->user->nama, 0, 2) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm">
                                            <span class="font-semibold text-gray-900">{{ $log->user->nama }}</span>
                                            <span class="text-gray-600">{{ $log->aksi }}</span>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $log->waktu->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.log') }}" 
                               class="text-indigo-600 hover:text-indigo-700 font-medium">
                                Lihat semua log <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-400 text-4xl mb-3">
                                <i class="fas fa-history"></i>
                            </div>
                            <p class="text-gray-600">Belum ada aktivitas</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.users') }}" 
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow block">
                <div class="text-center">
                    <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-2xl mx-auto mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Kelola User</h3>
                    <p class="text-gray-600 text-sm">Mengelola akun siswa, guru, dan admin</p>
                </div>
            </a>
            
            <a href="{{ route('admin.kategori') }}" 
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow block">
                <div class="text-center">
                    <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-2xl mx-auto mb-4">
                        <i class="fas fa-folder"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Kelola Kategori</h3>
                    <p class="text-gray-600 text-sm">Mengelola kategori artikel</p>
                </div>
            </a>
            
            <a href="{{ route('admin.laporan') }}" 
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow block">
                <div class="text-center">
                    <div class="h-16 w-16 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-2xl mx-auto mb-4">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Laporan</h3>
                    <p class="text-gray-600 text-sm">Lihat laporan dan statistik E-Mading</p>
                </div>
            </a>
        </div>
    </div>
</div>


@endsection