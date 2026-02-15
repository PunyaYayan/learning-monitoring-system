<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Detail PPDB — {{ $ppdb->fullname }}
        </h2>
    </x-slot>

    <x-card>

        {{-- DATA SISWA --}}
        <div class="mb-6">

            <h3 class="font-semibold text-lg mb-3">Data Siswa</h3>

            <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-gray-500">Nama</p>
                    <p>{{ $ppdb->fullname }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Email Siswa</p>
                    <p>{{ $ppdb->student_email ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">HP</p>
                    <p>{{ $ppdb->phone }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Gender</p>
                    <p class="capitalize">{{ $ppdb->gender ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal Lahir</p>
                    <p>{{ $ppdb->birthdate ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Sekolah</p>
                    <p>{{ $ppdb->school ?? '-' }}</p>
                </div>

                <div class="col-span-2">
                    <p class="text-gray-500">Alamat</p>
                    <p>{{ $ppdb->address ?? '-' }}</p>
                </div>

            </div>

        </div>


        {{-- DATA ORTU --}}
        <div class="mb-6">

            <h3 class="font-semibold text-lg mb-3">Data Wali / Orang Tua</h3>

            <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-gray-500">Nama</p>
                    <p>{{ $ppdb->parent_name ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">HP</p>
                    <p>{{ $ppdb->parent_phone ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Email</p>
                    <p>{{ $ppdb->parent_email ?? '-' }}</p>
                </div>

            </div>

        </div>


        {{-- STATUS --}}
        <div class="mb-6">

            <h3 class="font-semibold text-lg mb-3">Status</h3>

            <p>Status:
                <strong>{{ ucfirst($ppdb->status) }}</strong>
            </p>

            <p>
                Divalidasi:
                {{ $ppdb->validated_at
    ? $ppdb->validated_at->format('d-m-Y H:i')
    : '-' }}
            </p>

            <p>
                Oleh:
                {{ $ppdb->validator?->name ?? '-' }}
            </p>

            <p>
                Catatan:
                {{ $ppdb->admin_note ?? '-' }}
            </p>

        </div>


        {{-- AKSI --}}
        @if($ppdb->status === 'submitted')

            <div class="border-t pt-6">

                <h3 class="font-semibold text-lg mb-3">Tindakan Admin</h3>

                <form method="POST" id="ppdb-form">
                    @csrf

                    <textarea name="note" class="w-full border rounded p-2 mb-4 text-sm" rows="3"
                        placeholder="Catatan admin"></textarea>

                    <div class="flex gap-3">

                        <button type="button" onclick="submitForm('approve')"
                            class="bg-green-600 text-white px-4 py-2 rounded">
                            Setujui
                        </button>

                        <button type="button" onclick="submitForm('reject')"
                            class="bg-red-600 text-white px-4 py-2 rounded">
                            Tolak
                        </button>

                    </div>

                </form>

            </div>

            <script>
                function submitForm(type) {

                    const form = document.getElementById('ppdb-form');

                    if (type === 'approve') {
                        form.action = "{{ route('admin.ppdb.approve', $ppdb->id) }}";
                    }

                    if (type === 'reject') {
                        form.action = "{{ route('admin.ppdb.reject', $ppdb->id) }}";
                    }

                    form.submit();
                }
            </script>

        @endif

    </x-card>
</x-app-layout>