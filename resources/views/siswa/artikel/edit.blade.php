@extends('layouts.main')

@section('title', 'Edit Artikel - E-Mading')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Artikel</h1>
            <p class="text-gray-600">Perbarui artikel Anda</p>
        </div>

        <!-- Notifikasi Alasan Penolakan -->
        @if($artikel->status == 'rejected' && $artikel->alasan_penolakan)
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-3"></i>
                <div>
                    <h4 class="text-sm font-medium text-red-800 mb-2">Artikel Anda Ditolak</h4>
                    <p class="text-sm text-red-700 mb-2"><strong>Alasan:</strong> {{ $artikel->alasan_penolakan }}</p>
                    <p class="text-sm text-red-600">Silakan perbaiki artikel sesuai dengan alasan penolakan di atas, kemudian submit kembali untuk verifikasi.</p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <form action="{{ route('siswa.artikel.update', $artikel->id_artikel) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $artikel->judul) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                               placeholder="Masukkan judul artikel">
                        @error('judul')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="id_kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="id_kategori" id="id_kategori" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" 
                                        {{ old('id_kategori', $artikel->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">Isi Artikel</label>
                        <textarea name="isi" id="isi" rows="10" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                  placeholder="Tulis isi artikel di sini...">{{ old('isi', $artikel->isi) }}</textarea>
                        @error('isi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto Artikel (Opsional)</label>
                        @if($artikel->foto)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $artikel->foto) }}" alt="Foto saat ini" class="w-32 h-32 object-cover rounded-lg">
                                <p class="text-sm text-gray-500 mt-1">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="foto" id="foto" accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
                        @error('foto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('siswa.dashboard') }}" 
                           class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" 
                                class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-save mr-2"></i>Update Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection