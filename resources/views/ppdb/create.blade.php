<x-public-layout>
    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Pendaftaran Siswa Baru
        </h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('ppdb.store') }}">
            @csrf

            <div class="space-y-4">

                {{-- DATA SISWA --}}

                <div>
                    <x-input-label value="Nama Lengkap Siswa" />
                    <x-text-input name="fullname" class="w-full" value="{{ old('fullname') }}" required />
                </div>

                <div>
                    <x-input-label value="Tanggal Lahir" />
                    <x-text-input type="date" name="birthdate" class="w-full" value="{{ old('birthdate') }}" />
                </div>

                <div>
                    <x-input-label value="Jenis Kelamin" />
                    <select name="gender" class="w-full border rounded">
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>

                <div>
                    <x-input-label value="Sekolah Asal" />
                    <x-text-input name="school" class="w-full" value="{{ old('school') }}" />
                </div>

                <div>
                    <x-input-label value="Email Siswa" />
                    <x-text-input type="email" name="student_email" class="w-full" value="{{ old('student_email') }}" />
                </div>

                <div>
                    <x-input-label value="Alamat" />
                    <textarea name="address" class="w-full border rounded" rows="2">{{ old('address') }}</textarea>
                </div>

                <div>
                    <x-input-label value="Nomor HP Siswa" />
                    <x-text-input name="phone" class="w-full" value="{{ old('phone') }}" required />
                </div>


                {{-- DATA ORANG TUA / WALI --}}

                <hr class="my-4">

                <div class="font-semibold text-sm text-gray-600">
                    Data Orang Tua / Wali
                </div>

                <div>
                    <x-input-label value="Nama Orang Tua / Wali" />
                    <x-text-input name="parent_name" class="w-full" value="{{ old('parent_name') }}" />
                </div>

                <div>
                    <x-input-label value="Nomor HP Orang Tua / Wali" />
                    <x-text-input name="parent_phone" class="w-full" value="{{ old('parent_phone') }}" />
                </div>

                <div>
                    <x-input-label value="Email Orang Tua / Wali" />
                    <x-text-input type="email" name="parent_email" class="w-full" value="{{ old('parent_email') }}" />
                </div>


                {{-- TIPE PENDAFTAR --}}

                <div>
                    <x-input-label value="Pendaftar Sebagai" />
                    <select name="applicant_type" class="w-full border rounded" required>
                        <option value="student">Siswa</option>
                        <option value="college_student">Mahasiswa</option>
                        <option value="worker">Pekerja</option>
                    </select>
                </div>

            </div>

            <div class="mt-6">
                <x-primary-button>
                    Daftar
                </x-primary-button>
            </div>

        </form>
    </x-card>
</x-public-layout>