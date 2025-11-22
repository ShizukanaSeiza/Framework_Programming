<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Kontent : Title -->
        <title>LP3I - Kampus Vokasi Terbaik</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="ng-white text-gray-800">

         <!-- NAVBAR -->
          <header class="w-full py-4 bg-white shadow-sm fixed top-0 left-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
                <!--Kontent Logo  -->
               <h1 class="text-2xl font-bold text-blue-600">LP3I</h1>
               <!-- Kontent : Navbar -->
               <nav class="hidden md:flex gap-8 text-gray-700 font-medium">
                <a href="#beranda" class="hover:text-blue-600">Beranda</a>
                <a href="#program" class="hover:text-blue-600">Program</a>
                <a href="#tentang" class="hover:text-blue-600">Tentang</a>
                <a href="#kontak" class="hover:text-blue-600">Kontak</a>
               </nav>

               <div class="flex gap-3">
                @if (Route::has('login'))
                    <nav class="flex items-centerr justify-end gap-4">
                        @auth
                            <a 
                                href="{{ url('/dashboard') }}"
                                class="px-4 py-2 text-blue-600 text-white rounded-lg font-medium
                                hover:bg-blue-700">Dashboard
                            </a>
                        @else 
                            <a 
                                href="{{ url('/login') }}"
                                class="px-4 py-2 text-blue-600 font-semibold"
                                >Login
                            </a>
                            
                            @if (Route::has('register'))
                                <a 
                                    href="{{ url('/register') }}"
                                    class="px-4 py-2 text-blue-600 text-white rounded-lg font-medium
                                    hover:bg-blue-700">Register
                            </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
           </div>
        </header>

          <!-- HERO SECTION -->
           <section id="beranda" class="pt-32 pb-20 bg-gray-50">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 px-4 items-center">

            <!-- Text Content -->
             <div>
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 mb-6">
                    Kampus Vokasi Terbaik<br />Untuk Masa Depan Karier Anda
                </h2>
                <p class="text-lg text-gray-600 mb-8">
                    LP3I hadir dengan fokus pendidikan vokasi yang releven dengan dunia kerja.
                    Raih keterampilan praktis dan peluang karier lebih cepat bersama kami.
                </p>
                <div class="flex gap-4">
                    @if (Route::has('register'))
                    <a href="#daftar" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold text-lg
                    hover:bg-blue-700">Daftar Sekarang</a>
                    @endif
                    <a href="#program" class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg font-semibold text-lg
                    hover:bg-blue-50">Lihat Program</a>
                </div>
             </div>

             <!-- Image -->
              <div class="flex justify-center">
                <!-- Kontent : Banner Image -->
                <img src="https://www.lp3i.ac.id/wp-content/uploads/2022/06/institusi-1.png" alt="Mahasiswa LP3I" class="w-full
                max-w-md object-cover drop-shadow-xl" />
              </div>
            </div>
           </section>