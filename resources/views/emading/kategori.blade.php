@extends('layouts.main')

@section('title', 'Kategori: ' . $kategori->nama_kategori . ' - E-Mading')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $kategori->nama_kategori }}</h1>
            <p class="text-gray-600">Artikel dalam kategori {{ $kategori->nama_kategori }}</p>
        </div>

        <!-- Kategori Filter -->
        <div class="bg-white py-4 rounded-lg shadow mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('emading.index') }}" 
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors">
                    <i class="fas fa-home mr-1"></i>Semua
                </a>
                @foreach($kategoris as $kat)
                <a href="{{ route('emading.kategori', $kat->id_kategori) }}" 
                   class="px-4 py-2 {{ $kat->id_kategori == $kategori->id_kategori ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700' }} rounded-full hover:bg-indigo-200 transition-colors">
                    <i class="fas fa-folder mr-1"></i>{{ $kat->nama_kategori }}
                </a>
                @endforeach
            </div>
        </div>

        @if($artikels->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($artikels as $artikel)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    @if($artikel->foto)
                    <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}" 
                         class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-r from-indigo-400 to-purple-500 flex items-center justify-center">
                        <i class="fas fa-newspaper text-4xl text-white"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs">
                                {{ $artikel->kategori->nama_kategori }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>{{ $artikel->tanggal->format('d M Y') }}</span>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">
                            <a href="{{ route('emading.show', $artikel->id_artikel) }}" 
                               class="hover:text-indigo-600 transition-colors">
                                {{ $artikel->judul }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($artikel->isi, 120) }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-user mr-1"></i>
                                <span>{{ $artikel->user->nama }}</span>
                                @if($artikel->user->kelas)
                                    <span class="mx-1">-</span>
                                    <span>{{ $artikel->user->kelas }}</span>
                                @endif
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
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
                        
                        <div class="mt-4">
                            <a href="{{ route('emading.show', $artikel->id_artikel) }}" 
                               class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan {{ $artikels->firstItem() ?? 0 }} - {{ $artikels->lastItem() ?? 0 }} dari {{ $artikels->total() }} artikel dalam kategori {{ $kategori->nama_kategori }}
                        </div>
                        <div class="flex justify-center">
                            {{ $artikels->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500">Belum ada artikel dalam kategori {{ $kategori->nama_kategori }}</p>
            </div>
        @endif
    </div>
</div>
@endsection