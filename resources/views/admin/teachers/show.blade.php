<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Detail Guru
        </h2>
    </x-slot>

    <x-card>
        <div class="mb-6">
            <h3 class="text-lg font-semibold">
                Informasi Guru
            </h3>
            <p class="text-sm text-gray-500">
                Detail data guru dan akun login.
            </p>
        </div>

        <div class="space-y-6">
            {{-- Nama --}}
            <div>
                <p class="text-sm text-gray-500">Nama Guru</p>
                <p class="text-base font-medium text-gray-800">
                    {{ $teacher->user->name }}
                </p>
            </div>

            {{-- No HP --}}
            <div>
                <p class="text-sm text-gray-500">No. HP (WhatsApp)</p>
                <p class="text-base font-medium text-gray-800">
                    {{ $teacher->user->phone }}
                </p>
            </div>

            {{-- Email --}}
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="text-base font-medium text-gray-800">
                    {{ $teacher->user->email ?? '-' }}
                </p>
            </div>

            {{-- Bio --}}
            <div>
                <p class="text-sm text-gray-500">Bio Guru</p>
                <p class="text-base text-gray-800 whitespace-pre-line">
                    {{ $teacher->bio ?? 'Belum ada bio.' }}
                </p>
            </div>
        </div>
        <!-- <hr class="my-6">

        <div>
            <h4 class="text-lg font-semibold mb-2">Kelas yang Diampu</h4>

            @if ($teacher->classes->isEmpty())
                <p class="text-sm text-gray-500">
                    Guru ini belum ditugaskan ke kelas mana pun.
                </p>
            @else
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($teacher->classes as $class)
                        <li class="text-sm text-gray-800">
                            {{ $class->name }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div> -->
        <hr class="my-6">

        <div>
            <h4 class="text-lg font-semibold mb-2">Kelas & Jumlah Pertemuan</h4>

            @if ($teacher->classes->isEmpty())
            
                <p class="text-sm text-gray-500">
                    Guru ini belum ditugaskan ke kelas mana pun.
                </p>
            @else
                <ul class="space-y-2">
                    @foreach ($teacher->classes as $class)
                        <li class="text-sm text-gray-800">
                            <span class="font-medium">{{ $class->name }}</span>
                            <span class="text-gray-500">
                                ({{ $class->meetings->count() }} pertemuan)
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('teachers.index') }}" class="text-sm text-gray-600 hover:underline">
                Kembali
            </a>

            <a href="{{ route('teachers.edit', $teacher) }}">
                <x-primary-button>
                    Edit
                </x-primary-button>
            </a>
        </div>
    </x-card>
</x-app-layout>