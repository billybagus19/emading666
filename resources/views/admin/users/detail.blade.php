@extends('layouts.main')

@section('title', 'Detail User - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Detail User</h1>
                <a href="{{ route('admin.log') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Log
                </a>
            </div>
        </div>

        <!-- User Info -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">Informasi User</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <p class="text-gray-900">{{ $user->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <p class="text-gray-900">{{ $user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($user->role == 'admin') bg-red-100 text-red-800
                            @elseif($user->role == 'guru') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Terdaftar</label>
                        <p class="text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Articles -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">Artikel ({{ $user->artikels->count() }})</h2>
            </div>
            <div class="p-6">
                @if($user->artikels->count() > 0)
                    <div class="space-y-3">
                        @foreach($user->artikels as $artikel)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $artikel->judul }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $artikel->created_at->format('d M Y') }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($artikel->status == 'published') bg-green-100 text-green-800
                                    @elseif($artikel->status == 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($artikel->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada artikel</p>
                @endif
            </div>
        </div>

        <!-- User Activity Log -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">Log Aktivitas ({{ $user->logAktivitas->count() }})</h2>
            </div>
            <div class="p-6">
                @if($user->logAktivitas->count() > 0)
                    <div class="space-y-3">
                        @foreach($user->logAktivitas->take(10) as $log)
                        <div class="border-l-4 border-indigo-500 pl-4 py-2">
                            <div class="flex justify-between items-start">
                                <p class="text-gray-600">{{ $log->aksi }}</p>
                                <span class="text-sm text-gray-500">{{ $log->waktu->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                        @endforeach
                        @if($user->logAktivitas->count() > 10)
                        <p class="text-sm text-gray-500 text-center pt-2">
                            Dan {{ $user->logAktivitas->count() - 10 }} aktivitas lainnya...
                        </p>
                        @endif
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada aktivitas</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection