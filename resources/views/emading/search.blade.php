@extends('layouts.main')

@section('title', 'Pencarian - E-Mading')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Hasil Pencarian</h1>
            <p class="text-gray-600">Menampilkan hasil untuk: "{{ $query }}"</p>
        </div>

        @if($artikels->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($artikels as $artikel)
                <a href="{{ route('emading.show', $artikel->id_artikel) }}" class="block">
                    <div class="bg-white rounded-lg shadow hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                        @if($artikel->foto)
                        <div class="w-full h-48 overflow-hidden rounded-t-lg">
                            <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}" 
                                 class="w-full h-full artikel-card-image hover:scale-105 transition-transform duration-300">
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span>{{ $artikel->kategori->nama_kategori }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $artikel->tanggal->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-indigo-600 transition-colors">
                                {{ $artikel->judul }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $artikel->user->nama }}
                                    @if($artikel->user->kelas)
                                        - {{ $artikel->user->kelas }}
                                    @endif
                                </span>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span><i class="fas fa-heart"></i> {{ $artikel->likes->count() }}</span>
                                    <span><i class="fas fa-comment"></i> {{ $artikel->komentars->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan {{ $artikels->firstItem() ?? 0 }} - {{ $artikels->lastItem() ?? 0 }} dari {{ $artikels->total() }} hasil pencarian untuk "{{ $query }}"
                        </div>
                        <div class="flex justify-center">
                            {{ $artikels->appends(['q' => $query])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Tidak ada artikel yang ditemukan untuk "{{ $query }}"</p>
            </div>
        @endif
    </div>
</div>
@endsection