<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Tambah Kelas
        </h2>
    </x-slot>

    <x-card>

        {{-- Header --}}
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Form Tambah Kelas</h3>
            <p class="text-sm text-gray-500">
                Isi data kelas dengan benar.
            </p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('classes.store') }}">
            @csrf

            <div class="space-y-5">

                {{-- Nama Kelas --}}
                <div>
                    <x-input-label for="name" value="Nama Kelas" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}"
                        required autofocus />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                {{-- Level --}}

                <div>
                    <x-input-label for="level" value="Level Kelas" />

                    <select name="level" id="level" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="" disabled selected>— Pilih Level —</option>

                        @foreach (\App\Models\ClassModel::LEVELS as $value => $label)
                            <option value="{{ $value }}" @selected(old('level') == $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('level')" />
                </div>


                {{-- Keterangan --}}
                <div>
                    <x-input-label for="schedule_note" value="Keterangan / Jadwal (Opsional)" />
                    <x-text-input id="schedule_note" name="schedule_note" type="text" class="mt-1 block w-full"
                        value="{{ old('schedule_note') }}" />
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
                <a href="{{ route('classes.index') }}" class="text-sm text-gray-600 hover:underline">
                    Batal
                </a>

                <x-primary-button>
                    Simpan
                </x-primary-button>
            </div>

        </form>

    </x-card>
</x-app-layout>