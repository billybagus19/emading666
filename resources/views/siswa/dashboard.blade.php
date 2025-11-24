@extends('layouts.main')

@section('title', 'Dashboard Siswa - E-Mading')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard Siswa</h1>
                    <p class="text-gray-600">Selamat datang, {{ Auth::user()->nama }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('siswa.artikel.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        <i class="fas fa-plus mr-2"></i>Tulis Artikel
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Artikel</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalArtikels ?? 0 }}</p>
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
                        <p class="text-2xl font-semibold text-gray-900">{{ $publishedArtikels ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Artikel Pending</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingArtikels ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        @if($notifikasis->count() > 0)
        <div class="bg-white rounded-xl shadow-sm mb-8">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">Notifikasi</h2>
                    <button onclick="markAllAsRead()" class="text-sm text-indigo-600 hover:text-indigo-800">
                        <i class="fas fa-check-double mr-1"></i>Tandai Semua Dibaca
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach($notifikasis as $notifikasi)
                    <div class="flex items-start p-4 rounded-lg {{ $notifikasi->dibaca ? 'bg-gray-50' : 'bg-blue-50 border-l-4 border-blue-500' }} transition-colors" 
                         id="notif-{{ $notifikasi->id_notifikasi }}">
                        <div class="flex-shrink-0 mr-3">
                            @if($notifikasi->tipe == 'approved')
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                            @else
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-times text-red-600"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 mb-1">{{ $notifikasi->judul }}</h4>
                            <p class="text-gray-600 text-sm mb-2">{{ $notifikasi->pesan }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>{{ $notifikasi->created_at->diffForHumans() }}
                                </span>
                                @if(!$notifikasi->dibaca)
                                <button onclick="markAsRead({{ $notifikasi->id_notifikasi }})" 
                                        class="text-xs text-indigo-600 hover:text-indigo-800">
                                    <i class="fas fa-check mr-1"></i>Tandai Dibaca
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Recent Articles -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Artikel Saya</h2>
            </div>
            <div class="p-6">
                @if(isset($artikels) && $artikels->count() > 0)
                    <div class="space-y-4">
                        @foreach($artikels as $artikel)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $artikel->judul }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($artikel->isi, 150) }}</p>
                                    <div class="flex items-center mt-2 text-sm text-gray-500">
                                        <span>{{ $artikel->tanggal->format('d M Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span class="px-2 py-1 rounded-full text-xs
                                            @if($artikel->status == 'published') bg-green-100 text-green-800
                                            @elseif($artikel->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($artikel->status == 'rejected') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($artikel->status) }}
                                        </span>
                                    </div>
                                    @if($artikel->status == 'rejected' && $artikel->alasan_penolakan)
                                    <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                                        <p class="text-sm text-red-800">
                                            <strong>Alasan Penolakan:</strong> {{ $artikel->alasan_penolakan }}
                                        </p>
                                        <p class="text-xs text-red-600 mt-1">
                                            Silakan edit artikel dan kirim ulang setelah diperbaiki.
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex space-x-2 ml-4">
                                    @if($artikel->status == 'draft' || $artikel->status == 'rejected')
                                    <a href="{{ route('siswa.artikel.edit', $artikel->id_artikel) }}" 
                                       class="text-indigo-600 hover:text-indigo-900" title="Edit Artikel">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    
                                    @if($artikel->status == 'draft' || $artikel->status == 'rejected')
                                    <form action="{{ route('siswa.artikel.submit', $artikel->id_artikel) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900" 
                                                title="{{ $artikel->status == 'rejected' ? 'Kirim Ulang setelah Perbaikan' : 'Submit untuk Verifikasi Guru' }}">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    @if($artikel->status == 'draft' || $artikel->status == 'rejected')
                                    <form action="{{ route('siswa.artikel.destroy', $artikel->id_artikel) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" 
                                                title="Hapus Artikel"
                                                onclick="return confirm('Yakin hapus artikel ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada artikel. Mulai tulis artikel pertama Anda!</p>
                        <a href="{{ route('siswa.artikel.create') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Tulis Artikel
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function markAsRead(notifikasiId) {
    fetch(`/siswa/notifikasi/${notifikasiId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notifElement = document.getElementById(`notif-${notifikasiId}`);
            notifElement.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-500');
            notifElement.classList.add('bg-gray-50');
            
            // Hide mark as read button
            const button = notifElement.querySelector('button[onclick*="markAsRead"]');
            if (button) button.style.display = 'none';
        }
    });
}

function markAllAsRead() {
    fetch('/siswa/notifikasi/read-all', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all notification styles
            document.querySelectorAll('[id^="notif-"]').forEach(element => {
                element.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-500');
                element.classList.add('bg-gray-50');
                
                // Hide mark as read buttons
                const button = element.querySelector('button[onclick*="markAsRead"]');
                if (button) button.style.display = 'none';
            });
            
            // Hide mark all as read button
            document.querySelector('button[onclick="markAllAsRead()"]').style.display = 'none';
        }
    });
}
</script>
@endsection