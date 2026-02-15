<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            {{ $class->name }}
        </h2>
    </x-slot>

    <x-card>

        <h3 class="font-semibold mb-4">Riwayat Pertemuan</h3>

        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Tanaggal</th>
                    <th class="px-4 py-2">Materi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meetings as $meeting)
                    <tr class="border-t cursor-pointer hover:bg-gray-50"
                        onclick="window.location='{{ route('parent.meetings.show', $meeting) }}'">
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $meeting->material }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $meetings->links() }}
        </div>

    </x-card>
</x-app-layout>