@extends('layouts.main')

@section('title', 'Log Aktivitas - Admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Log Aktivitas</h1>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                @if($logs->count() > 0)
                    <div class="space-y-4">
                        @foreach($logs as $log)
                        <div class="border-l-4 border-indigo-500 pl-4 py-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">
                                        <a href="{{ route('admin.users.detail', $log->user->id_user) }}" 
                                           class="text-indigo-600 hover:text-indigo-800 hover:underline">
                                            {{ $log->user->nama }}
                                        </a>
                                    </p>
                                    <p class="text-gray-600">{{ $log->aksi }}</p>
                                </div>
                                <span class="text-sm text-gray-500">{{ $log->waktu->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $logs->links() }}
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada log aktivitas</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection