<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Data Kelas
        </h2>
    </x-slot>

    <x-card>

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold">Daftar Kelas</h3>
                <p class="text-sm text-gray-500">
                    Kelola kelas dan level pembelajaran.
                </p>
            </div>
            <x-primary-button onclick="window.location='{{ route('admin.classes.create') }}'">
                Tambah Kelas
            </x-primary-button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-100 rounded-lg overflow-hidden">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">Nama Kelas</th>
                        <th class="px-4 py-3 text-left font-medium">Level</th>
                        <th class="px-4 py-3 text-left font-medium">Guru</th>
                        <th class="px-4 py-3 text-left font-medium">Keterangan</th>
                        <th class="px-4 py-3 text-right font-medium">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($classes as $class)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">
                                {{ $class->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $class->level_label ?? '-'}}
                            </td>

                            <td class="px-4 py-3">
                                {{ $class->teacher->user->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $class->schedule_note ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.classes.edit', $class) }}"
                                    class="text-sm text-indigo-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-sm text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data kelas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </x-card>
</x-app-layout>