<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark-text-gray-200 leading-tight">
            {{ __('Programs') }}
        </h2>
    </x-slot>

    <div x-data="programPage()" class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Add --}}
            <div class="mb-6">
                <button @click="openCreateModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Program
                </button>
            </div>

            {{-- Tabel --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="font-semibold text-lg mb-4 text-gray-800 dark:text-gray-100">
                        Daftar Programs
                    </h3>

                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-center w-16">Gambar</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Icon</th>
                                <th class="px-4 py-2 text-center w-24">Pos</th>
                                <th class="px-4 py-2 text-center w-24">Status</th>
                                <th class="px-4 py-2 text-center w-40">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($programs as $item)
                                <tr>
                                    <td class="border px-4 py-2 text-center">
                                        @if(program->image)
                                            <img src="{{ asset('storage/'.$program->image) }}" class="h-12 mx-auto rounded">
                                        else
                                            -
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">{{ $program->title }}</td>
                                    <td class="border px-4 py-2">{{ $program->icon }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $program->position }}</td>

                                    <td class="border px-4 py-2 text-center">
                                        <span class="px-2 py-1 rounded text-white {{ $item->status ? 'bg-green-600' :
                                        'bg-red-600' }}">
                                            {{ $program->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    
                                    <td class="border px-4 -py-2 text-center">

                                        {{-- EDIT --}}
                                        <button 
                                            @click="openEditModal({{ $item }})"
                                            class="px-3 py-1 bg-yellow-500 text-white rounded">
                                            Edit    
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.landing.navigation.destroy', $item->id) }}"
                                              method="POST" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Hapus menu ini?')"
                                                class="px-3 py-1 bg-red-600 text-white rounded">
                                                Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>

        </div>

        {{-- --------------------------------------------------- --}}
        {{-- CREATE MODAL --}}
        {{-- --------------------------------------------------- --}}
        <div x-show="showCreate"
             class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
             x-transition>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">

                <h2 class="text-xl font-semibold mb-4">Tambah Program</h2>

                <form method="POST" action="{{ route('admin.landing.programs.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1">Title</label>
                        <input type="text" name="title" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    <div>
                        <label class="block mb-1">Description</label>
                        <input type="text" name="description" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    <div>
                        <label class="block mb-1">Icon</label>
                        <input type="text" name="icon" class="border-gray-300 rounded-md w-full">
                    </div>

                    <div>
                        <label class="block mb-1">Position</label>
                        <input type="number" name="position" value="0" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    <div>
                        <label class="block mb-1">Status</label>
                        <select name="status" class="border-gray-300 rounded-md w-full">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button"
                                @click="showCreate=false"
                                class="px-4 py2 bg-gray-500 text-white rounded">
                            Batal
                        </button>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan    
                        </button>
                    </div>
                </form>

            </div>    
        </div>

        {{-- --------------------------------------------------- --}}
        {{-- EDIT MODAL --}}
        {{-- --------------------------------------------------- --}}
        <div x-show="showEdit"
             class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
             x-transition>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                
                <h2 class="text-xl font-semibold mb-4">Edit Program</h2>
                
                <form method="POST"
                      :action="">
                </form>

                <form method="POST"
                      :action="'/admin/landing/programs/' + editData.id"
                      class="space-y-4">
                    @csrf
                    @method('PUT')

                <div>
                    <label class="block mb-1">Label</label>
                    <input type="text"
                           name="label"
                           x-model="editData.label"
                           class="border-gray-300 rounded-md w-full" 
                           required>
                </div>

                <div>
                    <label class="block mb-1">URL</label>
                    <input type="status"
                            name="url"
                            x-model="editData.url"
                            class="border-gray-300 rounded-md w-full"
                            required>
                </div>

                <div>
                    <label class="block mb-1">Status</label>
                    <select name="status"
                            x-model="editData.status"
                            class="border-gray-300 rounded-md w-full">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                    <div class="flex justify-end gap-2">
                        <button type="button"
                                @click="showEdit=false"
                                class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </button>

                        <button type="submit"
                                class="px-4 py-2 bg-yellow-600 text-white rounded">
                            Update    
                        </button>
                    </div>

                </form>

            </div>    
        </div>

    </div>

    {{-- ALPINE.JS CONTROLLER --}}
    <script>
        function navPage() {
            return {
                showCreate: false,
                showEdit: false,

                editData: {},

                openCreateModal() {
                    this.showCreate = true;
                },

                openEditModal(item) {
                    this.editData = {
                        id: item.id,
                        label: item.label,
                        url: item.url,
                        position: item.position,
                        status: item.status,
                    };
                    this.showEdit = true;
                }
            }
        }
    </script>
    
</x-app-layout>