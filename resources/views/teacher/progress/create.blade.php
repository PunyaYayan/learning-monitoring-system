<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Progress — {{ $meeting->class->name }}
        </h2>
    </x-slot>

    <x-card>

        <div class="mb-6">
            <h3 class="font-semibold text-lg">Pertemuan</h3>
            <p class="text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d M Y') }}
                — {{ $meeting->material }}
            </p>
        </div>

        <form method="POST" action="{{ route('teacher.meetings.progress.store', $meeting) }}">
            @csrf

            <div class="space-y-4">

                @foreach ($meeting->class->students as $student)
                    <div class="border rounded p-4">
                        <div class="font-medium mb-2">
                            {{ $student->fullname }}
                        </div>

                        <input type="hidden" name="progress[{{ $loop->index }}][student_id]" value="{{ $student->id }}">

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm text-gray-600">
                                    Progress (%)
                                </label>

                                <input type="number" name="progress[{{ $loop->index }}][progress_value]" min="0" max="100"
                                    step="5" required class="mt-1 block w-full border-gray-300 rounded"
                                    placeholder="0 = tidak hadir | ≥ 60 = hadir">
                            </div>

                            <div>
                                <label class="text-sm text-gray-600">
                                    Catatan
                                </label>

                                <input type="text" name="progress[{{ $loop->index }}][catatan]"
                                    class="mt-1 block w-full border-gray-300 rounded" placeholder="Opsional">
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('teacher.classes.show', $meeting->class_id) }}"
                    class="text-sm text-gray-600 hover:underline">
                    Batal
                </a>

                <x-primary-button>
                    Simpan Progress
                </x-primary-button>
            </div>

        </form>

    </x-card>
</x-app-layout>