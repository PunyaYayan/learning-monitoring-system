<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Data Siswa
        </h2>
    </x-slot>

    <x-card>

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold">Daftar Siswa</h3>
                <p class="text-sm text-gray-500">
                    Kelola data siswa, kelas, dan wali (opsional).
                </p>
            </div>

            <x-primary-button onclick="window.location='{{ route('admin.students.create') }}'">
                Tambah Siswa
            </x-primary-button>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-100 rounded-lg overflow-hidden">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">Nama</th>
                        <th class="px-4 py-3 text-left font-medium">Asal Sekolah</th>
                        <th class="px-4 py-3 text-left font-medium">Kelas</th>
                        <th class="px-4 py-3 text-left font-medium">Wali</th>
                        <th class="px-4 py-3 text-right font-medium">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">
                                <a href="{{ route('admin.students.show', $student) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $student->fullname }}
                                </a>

                            </td>

                            <td class="px-4 py-3">
                                {{ $student->school ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $student->class?->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $student->parent?->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.students.edit', $student) }}"
                                    class="text-sm text-indigo-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
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
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="mt-6">
                {{ $students->links() }}
            </div>

        </div>

    </x-card>
</x-app-layout>