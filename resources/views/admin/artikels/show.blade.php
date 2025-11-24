@extends('layouts.main')

@section('title', 'Detail Artikel - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <a href="{{ route('admin.artikels') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Artikel
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header Artikel -->
            <div class="p-6 border-b">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $artikel->judul }}</h1>
                        <div class="flex items-center text-sm text-gray-600">
                            <span class="font-medium">{{ $artikel->user->nama }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $artikel->kategori->nama_kategori }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $artikel->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($artikel->status == 'published') bg-green-100 text-green-800
                        @elseif($artikel->status == 'pending') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($artikel->status) }}
                    </span>
                </div>
            </div>

            <!-- Gambar Artikel -->
            @if($artikel->foto)
            <div class="px-6 pt-6">
                <img src="{{ asset('storage/' . $artikel->foto) }}" 
                     alt="{{ $artikel->judul }}" 
                     class="w-full h-64 object-cover rounded-lg">
            </div>
            @endif

            <!-- Isi Artikel -->
            <div class="p-6">
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <div class="whitespace-pre-wrap">{!! nl2br(e($artikel->isi)) !!}</div>
                </div>
            </div>

            <!-- Alasan Penolakan -->
            @if($artikel->status == 'rejected' && $artikel->alasan_penolakan)
            <div class="px-6 pb-6">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-medium text-red-800 mb-2">Alasan Penolakan:</h4>
                            <p class="text-sm text-red-700">{{ $artikel->alasan_penolakan }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            @if($artikel->status == 'pending')
            <div class="px-6 pb-6 border-t pt-6">
                <div class="flex space-x-4">
                    <form action="{{ route('admin.artikel.publish', $artikel->id_artikel) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200"
                                onclick="return confirm('Publish artikel ini?')">
                            <i class="fas fa-check mr-2"></i>Publish Artikel
                        </button>
                    </form>
                    <button type="button" onclick="openRejectModal({{ $artikel->id_artikel }}, '{{ $artikel->judul }}')"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-200">
                        <i class="fas fa-times mr-2"></i>Reject Artikel
                    </button>

                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Reject Artikel -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Artikel</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Artikel:</label>
                        <p id="artikelTitle" class="text-sm text-gray-600 bg-gray-50 p-2 rounded"></p>
                    </div>
                    <div class="mb-4">
                        <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan *</label>
                        <textarea id="alasan_penolakan" name="alasan_penolakan" rows="4" 
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                  placeholder="Masukkan alasan penolakan artikel..." required></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()" 
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Tolak Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openRejectModal(artikelId, artikelTitle) {
    document.getElementById('artikelTitle').textContent = artikelTitle;
    document.getElementById('rejectForm').action = `/admin/artikel/${artikelId}/reject`;
    document.getElementById('alasan_penolakan').value = '';
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>
@endsection