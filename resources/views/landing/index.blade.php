@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 px-6 items-center">

        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                {{ $landing->headline ?? 'Selamat Datang di Website Kami' }}
            </h1>
            <p class="mt-4 text-gray-600 text-lg">
                {{ $landing->subheadline ?? 'Deskripsi singkat website Anda.' }}
            </p>

            <div class="mt-6 flex gap-3">
                @if($landing->primary_button_text && $landing->primary_button_link)
                <a href="{{ $landing->primary_button_link }}"
                   class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    {{ $landing->primary_button_text }}
                </a>
                @endif

                @if($landing->secondary_button_text && $landing->secondary_button_link)
                <a href="{{ $landing->secondary_button_link }}"
                   class="px-5 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                    {{ $landing->secondary_button_text }}
                </a>
                @endif
            </div>
        </div>

        <div>
            @if($landing->hero_image)
                <img src="{{ asset('storage/' . $landing->hero_image) }}" class="rounded-lg shadow-lg" alt="">
            @else
                <div class="w-full h-64 bg-gray-200 rounded-lg"></div>
            @endif
        </div>
    </div>
</section>


<!-- PROGRAM SECTION -->
<section class="py-20">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold">Program Pendidikan</h2>
    </div>

    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 px-6">
        @forelse($programs as $program)
        <div class="p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
            <h3 class="font-semibold text-lg">{{ $program->title }}</h3>
            <p class="text-sm text-gray-600 mt-2">{{ $program->description }}</p>
        </div>
        @empty
        <p class="text-center col-span-3 text-gray-500">Belum ada data program.</p>
        @endforelse
    </div>
</section>


<!-- ABOUT SECTION -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 px-6 items-center">

        <div>
            <h2 class="text-3xl font-bold mb-4">{{ $landing->about_title ?? 'Tentang Kami' }}</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $landing->about_description ?? 'Isi panjang tentang deskripsi lembaga Anda.' }}
            </p>
        </div>

        <div>
            @if($landing->about_image)
                <img src="{{ asset('storage/' . $landing->about_image) }}" class="rounded-lg shadow-lg" alt="">
            @else
                <div class="w-full h-64 bg-gray-200 rounded-lg"></div>
            @endif
        </div>
    </div>
</section>



<!-- FOOTER -->
<footer class="py-10 bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 px-6">

        <div>
            <h3 class="font-bold text-lg mb-3">{{ $footer->footer_title ?? 'Navigasi' }}</h3>
            <p class="text-sm text-gray-400">
                {{ $footer->footer_description ?? 'Deskripsi footer.' }}
            </p>
        </div>

        <div>
            <h3 class="font-bold text-lg mb-3">Menu</h3>
            <ul class="space-y-2 text-gray-400">
                <li><a href="#" class="hover:text-white">Beranda</a></li>
                <li><a href="#" class="hover:text-white">Program</a></li>
                <li><a href="#" class="hover:text-white">Tentang</a></li>
                <li><a href="#" class="hover:text-white">Kontak</a></li>
            </ul>
        </div>

        <div>
            <h3 class="font-bold text-lg mb-3">Hubungi Kami</h3>
            <ul class="text-gray-400 space-y-1">
                <li>Email: {{ $footer->contact_email ?? '-' }}</li>
                <li>Telp: {{ $footer->contact_phone ?? '-' }}</li>
            </ul>
        </div>

    </div>
</footer>

@endsection
