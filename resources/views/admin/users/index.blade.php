@extends('layouts.main')

@section('title', 'Kelola User - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">{{ $title ?? 'Kelola User' }}</h1>
                @if(isset($title))
                    <a href="{{ route('admin.users') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Semua User
                    </a>
                @endif
            </div>
        </div>

        <!-- Form Tambah User -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">Tambah User Baru</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}"
                               class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required
                               style="color: #1f2937 !important; background-color: white !important;">
                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}"
                               class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required
                               style="color: #1f2937 !important; background-color: white !important;">
                        <input type="password" name="password" placeholder="Password" 
                               class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required
                               style="color: #1f2937 !important; background-color: white !important;">
                        <select name="role" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" required
                                style="color: #1f2937 !important; background-color: white !important;" onchange="toggleKelas(this)">
                            <option value="">Pilih Role</option>
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru</option>
                            <option value="admin">Admin</option>
                        </select>
                        <input type="text" name="kelas" id="kelasField" placeholder="Kelas (untuk siswa)" value="{{ old('kelas') }}"
                               class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500" disabled
                               style="color: #1f2937 !important; background-color: white !important;">
                    </div>
                    <button type="submit" class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                        Tambah User
                    </button>
                </form>
            </div>
        </div>

        <!-- Daftar User -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">{{ $title ?? 'Daftar User' }}</h2>
            </div>
            <div class="p-6">
                @if($users->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terdaftar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($user->role == 'admin') bg-red-100 text-red-800
                                            @elseif($user->role == 'guru') bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->kelas ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editUser({{ $user->id_user }}, '{{ $user->nama }}', '{{ $user->username }}', '{{ $user->role }}', '{{ $user->kelas }}')" 
                                                class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if($user->id_user !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                    onclick="return confirm('Yakin hapus user ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada user</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Edit User</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <input type="text" id="editNama" name="nama" placeholder="Nama Lengkap" 
                           class="w-full px-4 py-2 border rounded-lg" required>
                    <input type="text" id="editUsername" name="username" placeholder="Username" 
                           class="w-full px-4 py-2 border rounded-lg" required>
                    <input type="password" id="editPassword" name="password" placeholder="Password (kosongkan jika tidak diubah)" 
                           class="w-full px-4 py-2 border rounded-lg">
                    <select id="editRole" name="role" class="w-full px-4 py-2 border rounded-lg" required onchange="toggleEditKelas(this)">
                        <option value="siswa">Siswa</option>
                        <option value="guru">Guru</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="text" id="editKelas" name="kelas" placeholder="Kelas (untuk siswa)" 
                           class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="flex gap-2 mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Update</button>
                    <button type="button" onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editUser(id, nama, username, role, kelas) {
    document.getElementById('editForm').action = `/admin/users/${id}`;
    document.getElementById('editNama').value = nama;
    document.getElementById('editUsername').value = username;
    document.getElementById('editRole').value = role;
    document.getElementById('editKelas').value = kelas || '';
    document.getElementById('editPassword').value = '';
    toggleEditKelas(document.getElementById('editRole'));
    document.getElementById('editModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function toggleKelas(select) {
    const kelasField = document.getElementById('kelasField');
    if (select.value === 'siswa') {
        kelasField.disabled = false;
        kelasField.required = true;
    } else {
        kelasField.disabled = true;
        kelasField.required = false;
        kelasField.value = '';
    }
}

function toggleEditKelas(select) {
    const kelasField = document.getElementById('editKelas');
    if (select.value === 'siswa') {
        kelasField.disabled = false;
    } else {
        kelasField.disabled = true;
        kelasField.value = '';
    }
}
</script>
@endsection