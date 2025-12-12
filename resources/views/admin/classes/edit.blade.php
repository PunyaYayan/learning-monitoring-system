<h1>Edit Kelas</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.classes.update', $class) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Nama Kelas</label>
        <input type="text" name="name" value="{{ old('name', $class->name) }}">
    </div>
    <div>
        <label>Level</label>
        <input type="text" name="level" value="{{ old('level', $class->level) }}">
    </div>
    <div>
        <label>Catatan Jadwal</label>
        <input type="text" name="schedule_note" value="{{ old('name', $class->schedule_note) }}">
    </div>

    <button type="submit">Update</button>
</form>