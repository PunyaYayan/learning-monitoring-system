<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Edit Siswa
        </h2>
    </x-slot>

    <x-card>

        <div class="mb-6">
            <h3 class="text-lg font-semibold">Form Edit Siswa</h3>
            <p class="text-sm text-gray-500">
                Perbarui data siswa yang dipilih.
            </p>
        </div>

        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('PUT')

            <div class="space-y-5">

                {{-- Nama --}}
                <div>
                    <x-input-label value="Nama Siswa" />
                    <x-text-input name="fullname" class="mt-1 block w-full"
                        value="{{ old('fullname', $student->fullname) }}" required />
                    <x-input-error :messages="$errors->get('fullname')" />
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <x-input-label value="Tanggal Lahir" />
                    <x-text-input type="date" name="birthdate" class="mt-1 block w-full"
                        value="{{ old('birthdate', $student->birthdate) }}" required />
                    <x-input-error :messages="$errors->get('birthdate')" />
                </div>

                {{-- Gender --}}
                <div>
                    <x-input-label value="Jenis Kelamin" />
                    <select name="gender" class="mt-1 block w-full border-gray-300 rounded">
                        <option value="male" @selected(old('gender', $student->gender) === 'male')>Laki-laki</option>
                        <option value="female" @selected(old('gender', $student->gender) === 'female')>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" />
                </div>

                {{-- Sekolah --}}
                <div>
                    <x-input-label value="Sekolah" />
                    <x-text-input name="school" class="mt-1 block w-full"
                        value="{{ old('school', $student->school) }}" />
                    <x-input-error :messages="$errors->get('school')" />
                </div>

                {{-- Alamat --}}
                <div>
                    <x-input-label value="Alamat" />
                    <textarea name="address" class="mt-1 block w-full border-gray-300 rounded">
{{ old('address', $student->address) }}</textarea>
                    <x-input-error :messages="$errors->get('address')" />
                </div>
                @if (is_null($student->user_id))
                    <div class="mt-6 border-t pt-6">
                        <h4 class="font-semibold text-sm mb-2">Buat Akun Login Siswa</h4>

                        <div>
                            <x-input-label value="Nomor HP (Login)" />
                            <x-text-input name="login_phone" class="mt-1 block w-full" placeholder="08xxxxxxxxxx" />
                            <x-input-error :messages="$errors->get('login_phone')" />
                        </div>
                    </div>
                @endif

            </div>

            <div class="flex items-center justify-end gap-3 mt-8">
                <a href="{{ route('students.index') }}" class="text-sm text-gray-600 hover:underline">
                    Batal
                </a>

                <x-primary-button>
                    Simpan Perubahan
                </x-primary-button>
            </div>

        </form>

    </x-card>
</x-app-layout>