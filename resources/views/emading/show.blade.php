@extends('layouts.main')

@section('title', $artikel->judul . ' - E-Mading')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <a href="{{ route('emading.index') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
            </a>
        </nav>

        <!-- Artikel -->
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($artikel->foto)
            <div class="w-full h-64 md:h-96 overflow-hidden">
                <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}" 
                     class="w-full artikel-detail-image">
            </div>
            @endif
            
            <div class="p-8">
                <!-- Header -->
                <div class="mb-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full">
                            {{ $artikel->kategori->nama_kategori }}
                        </span>
                        <span class="mx-3">•</span>
                        <span>{{ $artikel->tanggal->format('d M Y') }}</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        {{ $artikel->judul }}
                    </h1>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-user mr-2"></i>
                            <span>{{ $artikel->user->nama }}</span>
                            @if($artikel->user->kelas)
                                <span class="mx-2">-</span>
                                <span>{{ $artikel->user->kelas }}</span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-4 text-gray-500">
                            <span class="flex items-center">
                                <i class="fas fa-heart mr-1 text-red-500"></i>
                                {{ $artikel->likes->count() }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-comment mr-1 text-blue-500"></i>
                                {{ $artikel->komentars->count() }}
                            </span>

                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="prose max-w-none mb-8 text-gray-800 leading-relaxed">
                    <div class="whitespace-pre-wrap">{!! nl2br(e($artikel->isi)) !!}</div>
                </div>

                <!-- Like Button -->
                <div class="border-t pt-6 mb-6">
                    @auth
                    <button onclick="toggleLike({{ $artikel->id_artikel }})" 
                            class="flex items-center space-x-2 text-red-500 hover:text-red-600 transition-colors transform hover:scale-105">
                        <i id="like-icon" class="fas fa-heart text-xl"></i>
                        <span id="like-count" class="font-semibold">{{ $artikel->likes->count() }}</span>
                        <span class="font-medium">Suka</span>
                    </button>
                    @else
                    <div class="flex items-center space-x-2 text-gray-400">
                        <i class="fas fa-heart text-xl"></i>
                        <span class="font-semibold">{{ $artikel->likes->count() }}</span>
                        <span class="font-medium">Suka</span>
                        <span class="text-sm ml-2">(<a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">Login</a> untuk menyukai)</span>
                    </div>
                    @endauth
                </div>

                <!-- Comments -->
                <div class="border-t pt-6">
                    <h3 class="text-xl font-semibold mb-4">
                        Komentar ({{ $artikel->komentars->count() }})
                    </h3>

                    <!-- Comments List -->
                    @if($artikel->komentars->count() > 0)
                        <div class="space-y-4 mb-6">
                            @foreach($artikel->komentars as $komentar)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium text-gray-900">{{ $komentar->user->nama }}</span>
                                    <span class="text-sm text-gray-500">{{ $komentar->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700">{{ $komentar->isi_komentar }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8 mb-6">Belum ada komentar</p>
                    @endif

                    @auth
                    <!-- Comment Form -->
                    <form action="{{ route('emading.komentar', $artikel->id_artikel) }}" method="POST">
                        @csrf
                        <div class="flex space-x-4">
                            <textarea name="isi_komentar" rows="3" placeholder="Tulis komentar..." required
                                      class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                            <button type="submit" 
                                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                                Kirim
                            </button>
                        </div>
                    </form>
                    @else
                    <p class="text-gray-500">
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">Login</a> 
                        untuk memberikan komentar
                    </p>
                    @endauth
                </div>
            </div>
        </article>
    </div>
</div>

<script>
function toggleLike(artikelId) {
    const icon = document.getElementById('like-icon');
    const countElement = document.getElementById('like-count');
    const currentCount = parseInt(countElement.textContent);
    
    fetch(`/artikel/${artikelId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        countElement.textContent = data.likeCount;
        
        if (data.liked) {
            icon.classList.add('fas', 'text-red-500');
            icon.classList.remove('far', 'text-gray-400');
            icon.style.transform = 'scale(1.2)';
            setTimeout(() => icon.style.transform = 'scale(1)', 200);
        } else {
            icon.classList.add('far', 'text-gray-400');
            icon.classList.remove('fas', 'text-red-500');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        countElement.textContent = currentCount;
    });
}

@auth
// Initialize like state on page load
document.addEventListener('DOMContentLoaded', function() {
    const icon = document.getElementById('like-icon');
    const isLiked = {{ $artikel->isLikedBy(Auth::id()) ? 'true' : 'false' }};
    
    if (isLiked) {
        icon.classList.add('fas', 'text-red-500');
        icon.classList.remove('far', 'text-gray-400');
    } else {
        icon.classList.add('far', 'text-gray-400');
        icon.classList.remove('fas', 'text-red-500');
    }
});
@endauth
</script>
@endsection