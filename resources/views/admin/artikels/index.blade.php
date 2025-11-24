@extends('layouts.main')

@section('title', 'Kelola Artikel - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Kelola Artikel</h1>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                @if($artikels->count() > 0)
                    <div class="space-y-4">
                        @foreach($artikels as $artikel)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium">{{ $artikel->judul }}</h3>
                                    <p class="text-gray-600 text-sm">{{ Str::limit($artikel->isi, 100) }}</p>
                                    <div class="flex items-center mt-2 text-sm text-gray-500">
                                        <span>{{ $artikel->user->nama }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $artikel->kategori->nama_kategori }}</span>
                                        <span class="mx-2">•</span>
                                        <span class="px-2 py-1 rounded-full text-xs
                                            @if($artikel->status == 'published') bg-green-100 text-green-800
                                            @elseif($artikel->status == 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($artikel->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex space-x-2 ml-4">
                                    <a href="{{ route('admin.artikel.show', $artikel->id_artikel) }}" 
                                       class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($artikel->status == 'pending')
                                    <form action="{{ route('admin.artikel.publish', $artikel->id_artikel) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700" title="Publish">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <button type="button" onclick="openRejectModal({{ $artikel->id_artikel }}, '{{ $artikel->judul }}')"
                                            class="bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-yellow-700" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada artikel</p>
                @endif
            </div>
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