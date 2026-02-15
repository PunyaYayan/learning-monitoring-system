<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Dashboard
        </h2>
    </x-slot>

    {{-- Welcome / Hero --}}
    <x-card class="mb-8 bg-gradient-to-r from-brand-primary/40 to-brand-secondary/40">
        <h3 class="text-2xl font-semibold mb-1">
            Selamat datang kembali, {{ auth()->user()->name }}
        </h3>
        <p class="text-gray-700">
            Kelola sistem monitoring progres belajar siswa dari sini.
        </p>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <x-action-card title="Data Kelas" desc="Kelola kelas dan level pembelajaran"
                href="{{ route('admin.classes.index') }}" bg="bg-brand-primary/30" />

            <x-action-card title="Data Siswa" desc="Kelola data siswa dan profil"
                href="{{ route('admin.students.index') }}" bg="bg-emerald-100" />
            <x-action-card title="Data Guru" desc="Kelola data guru dan profil"
                href="{{ route('admin.teachers.index') }}" bg="bg-emerald-100" />

            <x-action-card title="Data Orang Tua" desc="Kelola data wali siswa"
                href="{{ route('admin.parents.index') }}" bg="bg-brand-secondary/40" />
            <x-action-card title="Data Meeting" desc="Lihat data meeting dan progress siswa"
                href="{{ route('admin.meetings.index') }}" bg="bg-brand-secondary/90" />
            <x-action-card title="Data Rapor Siswa" desc="Lihat rapor siswa" href="{{ route('admin.rapor.index') }}"
                bg="bg-brand-secondary/90" />
            <x-action-card title="Validasi PPDB" desc="Lihat dan validasi data ppdb"
                href="{{ route('admin.ppdb.index') }}" bg="bg-brand-secondary/40" />
        </div>
    </x-card>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <x-stat-card label="Total Siswa" value="{{ $totalStudents }}" />
        <x-stat-card label="Total Kelas" value="{{ $totalClasses }}" />
        <x-stat-card label="Total Guru" value="{{ $totalTeachers }}" />
        <x-stat-card label="Pertemuan Aktif" value="{{ $activeMeetingsCount }}" />

    </div>

    {{-- Informasi Bawah --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-card>
            <h4 class="font-semibold text-lg mb-2">Aktivitas Terbaru</h4>
            @if ($recentMeetings->isEmpty())
                <p class="text-sm text-gray-500">
                    Aktivitas sistem akan ditampilkan setelah data digunakan.
                </p>
            @else
                <ul class="text-sm space-y-2">
                    @foreach ($recentMeetings as $meeting)
                        <li>
                            {{ $meeting->teacher->user->name }}
                            menginput meeting
                            <strong>{{ $meeting->class->name }}</strong>
                            {{ (\Carbon\Carbon::parse($meeting->meeting_date)->format('d-m-Y')) }}
                        </li>
                    @endforeach
                </ul>
            @endif

        </x-card>

        <x-card>
            <h4 class="font-semibold text-lg mb-3">Pertemuan Hari Ini</h4>

            @if ($todayMeetings->isNotEmpty())
                <ul class="text-sm space-y-2">
                    @foreach ($todayMeetings as $meeting)
                        <li>
                            <strong>{{ $meeting->class->name }}</strong> —
                            {{ $meeting->teacher->user->name }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-500 mb-3">
                    Tidak ada pertemuan hari ini.
                </p>

                @if ($inactiveClasses->isNotEmpty())
                    <p class="text-sm font-medium mb-1">
                        Kelas yang belum memiliki aktivitas:
                    </p>
                    <ul class="text-sm space-y-1 text-gray-700">
                        @foreach ($inactiveClasses as $class)
                            <li>
                                {{ $class->name }}
                                ({{ $class->level_label }}) —
                                {{ $class->teacher->user->name }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endif
        </x-card>

        <!-- <x-card>
        <h4 class="font-semibold text-lg mb-3">Aktivitas Terbaru</h4>
    
        <div class="space-y-3 text-sm">
    
            {{-- Aktivitas Meeting --}}
            @forelse ($recentMeetings as $meeting)
                <div>
                    <strong>{{ $meeting->teacher->user->name }}</strong>
                    menambahkan pertemuan
                    <strong>{{ $meeting->class->name }}</strong>
                    <span class="text-gray-500">
                        ({{ $meeting->created_at->diffForHumans() }})
                    </span>
                </div>
            @empty
                <p class="text-gray-500">Belum ada aktivitas meeting.</p>
            @endforelse
    
            {{-- Separator --}}
            @if ($recentMeetings->isNotEmpty() && $recentProgresses->isNotEmpty())
                <hr>
            @endif
    
            {{-- Aktivitas Progres --}}
            @forelse ($recentProgresses as $progress)
                <div>
                    Progres siswa
                    <strong>{{ $progress->student->name }}</strong>
                    diperbarui
                    <span class="text-gray-500">
                        ({{ $progress->created_at->diffForHumans() }})
                    </span>
                </div>
            @empty
                <p class="text-gray-500">Belum ada aktivitas progres siswa.</p>
            @endforelse
    
        </div>
    </x-card> -->

    </div>
</x-app-layout>