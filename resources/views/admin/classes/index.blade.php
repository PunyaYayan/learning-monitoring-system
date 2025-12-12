<h1>Daftar Kelas</h1>

<a href="{{ route('classes.create') }}">Tambah Kelas</a>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1" cellpadding="4">

    <thead>
        <tr>
            <th>Nama</th>
            <th>Level</th>
            <th>Jadwal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($classes as $class)
            <tr>
                <td>{{ $class->name }}</td>
                <td>{{ $class->level }}</td>
                <td>{{ $class->schedule_note }}</td>
                <td>
                    <a href="{{ route('classes.edit', $class) }}">Edit</a>
                    <form action="{{ route('classes.destroy', $class) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm ('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Belum ada kelas.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $classes->links() }}