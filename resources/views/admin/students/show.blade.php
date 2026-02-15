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
                                    <dd>
                                        {{ \Carbon\Carbon::parse($student->birthdate)
                        ->locale('id')
                        ->translatedFormat('d F Y') }}
                                    </dd>
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
                    <dd>{{ $student->parent?->name ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="text-gray-500">Kelas</dt>
                    <dd>{{ $student->class?->name ?? '-' }}</dd>
                </div>

            </dl>
        </div>
        tab
        {{-- Akun Login --}}
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-2">Akun Login</h3>

            @forelse ($loginAccounts as $account)
                <p>
                    {{ $account['label'] }} :
                    {{ $account['phone'] }}
                    ({{ $account['name'] }})
                </p>
            @empty
                <p class="text-gray-500">Belum memiliki akun login</p>
            @endforelse
        </div>

        {{-- Riwayat Progres Belajar --}}
        <div>
            @if ($student->class == null)
                <h3 class="font-semibold text-lg mb-3">Siswa belum terdaftar di Kelas </h3>
            @else
                <h3 class="font-semibold text-lg mb-3">Riwayat Progres Belajar Kelas {{ $student->class->name }} </h3>
            @endif
            @if ($meetings->isEmpty())
                <p class="text-gray-500 text-sm">
                    Belum ada progres pembelajaran
                </p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-3 py-2 text-left">Tanggal</th>
                                <th class="px-3 py-2 text-left">Materi</th>
                                <th class="px-3 py-2 text-left">Guru</th>
                                <th class="px-3 py-2 text-left">Pemahaman Pertemuan Terakhir</th>
                                <th class="px-3 py-2 text-left">Catatan Progres</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $meeting)
                                            <tr class="border-b align-top">
                                                <td class="px-3 py-2 whitespace-nowrap">
                                                    {{ $meeting->meeting_date->locale('id')
                                ->translatedFormat('d F Y') }}
                                                </td>

                                                <td class="px-3 py-2">
                                                    {{ $meeting->material ?? '-' }}
                                                </td>

                                                <td class="px-3 py-2 whitespace-nowrap">
                                                    {{ $meeting->teacher->user->name ?? '-' }}
                                                </td>

                                                <td class="px-3 py-2 whitespace-nowrap">
                                                    @php
                                                        $value = $meeting->pivot->progress_value;
                                                        $badgeClass = match (true) {
                                                            $value === null => 'bg-gray-100 text-gray-700',
                                                            $value === 0 => 'bg-red-100 text-red-700',
                                                            $value < 60 => 'bg-yellow-100 text-yellow-700',
                                                            $value < 80 => 'bg-blue-100 text-blue-700',
                                                            default => 'bg-green-100 text-green-700',
                                                        };

                                                        $label = $meeting->pivot->progress_label;
                                                    @endphp

                                                    <span class="inline-block px-2 py-1 rounded text-xs {{ $badgeClass }}">
                                                        {{ $label }}{{ $value !== null ? " ({$value}%)" : '' }}
                                                    </span>
                                                </td>


                                                <td class="px-3 py-2">
                                                    {{ $meeting->pivot->progress_note ?? '-' }}
                                                </td>
                                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $meetings->links() }}
                    </div>

                </div>
            @endif
        </div>
    </x-card>
</x-app-layout>