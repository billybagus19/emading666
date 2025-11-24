<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Mading')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            min-height: 100vh;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dark-card {
            background: linear-gradient(145deg, #1e293b, #334155);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .card-hover { 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .card-hover:hover { 
            transform: translateY(-8px) scale(1.02); 
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }
        .gradient-text {
            background: linear-gradient(135deg, #60a5fa, #a78bfa, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .neon-glow {
            box-shadow: 0 0 20px rgba(96, 165, 250, 0.3);
        }
        .status-draft { background: linear-gradient(135deg, #fbbf24, #f59e0b); }
        .status-pending { background: linear-gradient(135deg, #60a5fa, #3b82f6); }
        .status-published { background: linear-gradient(135deg, #34d399, #10b981); }
        .status-rejected { background: linear-gradient(135deg, #f87171, #ef4444); }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-slide-in-left {
            animation: slideInLeft 1s ease-out;
        }
        
        .animation-delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
            animation-fill-mode: forwards;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        /* Fix input text color for light backgrounds */
        .bg-white input[type="text"], 
        .bg-white input[type="password"], 
        .bg-white input[type="email"], 
        .bg-white textarea, 
        .bg-white select {
            color: #1f2937 !important;
            background-color: white !important;
        }
        
        /* Dark theme inputs */
        .dark-input {
            background: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }
        .dark-input::placeholder {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        
        /* Artikel Image Styles */
        .artikel-thumbnail {
            aspect-ratio: 1/1;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        
        .artikel-card-image {
            aspect-ratio: 16/9;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .artikel-card-image:hover {
            transform: scale(1.05);
        }
        
        .artikel-detail-image {
            max-height: 400px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        
        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* New Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
            animation-fill-mode: forwards;
        }
        
        .animation-delay-600 {
            animation-delay: 0.6s;
            opacity: 0;
            animation-fill-mode: forwards;
        }
        
        .animation-delay-900 {
            animation-delay: 0.9s;
            opacity: 0;
            animation-fill-mode: forwards;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Responsive improvements */
        @media (max-width: 768px) {
            .animate-fade-in-up {
                animation-delay: 0s !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-900 text-white">
    <!-- Navigation -->
    <nav class="glass-effect shadow-2xl sticky top-0 z-50 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/posts/baknus.png') }}" alt="Baknus Logo" class="h-10 w-10 mr-3 animate-float">
                            <h1 class="text-2xl font-bold gradient-text animate-float">
                                E-Mading
                            </h1>
                        </div>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="{{ route('emading.index') }}" class="text-slate-300 hover:text-blue-400 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-slate-800/50">
                                <i class="fas fa-home mr-1"></i> Beranda
                            </a>
                            @if(Auth::check())
                                @if(Auth::user()->isSiswa())
                                    <a href="{{ route('siswa.dashboard') }}" class="text-slate-300 hover:text-blue-400 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-slate-800/50">
                                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-slate-300 hover:text-red-400 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-slate-800/50">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                        </button>
                                    </form>
                                @elseif(Auth::user()->isGuru())
                                    <a href="{{ route('guru.dashboard') }}" class="text-slate-300 hover:text-blue-400 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-slate-800/50">
                                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-slate-300 hover:text-red-400 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-slate-800/50">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-blue-400 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-slate-800/50">
                                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-slate-300 hover:text-red-400 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-slate-800/50">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Search Form -->
                    <form action="{{ route('emading.search') }}" method="GET" class="hidden md:block">
                        <div class="relative">
                            <input type="text" name="q" placeholder="Cari artikel..." value="{{ request('q') }}"
                                   class="w-64 pl-10 pr-4 py-2 dark-input rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <i class="fas fa-search absolute left-3 top-3 text-slate-400"></i>
                        </div>
                    </form>
                    
                    @if(Auth::check())
                        <div class="relative group">
                            <button class="flex items-center text-slate-300 hover:text-blue-400 focus:outline-none transition-colors">
                                <img class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold mr-2" 
                                     src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' /%3E%3C/svg%3E">
                                <span class="hidden md:block">{{ Auth::user()->nama }}</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 dark-card rounded-lg shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                                <div class="py-1">
                                    @if(Auth::user()->isSiswa())
                                        <a href="{{ route('siswa.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                            @php
                                                $unreadCount = Auth::user()->notifikasis()->where('dibaca', false)->count();
                                            @endphp
                                            @if($unreadCount > 0)
                                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full ml-2">{{ $unreadCount }}</span>
                                            @endif
                                        </a>
                                        <a href="{{ route('siswa.artikel.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-plus mr-2"></i>Tulis Artikel
                                        </a>
                                    @elseif(Auth::user()->isGuru())
                                        <a href="{{ route('guru.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                        <a href="{{ route('guru.artikels') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-newspaper mr-2"></i>Kelola Artikel
                                        </a>
                                    @else
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                        <a href="{{ route('admin.artikels') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-newspaper mr-2"></i>Kelola Artikel
                                        </a>
                                        <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-users mr-2"></i>Kelola User
                                        </a>
                                        <a href="{{ route('admin.kategori') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-folder mr-2"></i>Kelola Kategori
                                        </a>
                                    @endif
                                    <div class="border-t border-gray-100"></div>
                                    <form action="{{ route('logout') }}" method="POST" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center mb-2">
                    <img src="{{ asset('storage/posts/baknus.png') }}" alt="Baknus Logo" class="h-8 w-8 mr-2 rounded">
                    <h3 class="text-lg font-semibold">
                        Mading Digital Baknus 666
                    </h3>
                </div>
                <p class="text-gray-300 mb-4">Terdepan dalam teknologi</p>
                <div class="flex justify-center space-x-4 mb-4">
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
                <p class="text-gray-400 text-sm">
                    © 2025 Baknus666
                </p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('scripts')
</body>
</html>