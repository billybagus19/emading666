@extends('layouts.main')

@section('title', 'Kelola Kategori - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori</h1>
        </div>

        <!-- Form Tambah Kategori -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Tambah Kategori Baru</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="flex gap-4">
                        <input type="text" name="nama_kategori" placeholder="Nama Kategori" 
                               class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Daftar Kategori -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Kategori</h2>
            </div>
            <div class="p-6">
                @if($kategoris->count() > 0)
                    <div class="space-y-4">
                        @foreach($kategoris as $kategori)
                        <div class="flex justify-between items-center p-4 border rounded-lg">
                            <span class="font-medium text-gray-900">{{ $kategori->nama_kategori }}</span>
                            <div class="flex gap-2">
                                <button onclick="editKategori({{ $kategori->id_kategori }}, '{{ $kategori->nama_kategori }}')" 
                                        class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" 
                                            onclick="return confirm('Yakin hapus kategori ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada kategori</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4 text-gray-900">Edit Kategori</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="editNama" name="nama_kategori" 
                       class="w-full px-4 py-2 border rounded-lg mb-4" required>
                <div class="flex gap-2">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Update</button>
                    <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editKategori(id, nama) {
    document.getElementById('editForm').action = `/admin/kategori/${id}`;
    document.getElementById('editNama').value = nama;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection