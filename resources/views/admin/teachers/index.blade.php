<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Data Guru
        </h2>
    </x-slot>

    <x-card>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold">Daftar Guru</h3>
                <p class="text-sm text-gray-500">
                    Kelola data guru dan akun login.
                </p>
            </div>

            <a href="{{ route('teachers.create') }}">
                <x-primary-button>
                    Tambah Guru
                </x-primary-button>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                            Nama
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                            No. HP
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                            Email
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                            Bio
                        </th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td class="px-4 py-3 font-medium">
                                <a href="{{ route('teachers.show', $teacher) }}" class="text-blue-600 hover:underline">
                                    {{ $teacher->user->name }}
                                </a>

                            </td>

                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ $teacher->user->phone }}
                            </td>

                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ $teacher->user->email ?? '-' }}
                            </td>

                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ $teacher->bio ?? '-' }}
                            </td>

                            <td class="px-4 py-2 text-sm text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('teachers.edit', $teacher) }}" class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('teachers.destroy', $teacher) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                                Belum ada data guru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>