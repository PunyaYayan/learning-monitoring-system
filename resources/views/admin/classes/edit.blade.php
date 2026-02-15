<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Edit Kelas
        </h2>
    </x-slot>

    <x-card>

        {{-- Header --}}
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Form Edit Kelas</h3>
            <p class="text-sm text-gray-500">
                Perbarui data kelas yang dipilih.
            </p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.classes.update', $class) }}">
            @csrf
            @method('PUT')

            <div class="space-y-5">

                {{-- Nama Kelas --}}
                <div>
                    <x-input-label for="name" value="Nama Kelas" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        value="{{ old('name', $class->name) }}" required autofocus />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                {{-- Level --}}
                <!-- <div>
                    <x-input-label for="level" value="Level (Opsional)" />
                    <x-text-input id="level" name="level" type="text" class="mt-1 block w-full"
                        value="{{ old('level', $class->level) }}" />
                    <x-input-error :messages="$errors->get('level')" />
                </div> -->
                <select name="level" id="level" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                    <option value="" disabled selected>— Pilih Level —</option>

                    @foreach (\App\Models\ClassModel::LEVELS as $value => $label)
                        <option value="{{ $value }}" @selected(old('level') == $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                {{-- Keterangan --}}
                <div>
                    <x-input-label for="schedule_note" value="Keterangan / Jadwal (Opsional)" />
                    <x-text-input id="schedule_note" name="schedule_note" type="text" class="mt-1 block w-full"
                        value="{{ old('schedule_note', $class->schedule_note) }}" />
                    <x-input-error :messages="$errors->get('schedule_note')" />
                </div>
                <div>
                    <x-input-label for="teacher_id" value="Guru Pengampu (Opsional)" />

                    <select name="teacher_id" id="teacher_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">— Belum Ditentukan —</option>

                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" @selected(old('teacher_id', $class->teacher_id ?? null) == $teacher->id)>
                                {{ $teacher->user->name }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('teacher_id')" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 mt-8">
                <a href="{{ route('admin.classes.index') }}" class="text-sm text-gray-600 hover:underline">
                    Batal
                </a>

                <x-primary-button>
                    Simpan Perubahan
                </x-primary-button>
            </div>

        </form>

    </x-card>
</x-app-layout>