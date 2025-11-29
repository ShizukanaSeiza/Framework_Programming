<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">

        {{-- ====== HEADER / NAVBAR ATAS ====== --}}
        @include('layouts.navigation') 
        {{-- navigation.blade.php bawaan Breeze/Jetstream --}}

        {{-- ====== BODY: Sidebar + Konten ====== --}}
        <div class="flex">
            {{-- SIDEBAR di kiri, tepat di bawah header --}}
            <aside class="w-64 bg-white border-r shadow-sm min-h-screen">
                <nav class="p-4 space-y-1">
                    @if (Auth::user() && Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('mahasiswa.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('mahasiswa.*') ? 'bg-gray-200 font-semibold' : '' }}">
                            Mahasiswa
                        </a>
                        <a href="{{ route('ruangan.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('ruangan.*') ? 'bg-gray-200 font-semibold' : '' }}">
                            Ruangan
                        </a>
                        <a href="{{ route('matkul.index') }}"
                            class="block px-4 py-2 hover:bg-gray-200 {{ request()->routeIs('matkul.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        Mata Kuliah
                        </a>
                        <a href="{{ route('dosen.index') }}"
                            class="block px-4 py-2 hover:bg-gray-200 {{ request()->routeIs('dosen.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        Dosen
                        </a>
                        <a href="{{ route('admin.ekyc.index') }}"
                            class="block px-4 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.*') ? 'bg-gray-200 font-semibold' : '' }}">
                        eKYC Registration
                        </a>
                        
                        {{-- Landing Page Group --}}
                        <div x-data="{ open: {{ request()->is('admin/landing*') ? 'true' : 'false' }} }" class="mt-2">

                            <!-- Parent Item -->
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-200 
                                {{ request()->is('admin/landing*') ? 'bg-gray-200 font-semibold' : '' }}">
                                <span>📰 Landing Page</span>
                                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>

                                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 15l7-7 7 7" />
                                </svg>
                            </button>

                            <!-- Collapsible Menu -->
                            <div x-show="open" x-transition class="pl-6 space-y-1">
                                
                                <a href="{{ route('admin.landing.settings.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-200 
                                    {{ request()->routeIs('admin.landing.settings.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                    🛠 Settings
                                </a>

                                <a href="{{ route('admin.landing.navigation.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-200 
                                    {{ request()->routeIs('admin.landing.navigation.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                    📌 Menu Navigasi
                                </a>

                                <a href="{{ route('admin.landing.programs.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-200 
                                    {{ request()->routeIs('admin.landing.programs.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                    🎓 Program Studi
                                </a>

                                <a href="{{ route('admin.landing.footer.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-200 
                                    {{ request()->routeIs('admin.landing.footer.*') ? 'bg-gray-200 font-semibold' : '' }}">
                                    📄 Footer
                                </a>

                            </div>
                        </div>


                    @endif
                </nav>
            </aside>

            {{-- KONTEN UTAMA di kanan --}}
            <main class="flex-1 p-6">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>

    </div>
</body>
</html>
