<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            PPDB — Verifikasi
        </h2>
    </x-slot>

    <x-card>

        <div class="overflow-x-auto">

            <table class="w-full border text-sm">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">No</th>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">HP</th>
                        <th class="border p-2">Tipe</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($ppdbs as $ppdb)

                        <tr>

                            <td class="border p-2 text-center">
                                {{ $loop->iteration + ($ppdbs->currentPage() - 1) * $ppdbs->perPage() }}
                            </td>

                            <td class="border p-2">
                                {{ $ppdb->fullname }}
                            </td>

                            <td class="border p-2">
                                {{ $ppdb->phone }}
                            </td>

                            <td class="border p-2 capitalize">
                                {{ $ppdb->applicant_type_label }}
                            </td>

                            <td class="border p-2">

                                @if($ppdb->status === 'submitted')
                                    <span class="text-yellow-600 font-semibold">Submitted</span>
                                @elseif($ppdb->status === 'approved')
                                    <span class="text-green-600 font-semibold">Approved</span>
                                @else
                                    <span class="text-red-600 font-semibold">Rejected</span>
                                @endif

                            </td>

                            <td class="border p-2 text-center">
                                {{ $ppdb->created_at->format('d-m-Y') }}
                            </td>

                            <td class="border p-2 text-center">

                                <a href="{{ route('admin.ppdb.show', $ppdb->id) }}" class="text-blue-600 hover:underline">
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-500">
                                Belum ada data
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">
            {{ $ppdbs->links() }}
        </div>

    </x-card>
</x-app-layout>