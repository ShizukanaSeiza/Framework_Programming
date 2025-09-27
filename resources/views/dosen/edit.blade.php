<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Dosen
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- ✅ Lebar sedang, tidak terlalu lebar --}}
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('dosen.update', $dosen->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">NID</label>
                        <input type="text" name="nid" value="{{ old('nid', $dosen->nid) }}"
                               class="border rounded w-full px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}"
                               class="border rounded w-full px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Alamat</label>
                        <textarea name="alamat" rows="3"
                                  class="border rounded w-full px-3 py-2">{{ old('alamat', $dosen->alamat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Mata Kuliah</label>
                        <input type="text" name="mataKuliah" value="{{ old('mataKuliah', $dosen->mataKuliah) }}"
                               class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
