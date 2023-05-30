<form method="post" action="{{ route('add') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <lable for="file">Upload file</lable>
        <input type="file" name="file" class="form-control">
        @error('file')
        <span class='label-text'>{{ $message }}</span>
        @enderror
    </div>
    <button type="submit">Save</button>
</form>
@foreach($files as $file)
    <div class="files">
        <table>
            <td> {{ $file->name }} </td>
            <td> {{ $file->size }} </td>
            <td> {{ Auth::user()->user_name }} </td>

            <a href="{{ asset("/storage/$file->path") }}">Open</a>
            <form action="{{ route("download") }}" method="post">
                @csrf
                <input type="hidden" name="fileId" value="{{ $file->id }}" >
                <button class="btn" type="submit">Download</button>
            </form>
        </table>
    </div>
@endforeach

<style>

    .btn {
        margin-left: 20px;
    }

    form {
        display: flex;
        align-items: center;
        justify-content: center
    }

    .label-text {
        color: red;
    }

    form {
        align-content: center;
        display: flex;
    }

    .files {
        display: flex;
    }

    div {
        display: flex;
        align-items: center;
        justify-content: center
    }

    a {
        margin-left: 50px;
        display: flex;
        align-items: center;
        justify-content: center
    }

    th {
        margin: 150px;
    }

    table {
        padding: 20px;
    }
</style>
