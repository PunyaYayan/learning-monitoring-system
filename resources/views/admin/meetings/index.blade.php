<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold">Data Meeting</h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        {{-- Filter --}}
        <form method="GET" class="flex gap-4">
            <select name="class_id" class="border rounded px-3 py-2 text-sm">
                <option value="">Semua Kelas</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" @selected(request('class_id') == $class->id)>
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}" class="border rounded px-3 py-2 text-sm">

            <button class="text-sm px-4 py-2 bg-gray-800 text-white rounded">
                Filter
            </button>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b text-left text-gray-600">
                    <tr>
                        <th class="py-2">Tanggal</th>
                        <th>Kelas</th>
                        <th>Guru</th>
                        <th>Materi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meetings as $meeting)
                        <tr class="border-b hover:bg-gray-50 cursor-pointer"
                            onclick="window.location='{{ route('admin.meetings.show', $meeting) }}'">
                            <td class="py-2">
                                {{  $meeting->meeting_date->locale('id')->translatedFormat('d F Y')}}
                            </td>
                            <td>{{ $meeting->class->name }}</td>
                            <td>{{ $meeting->teacher->user->name }}</td>
                            <td class="truncate max-w-xs">
                                {{ $meeting->material }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                Tidak ada data meeting
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $meetings->links() }}
    </div>
</x-app-layout>