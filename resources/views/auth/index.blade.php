@extends('layouts.main')

@section('title', 'E-Mading Digital')

@section('content')
<!-- Hero Section -->
<div class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">
            Selamat Datang di <span class="text-yellow-300">E-Mading</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
            Platform digital untuk berbagi informasi, berita, dan karya siswa dalam bentuk mading modern yang interaktif
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if(!Auth::check())
                <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>Bergabung Sekarang
                </a>
            @endif
            <a href="#artikel" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition-colors">
                <i class="fas fa-newspaper mr-2"></i>Lihat Artikel
            </a>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="card-hover bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ App\Models\Artikel::where('status', 'published')->count() }}</div>
                <div class="text-gray-600">Artikel Terbit</div>
            </div>
            <div class="card-hover bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ App\Models\User::where('role', 'siswa')->count() }}</div>
                <div class="text-gray-600">Siswa Terdaftar</div>
            </div>
            <div class="card-hover bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl">
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ App\Models\User::where('role', 'guru')->count() }}</div>
                <div class="text-gray-600">Guru Terdaftar</div>
            </div>
            <div class="card-hover bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl">
                <div class="text-3xl font-bold text-red-600 mb-2">{{ App\Models\Kategori::count() }}</div>
                <div class="text-gray-600">Kategori Artikel</div>
            </div>
        </div>
    </div>
</div>

<!-- Kategori Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Artikel</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Temukan artikel berdasarkan kategori yang Anda minati</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($kategoris as $kategori)
                <a href="{{ route('emading.kategori', $kategori->id_kategori) }}" 
                   class="card-hover bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition-all">
                    <div class="text-2xl mb-2">
                        @switch($kategori->nama_kategori)
                            @case('Berita Sekolah')
                                <i class="fas fa-school text-blue-500"></i>
                                @break
                            @case('Kegiatan')
                                <i class="fas fa-calendar-alt text-green-500"></i>
                                @break
                            @case('Prestasi')
                                <i class="fas fa-trophy text-yellow-500"></i>
                                @break
                            @case('Karya Siswa')
                                <i class="fas fa-palette text-purple-500"></i>
                                @break
                            @case('Teknologi')
                                <i class="fas fa-laptop-code text-red-500"></i>
                                @break
                            @default
                                <i class="fas fa-folder text-gray-500"></i>
                        @endswitch
                    </div>
                    <div class="text-sm font-medium text-gray-700">{{ $kategori->nama_kategori }}</div>
                    <div class="text-xs text-gray-500">{{ $kategori->artikels()->where('status', 'published')->count() }} artikel</div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Artikel Terbaru Section -->
<div id="artikel" class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Artikel Terbaru</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Temukan artikel terbaru dari siswa dan guru kami</p>
        </div>

        @if($artikels->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($artikels as $artikel)
                    <article class="artikel-card card-hover rounded-xl shadow-lg overflow-hidden">
                        @if($artikel->foto)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $artikel->foto) }}" 
                                     alt="{{ $artikel->judul }}" 
                                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $artikel->kategori->nama_kategori }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <i class="fas fa-newspaper text-4xl text-white"></i>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-user mr-1"></i>
                                <span>{{ $artikel->user->nama }}</span>
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar mr-1"></i>
                                <span>{{ $artikel->tanggal->format('d M Y') }}</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                <a href="{{ route('emading.show', $artikel->id_artikel) }}" 
                                   class="hover:text-indigo-600 transition-colors">
                                    {{ $artikel->judul }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($artikel->isi), 150) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <i class="fas fa-heart mr-1 {{ Auth::check() && $artikel->isLikedBy(Auth::id()) ? 'text-red-500' : '' }}"></i>
                                        {{ $artikel->getLikeCount() }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-comment mr-1"></i>
                                        {{ $artikel->komentars()->count() }}
                                    </span>
                                </div>
                                <a href="{{ route('emading.show', $artikel->id_artikel) }}" 
                                   class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                {{ $artikels->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500 mb-6">Artikel akan muncul di sini setelah dipublish oleh admin</p>
                @if(Auth::check() && Auth::user()->isSiswa())
                    <a href="{{ route('siswa.artikel.create') }}" 
                       class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Buat Artikel Pertama
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- CTA Section -->
<div class="gradient-bg py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Memulai?</h2>
        <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan komunitas E-Mading dan bagikan karya terbaik Anda
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if(!Auth::check())
                <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </a>
            @endif
            <a href="#artikel" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition-colors">
                <i class="fas fa-newspaper mr-2"></i>Jelajahi Artikel
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Smooth scroll untuk tombol "Lihat Artikel"
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });
    });
</script>
@endsection