<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Data Orang Tua / Wali
        </h2>
    </x-slot>

    <x-card>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold">Daftar Orang Tua</h3>
                <p class="text-sm text-gray-500">
                    Data wali siswa yang terdaftar di sistem
                </p>
            </div>

            <a href="{{ route('parents.create') }}">
                <x-primary-button>
                    Tambah Orang Tua
                </x-primary-button>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">No. HP</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-center">Jumlah Anak</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($parents as $parent)
                        <tr>
                            <!-- <td class="px-4 py-3">
                                                            {{ $parent->name }}
                                                        </td> -->
                            <td class="px-4 py-3 font-medium">
                                <a href="{{ route('parents.show', $parent) }}" class="text-blue-600 hover:underline">
                                    {{ $parent->name }}
                                </a>

                            </td>

                            <td class="px-4 py-3">
                                {{ $parent->user?->phone ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $parent->user?->email ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $parent->students_count }}
                            </td>

                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('parents.edit', $parent) }}"
                                    class="text-sm text-indigo-600 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('parents.destroy', $parent) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus parent?')">
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
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Belum ada data orang tua
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>