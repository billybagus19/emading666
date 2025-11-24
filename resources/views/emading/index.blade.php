@extends('layouts.main')

@section('title', 'E-Mading - Beranda')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold mb-6 text-white animate-fade-in-up">
                Welcome di <span class="bg-gradient-to-r from-yellow-400 to-pink-400 bg-clip-text text-transparent">E-Mading</span>
            </h1>
            <p class="text-xl lg:text-2xl mb-8 text-gray-200 animate-fade-in-up animation-delay-300 max-w-3xl mx-auto">
                 Mading Digital SMK BAKTI NUSANTARA 666
            </p>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-10 animate-fade-in-up animation-delay-600">
             berbagi informasi, prestasi, dan karya siswa dalam satu platform digital yang mudah diakses
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up animation-delay-900">
                <a href="#artikel" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-full font-semibold hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <i class="fas fa-newspaper mr-2"></i>Baca Artikel
                </a>
                @auth
                    @if(Auth::user()->isSiswa())
                        <a href="{{ route('siswa.artikel.create') }}" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-purple-900 transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-plus mr-2"></i>Tulis Artikel
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Kategori Section -->
@if($kategoris->count() > 0)
<div class="bg-gradient-to-r from-gray-50 to-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8 animate-fade-in-up">Kategori Artikel</h2>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('emading.index') }}" 
               class="group px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-full hover:from-indigo-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg animate-slide-in-left">
                <i class="fas fa-home mr-2 group-hover:animate-bounce"></i>Semua
            </a>
            @foreach($kategoris as $kategori)
            <a href="{{ route('emading.kategori', $kategori->id_kategori) }}" 
               class="group px-6 py-3 bg-white text-gray-700 rounded-full hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 hover:text-white transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg animate-slide-in-left" style="animation-delay: {{ $loop->index * 100 }}ms">
                <i class="fas fa-folder mr-2 group-hover:animate-pulse"></i>{{ $kategori->nama_kategori }}
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Artikel Section -->
<div id="artikel" class="bg-gradient-to-br from-gray-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-6 animate-fade-in-up">Artikel Terbaru</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto animate-fade-in-up animation-delay-300">Baca artikel dan informasi terbaru dari sekolah</p>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6 rounded-full animate-fade-in-up animation-delay-600"></div>
        </div>

        @if($artikels->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($artikels as $artikel)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 animate-fade-in-up" style="animation-delay: {{ $loop->index * 150 }}ms">
                    <div class="relative overflow-hidden">
                        @if($artikel->foto)
                        <div class="w-full h-56 overflow-hidden">
                            <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}" 
                                 class="w-full h-full artikel-card-image group-hover:scale-110 transition-transform duration-700">
                        </div>
                        @else
                        <div class="w-full h-56 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center relative">
                            <i class="fas fa-newspaper text-5xl text-white animate-pulse"></i>
                            <div class="absolute inset-0 bg-black opacity-10"></div>
                        </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                {{ $artikel->kategori->nama_kategori }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-calendar mr-2 text-purple-500"></i>
                            <span>{{ $artikel->tanggal->format('d M Y') }}</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors duration-300">
                            <a href="{{ route('emading.show', $artikel->id_artikel) }}">
                                {{ $artikel->judul }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($artikel->isi), 120) }}
                        </p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-2">
                                    {{ substr($artikel->user->nama, 0, 2) }}
                                </div>
                                <div>
                                    <span class="font-medium">{{ $artikel->user->nama }}</span>
                                    @if($artikel->user->kelas)
                                        <span class="text-gray-400 text-xs block">{{ $artikel->user->kelas }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                @auth
                                <button onclick="toggleLikeCard({{ $artikel->id_artikel }})" 
                                        class="flex items-center hover:text-red-500 transition-colors transform hover:scale-110"
                                        id="like-btn-{{ $artikel->id_artikel }}">
                                    <i class="fas fa-heart mr-1" id="like-icon-{{ $artikel->id_artikel }}"></i>
                                    <span id="like-count-{{ $artikel->id_artikel }}">{{ $artikel->likes->count() }}</span>
                                </button>
                                @else
                                <span class="flex items-center text-gray-400">
                                    <i class="fas fa-heart mr-1"></i>
                                    {{ $artikel->likes->count() }}
                                </span>
                                @endauth
                                <span class="flex items-center hover:text-blue-500 transition-colors">
                                    <i class="fas fa-comment mr-1"></i>
                                    {{ $artikel->komentars->count() }}
                                </span>

                            </div>
                        </div>
                        
                        <a href="{{ route('emading.show', $artikel->id_artikel) }}" 
                           class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 animate-fade-in-up">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan {{ $artikels->firstItem() ?? 0 }} - {{ $artikels->lastItem() ?? 0 }} dari {{ $artikels->total() }} artikel
                        </div>
                        <div class="flex justify-center">
                            {{ $artikels->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 animate-fade-in-up">
                <div class="text-gray-300 text-8xl mb-6 animate-bounce">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-4">Belum Ada Artikel</h3>
                <p class="text-gray-500 text-lg mb-8">Artikel akan muncul setelah dipublikasi oleh guru</p>
                @auth
                    @if(Auth::user()->isSiswa())
                        <a href="{{ route('siswa.artikel.create') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-full font-semibold hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Buat Artikel Pertama
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
    
    // Animate elements on scroll
    function animateOnScroll() {
        $('.animate-fade-in-up').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animate-fade-in-up');
            }
        });
    }
    
    // Trigger animation on scroll
    $(window).on('scroll', animateOnScroll);
    animateOnScroll(); // Initial check
    
    // Add hover effects to cards
    $('.group').hover(
        function() {
            $(this).addClass('transform scale-105');
        },
        function() {
            $(this).removeClass('transform scale-105');
        }
    );
    
    // Initialize like states for cards
    initializeLikeStates();
});

// Function to toggle like for cards
function toggleLikeCard(artikelId) {
    const icon = document.getElementById(`like-icon-${artikelId}`);
    const countElement = document.getElementById(`like-count-${artikelId}`);
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
            icon.classList.add('text-red-500');
            icon.classList.remove('text-gray-500');
            icon.style.transform = 'scale(1.3)';
            setTimeout(() => icon.style.transform = 'scale(1)', 200);
        } else {
            icon.classList.add('text-gray-500');
            icon.classList.remove('text-red-500');
        }
        

    })
    .catch(error => {
        console.error('Error:', error);
        countElement.textContent = currentCount;
    });
}

// Initialize like states for all cards
function initializeLikeStates() {
    @auth
    @foreach($artikels as $artikel)
    const icon{{ $artikel->id_artikel }} = document.getElementById('like-icon-{{ $artikel->id_artikel }}');
    const isLiked = {{ $artikel->isLikedBy(Auth::id()) ? 'true' : 'false' }};
    
    if (isLiked) {
        icon{{ $artikel->id_artikel }}.classList.add('text-red-500');
        icon{{ $artikel->id_artikel }}.classList.remove('text-gray-500');
    }
    @endforeach
    @endauth
}
</script>
@endsection