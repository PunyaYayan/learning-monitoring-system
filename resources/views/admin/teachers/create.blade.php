<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Tambah Guru
        </h2>
    </x-slot>

    <x-card>
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Form Tambah Guru</h3>
            <p class="text-sm text-gray-500">
                Data guru akan otomatis dibuatkan akun login.
            </p>
        </div>

        <form method="POST" action="{{ route('admin.teachers.store') }}">
            @csrf

            <div class="space-y-5">
                {{-- Nama Guru (users.name) --}}
                <div>
                    <x-input-label value="Nama Guru" />
                    <x-text-input name="name" class="mt-1 block w-full" value="{{ old('name') }}" required />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                {{-- No HP (users.phone + teachers.phone opsional) --}}
                <div>
                    <x-input-label value="No. HP (WhatsApp)" />
                    <x-text-input name="phone" class="mt-1 block w-full" value="{{ old('phone') }}" required />
                    <x-input-error :messages="$errors->get('phone')" />
                </div>

                {{-- Email (users.email) --}}
                <div>
                    <x-input-label value="Email (Opsional)" />
                    <x-text-input name="email" type="email" class="mt-1 block w-full" value="{{ old('email') }}" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                {{-- Bio Guru (teachers.bio) --}}
                <div>
                    <x-input-label value="Bio Guru (Opsional)" />
                    <textarea name="bio" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio') }}</textarea>
                    <x-input-error :messages="$errors->get('bio')" />
                </div>

                <div class="text-sm text-gray-500">
                    Password awal akan dibuat otomatis oleh sistem.
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.teachers.index') }}" class="text-sm text-gray-600 hover:underline">
                    Batal
                </a>

                <x-primary-button>
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-card>
</x-app-layout>