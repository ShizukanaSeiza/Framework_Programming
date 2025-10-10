<x-guest-layout>
    <div clas="max-w-md mx-auto mt-12 bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-center mb-6">Registrasi Calon Mahasiswa</h2>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="text-sm list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.mahasiswa') }}">
            @csrf
            
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded-mmd p-2 focus:ring focus:ring-blue-200" required>
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 rounded-md hover:bg-blue-700 transition">
                Daftar Sekarang
            </button>

            <p class="text-center text-sm mt-4">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
            </p>
        </form>
    </div>
</x-guest-layout>          