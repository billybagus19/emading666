@extends('layouts.main')

@section('title', 'Buat Artikel - E-Mading')

@section('content')
<div class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="flex items-center">
                <a href="{{ route('siswa.dashboard') }}" 
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors mr-4">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Buat Artikel Baru</h1>
                    <p class="text-gray-600">Bagikan karya dan informasi dengan komunitas sekolah</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                            <div>
                                <p class="text-red-700 font-medium">Terjadi kesalahan!</p>
                                @foreach ($errors->all() as $error)
                                    <p class="text-red-600 text-sm">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('siswa.artikel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-heading mr-1"></i>Judul Artikel *
                            </label>
                            <input type="text" name="judul" id="judul" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                                   placeholder="Masukkan judul artikel" value="{{ old('judul') }}">
                        </div>
                        
                        <div>
                            <label for="id_kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-folder mr-1"></i>Kategori *
                            </label>
                            <select name="id_kategori" id="id_kategori" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors">
                                <option value="">Pilih kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-1"></i>Isi Artikel *
                        </label>
                        <textarea name="isi" id="isi" rows="12" required 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                                  placeholder="Tulis isi artikel di sini...">{{ old('isi') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Anda dapat menggunakan format teks biasa. Artikel akan otomatis tersimpan sebagai draft.
                        </p>
                    </div>

                    <div class="mb-6">
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-1"></i>Foto/Gambar (Opsional)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition-colors">
                            <input type="file" name="foto" id="foto" accept="image/*" 
                                   class="hidden" onchange="previewImage(this)">
                            <div id="preview-container" class="hidden mb-4">
                                <img id="preview-image" src="" alt="Preview" 
                                     class="max-w-full h-48 object-cover rounded-lg mx-auto">
                            </div>
                            <div id="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600">Klik untuk memilih gambar</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            Artikel akan disimpan sebagai draft dan dapat disubmit untuk verifikasi nanti
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" 
                                    onclick="window.location='{{ route('siswa.dashboard') }}'"
                                    class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors">
                                <i class="fas fa-times mr-2"></i>Batal
                            </button>
                            <button type="submit" 
                                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Simpan sebagai Draft
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        const container = document.getElementById('preview-container');
        const placeholder = document.getElementById('upload-placeholder');
        const preview = document.getElementById('preview-image');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Make the upload area clickable
    document.getElementById('upload-placeholder').addEventListener('click', function() {
        document.getElementById('foto').click();
    });
</script>
@endsection