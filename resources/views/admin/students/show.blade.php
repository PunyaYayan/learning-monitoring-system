<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Detail Siswa
        </h2>
    </x-slot>

    <x-card>

        {{-- Data Siswa --}}
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-2">Data Siswa</h3>

            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-gray-500">Nama</dt>
                    <dd>{{ $student->fullname }}</dd>
                </div>

                <div>
                    <dt class="text-gray-500">Tanggal Lahir</dt>
                    @if ($student->birthdate === null)
                        <dd>-</dd>
                    @else
                        <dd>{{ $student->birthdate }}</dd>
                    @endif
                </div>

                <div>
                    <dt class="text-gray-500">Jenis Kelamin</dt>
                    <!-- <dd>{{ $student->gender }}</dd> -->
                    @if ($student->gender === 'male')
                        <dd>Laki-laki</dd>
                    @else
                        <dd>Perempuan</dd>
                    @endif
                </div>

                <div>
                    <dt class="text-gray-500">Sekolah/Institusi</dt>
                    @if ($student->school === null)
                        <dd>-</dd>
                    @else
                        <dd>{{ $student->school }}</dd>
                    @endif
                </div>

                <div>
                    <dt class="text-gray-500">Alamat</dt>
                    <dd>{{ $student->address }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Wali</dt>

                    @if (!$student->parent?->name === null)
                        <dd>{{ $student->parent?->name }}</dd>
                    @else
                        <dd>-</dd>
                    @endif
                </div>
            </dl>
        </div>

        {{-- Akun Login --}}
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-2">Akun Login</h3>
            @if ($student->user && $student->parent && $student->parent->user)
                <p>
                    Student: {{ $student->user->phone }} ({{ $student->user->role }})<br>
                    Parent: {{ $student->parent->user->phone }} ({{ $student->parent->user->role }})
                </p>
            @elseif ($student->user)
                <p>
                    Student: {{ $student->user->phone }} ({{ $student->user->role }})
                </p>
            @elseif ($student->parent && $student->parent->user)
                <p>
                    Parent: {{ $student->parent->user->phone }} ({{ $student->parent->user->role }})
                </p>
            @else
                <p class="text-gray-500">Belum memiliki akun login</p>
            @endif
        </div>


        {{-- Riwayat Pertemuan --}}
        <div>
            <h3 class="font-semibold text-lg mb-2">Riwayat Pertemuan</h3>

            @forelse ($student->meetings as $meeting)
                <div class="border-b py-2">
                    <div class="text-sm">{{ $meeting->meeting_date }}</div>
                    <div class="text-gray-600">{{ $meeting->progress_note }}</div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Belum ada pertemuan</p>
            @endforelse
        </div>

    </x-card>
</x-app-layout>