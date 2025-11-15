<x-app-layout>
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow mt-8">
        <h2 class="text-2xl font-semibold mb-6 border-b pb-3">
            Detail eKYC - {{ $data->user->name ?? '-' }}
        </h2>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- ==================== Data Pribadi ==================== --}}
        <section>
            <h3 class="text-lg font-semibold mb-4">🧍‍♂️ Data Pribadi</h3>

            <div class="space-y-3">
                @foreach ([
                    'Nama Lengkap' => $data->nama,
                    'NIK' => $data->nik,
                    'Tanggal Lahir' => $data->tanggal_lahir,
                    'Alamat' => $data->alamat,
                ] as $label => $value)
                    <div class="flex items-start">
                        <label class="w-48 text-sm font-medium text-gray-700 mt-1">{{ $label }}</label>
                        @if(Str::contains(strtolower($label), 'alamat'))
                            <textarea rows="2" readonly class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">{{ $value }}</textarea>
                        @else
                            <input type="text" readonly value="{{ $value }}" class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== Data Pendidikan ==================== --}}
        <section class="mt-8 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">🎓 Data Pendidikan</h3>

            <div class="space-y-3">
                @foreach ([
                    'Asal SD' => $data->asal_sd,
                    'Asal SMP' => $data->asal_smp,
                    'Asal SMA' => $data->asal_sma,
                ] as $label => $value)
                    <div class="flex items-start">
                        <label class="w-48 text-sm font-medium text-gray-700 mt-1">{{ $label }}</label>
                        <input type="text" readonly value="{{ $value }}" class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== Dokumen eKYC ==================== --}}
        <section class="mt-8 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">📎 Dokumen eKYC</h3>

            <div class="flex flex-wrap gap-6">
                @foreach ([
                    'file_ktp' => 'KTP',
                    'file_selfie' => 'Selfie',
                    'file_kk' => 'Kartu Keluarga',
                    'file_ijazah' => 'Ijazah'
                ] as $field => $label)
                    @if ($data->$field)
                        <div class="flex flex-col items-center w-[110px]">
                            <p class="text-xs font-medium mb-1">{{ $label }}</p>
                            <a href="{{ asset('storage/'.$data->$field) }}" target="_blank">
                                <img src="{{ asset('storage/'.$data->$field) }}"
                                     class="w-[90px] h-[70px] object-cover border rounded-md shadow-sm hover:shadow-lg transition">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>

        {{-- ==================== Alamat Domisili ==================== --}}
        <section class="mt-8 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">🏠 Alamat Domisili</h3>

            <div class="space-y-3">
                @foreach ([
                    'Alamat Domisili' => $data->alamatDomisili,
                    'Provinsi' => $data->provinsi,
                    'Kota' => $data->kota,
                    'Kecamatan' => $data->kecamatan,
                    'Kode Pos' => $data->kode_pos,
                    'Nama Ibu Kandung' => $data->nama_ibu_kandung,
                    'Referensi Sumber' => $data->referensi_sumber,
                ] as $label => $value)
                    <div class="flex items-start">
                        <label class="w-48 text-sm font-medium text-gray-700 mt-1">{{ $label }}</label>
                        @if(Str::contains(strtolower($label), 'alamat'))
                            <textarea rows="2" readonly class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">{{ $value }}</textarea>
                        @else
                            <input type="text" readonly value="{{ $value }}" class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ==================== Status Verifikasi ==================== --}}
        <section class="mt-10 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">⚙️ Status Verifikasi</h3>

            <form action="{{ route('admin.ekyc.verify', $data->id) }}" method="POST" class="flex items-center gap-4">
                @csrf
                <label class="w-48 text-sm font-medium text-gray-700">Ubah Status</label>
                <select name="status" class="flex-1 border border-gray-300 rounded-md p-2 text-sm">
                    <option value="accepted" {{ $data->status == 'accepted' ? 'selected' : '' }}>✔ Diterima</option>
                    <option value="submitted" {{ $data->status == 'submitted' ? 'selected' : '' }}>⏳ Menunggu Verifikasi</option>
                    <option value="draft" {{ $data->status == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                    <option value="rejected" {{ $data->status == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
                </select>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                    Simpan
                </button>

                <a href="{{ route('admin.ekyc.index') }}" class="text-sm text-gray-600 hover:underline ml-auto">
                    ← Kembali
                </a>
            </form>
        </section>
    </div>
</x-app-layout>
