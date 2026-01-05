<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Detail Orang Tua
        </h2>
    </x-slot>

    <x-card>
        {{-- Info Parent --}}
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-1">
                {{ $parent->name }}
            </h3>

            <div class="text-sm text-gray-600 grid grid-cols-[auto_1fr] gap-x-2 gap-y-1">
                <span class="font-semibold">No. HP</span>
                <span>: {{ $parent->user->phone }}</span>

                <span class="font-semibold">Email</span>
                <span>: {{ $parent->email ?? '-' }}</span>
            </div>

        </div>

        <hr class="my-6">

        {{-- Daftar Siswa --}}
        <div>
            <h4 class="text-lg font-semibold mb-4">
                Daftar Siswa
                <span class="text-sm text-gray-500">
                    ({{ $parent->students->count() }} siswa)
                </span>
            </h4>

            @if ($parent->students->isEmpty())
                <p class="text-sm text-gray-500">
                    Belum ada siswa yang terhubung dengan orang tua ini.
                </p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">Nama Siswa</th>
                                <th class="px-4 py-3 text-left">Kelas</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach ($parent->students as $student)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    {{ $student->fullname }}
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{ $student->class?->name ?? '-' }}
                                                </td>

                                                <td class="px-4 py-3 text-center">
                                                    <span class="px-2 py-1 text-xs rounded
                                                                                                                                                                                                                                {{ $student->status_siswa === 'active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-100 text-gray-600' }}">
                                                        {{ ucfirst($student->status_siswa) }}
                                                    </span>
                                                </td>
                                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('parents.index') }}" class="text-sm text-gray-600 hover:underline">
                Kembali
            </a>

            <a href="{{ route('parents.edit', $parent) }}">
                <x-primary-button>Edit</x-primary-button>
            </a>
        </div>
    </x-card>
</x-app-layout>