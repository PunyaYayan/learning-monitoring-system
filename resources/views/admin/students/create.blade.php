<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">Tambah Siswa</h2>
    </x-slot>

    <x-card>
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Form Tambah Siswa</h3>
            <p class="text-sm text-gray-500">Isi data siswa. Data wali bersifat opsional.</p>
        </div>

        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <div class="space-y-5">
                {{-- Nama --}}
                <div>
                    <x-input-label value="Nama Siswa" />
                    <x-text-input name="fullname" class="mt-1 block w-full" value="{{ old('fullname') }}" required />
                    <x-input-error :messages="$errors->get('fullname')" />
                </div>
                <div>
                    <x-input-label value="Tanggal Lahir" />
                    <x-text-input type="date" name="birthdate" class="mt-1 block w-full"
                        value="{{ old('birthdate') }}" required />
                    <x-input-error :messages="$errors->get('birthdate')" />
                </div>

                <div>
                    <x-input-label value="Jenis Kelamin" />
                    <select name="gender" class="mt-1 block w-full rounded-md border-gray-300" required>
                        <option value="male" @selected(old('gender') === 'male')>Laki-laki</option>
                        <option value="female" @selected(old('gender') === 'female')>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('fullname')" />
                </div>

                {{-- Asal Sekolah --}}
                <div>
                    <x-input-label value="Asal Sekolah" />
                    <x-text-input name="school" class="mt-1 block w-full" value="{{ old('school') }}" />
                    <x-input-error :messages="$errors->get('school')" />
                </div>

                <div>
                    <x-input-label value="Alamat" />
                    <x-text-input name="address" class="mt-1 block w-full" value="{{ old('address') }}" />
                    <x-input-error :messages="$errors->get('address')" />
                </div>

                {{-- No. HP Siswa (opsional) --}}
                <div>
                    <x-input-label value="No. HP Siswa (Opsional)" />
                    <x-text-input name="student_phone" class="mt-1 block w-full" value="{{ old('student_phone') }}" />
                    <x-input-error :messages="$errors->get('phone')" />
                </div>

                {{-- Kelas --}}
                <div>
                    <x-input-label value="Kelas" />
                    <select name="class_id" class="mt-1 block w-full rounded-md border-gray-300">
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" @selected(old('class_id') == $class->id)>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('class_id')" />
                </div>

                <hr class="my-4">

                {{-- Data Wali (Opsional) --}}
                <div>
                    <h4 class="font-semibold mb-2">Data Wali (Opsional)</h4>

                    <div class="space-y-4">
                        <div>
                            <x-input-label value="Nama Wali" />
                            <x-text-input name="parent_name" class="mt-1 block w-full"
                                value="{{ old('parent_name') }}" />
                        </div>

                        <div>
                            <x-input-label value="No. HP Wali (WhatsApp)" />
                            <x-text-input name="parent_phone" class="mt-1 block w-full"
                                value="{{ old('parent_phone') }}" />
                        </div>

                        <div>
                            <x-input-label value="Email Wali (Opsional)" />
                            <x-text-input name="parent_email" class="mt-1 block w-full"
                                value="{{ old('parent_email') }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('students.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app-layout>