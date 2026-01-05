<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Edit Orang Tua / Wali
        </h2>
    </x-slot>

    <x-card>
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Form Edit Orang Tua</h3>
            <p class="text-sm text-gray-500">
                Data akun login dan profil orang tua.
            </p>
        </div>

        <form method="POST" action="{{ route('parents.update', $parent) }}">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <x-input-label value="Nama Orang Tua" />
                    <x-text-input name="name" class="mt-1 block w-full" value="{{ old('name', $parent->name) }}"
                        required />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label value="No. HP (WhatsApp)" />
                    <x-text-input name="phone" class="mt-1 block w-full"
                        value="{{ old('phone', $parent->user->phone) }}" required />
                    <x-input-error :messages="$errors->get('phone')" />
                </div>

                <div>
                    <x-input-label value="Email (Opsional)" />
                    <x-text-input type="email" name="email" class="mt-1 block w-full"
                        value="{{ old('email', $parent->email) }}" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="flex justify-end items-center mt-8">
                    <div class="flex gap-3">
                        <a href="{{ route('parents.show', $parent) }}" class="text-sm text-gray-600 hover:underline">
                            Batal
                        </a>
                        <x-primary-button>Simpan Perubahan</x-primary-button>
                    </div>
                </div>
        </form>
        <div class="mt-10 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">
                Kelola Relasi Student
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{
            search: '',
            selected: @json($parent->students->pluck('id')),
        }">
                {{-- KOLOM KIRI : TAMBAH STUDENT --}}
                <div class="border rounded-lg p-4">
                    <h4 class="font-semibold mb-3">
                        Tambahkan Student
                    </h4>

                    {{-- SEARCH --}}
                    <input type="text" x-model="search" placeholder="Cari student..."
                        class="block w-full border-gray-300 rounded-md mb-2" />

                    {{-- DROPDOWN --}}
                    <div class="border rounded-md max-h-48 overflow-y-auto">
                        @foreach ($availableStudents as $student)
                            <div x-show="
                                '{{ strtolower($student->fullname) }}'
                                    .includes(search.toLowerCase())
                                && !selected.includes({{ $student->id }})
                            " class="px-3 py-2 hover:bg-gray-100 cursor-pointer"
                                @click="selected.push({{ $student->id }})">
                                {{ $student->fullname }}
                            </div>
                        @endforeach
                    </div>

                    {{-- STAGING LIST --}}
                    <div class="mt-4">
                        <h5 class="text-sm font-semibold mb-2">
                            Student Terpilih (Belum Disimpan)
                        </h5>

                        <template x-if="selected.length === 0">
                            <p class="text-sm text-gray-500">
                                Belum ada student dipilih.
                            </p>
                        </template>

                        <ul class="space-y-2">
                            @foreach ($availableStudents->merge($parent->students) as $student)
                                <li x-show="selected.includes({{ $student->id }})"
                                    class="flex justify-between items-center border p-2 rounded">
                                    <span class="text-sm">
                                        {{ $student->fullname }}
                                    </span>

                                    <button type="button" class="text-red-600 text-xs"
                                        @click="selected = selected.filter(id => id !== {{ $student->id }})">
                                        Hapus
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- HIDDEN INPUT --}}
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="student_ids[]" :value="id">
                    </template>
                </div>

                {{-- KOLOM KANAN : STUDENT TERHUBUNG --}}
                <div class="border rounded-lg p-4">
                    <h4 class="font-semibold mb-3">
                        Student Terhubung Saat Ini
                    </h4>

                    @if ($parent->students->isEmpty())
                        <p class="text-sm text-gray-500">
                            Belum ada student yang terhubung.
                        </p>
                    @else
                        <ul class="space-y-2">
                            @foreach ($parent->students as $student)
                                <li class="flex justify-between items-center border p-2 rounded">
                                    <span class="text-sm">
                                        {{ $student->fullname }}
                                    </span>

                                    <a href="{{ route('students.edit', $student) }}"
                                        class="text-xs text-blue-600 hover:underline">
                                        Edit
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>


    </x-card>
</x-app-layout>