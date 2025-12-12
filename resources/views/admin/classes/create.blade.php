<h1>Tambah Kelas</h1>


@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('classes.store') }}" method="POST">
    @csrf
    <div>
        <label>Nama Kelas</label>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        <label>Level</label>
        <input type="text" name="level" value="{{ old('level') }}">
    </div>

    <div>
        <label>Catatan Jadwal</label>
        <input type="text" name="schedule_note" value="{{ old('schedule_note') }}">
    </div>

    <button type="submit">Simpan</button>
</form>