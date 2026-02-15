<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Tambah Orang Tua / Wali
        </h2>
    </x-slot>

    <x-card>
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Form Tambah Orang Tua</h3>
            <p class="text-sm text-gray-500">
                Akun login bersifat opsional dan dapat dibuat oleh admin.
            </p>
        </div>

        <form method="POST" action="{{ route('admin.parents.store') }}">
            @csrf

            <div class="space-y-5">
                <div>
                    <x-input-label value="Nama Orang Tua" />
                    <x-text-input name="name" class="mt-1 block w-full" value="{{ old('name') }}" required />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label value="No. HP (WhatsApp)" />
                    <x-text-input name="phone" class="mt-1 block w-full" value="{{ old('phone') }}" required />
                    <x-input-error :messages="$errors->get('phone')" />
                </div>

                <div>
                    <x-input-label value="Email (Opsional)" />
                    <x-text-input type="email" name="email" class="mt-1 block w-full" value="{{ old('email') }}" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="create_account" value="1" id="create_account" {{ old('create_account') ? 'checked' : '' }}>
                    <label for="create_account" class="text-sm text-gray-700">
                        Buatkan akun login untuk orang tua
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.parents.index') }}" class="text-sm text-gray-600 hover:underline">
                    Batal
                </a>
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app-layout>