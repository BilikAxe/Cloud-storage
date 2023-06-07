<head>
    <form method="post" action="{{ route('directory') }}">
        @csrf
        <label>Create directory</label>
        <input type="text" name="directoryName" value="Untitled">
        @error('directoryName')
        <span class='label-text'>{{ $message }}</span>
        @enderror
        <input type="hidden" name="parentId" value="{{ $id }}">
        <button type="submit" >Create</button>
    </form>

    <form method="post" action="{{ route('add') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <lable for="file">Upload file</lable>
            <input type="file" name="file" class="form-control">
            <input type="hidden" name="directoryId" value="{{ $id }}"
            @error('file')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Save</button>
    </form>
</head>

<body>
    @foreach($directories as $directory)
        <div class="files">
            <table>
                <td> {{ $directory->name }} </td>
                <td> {{ $directory->size }} </td>
                <td> {{ Auth::user()->user_name }} </td>

                <a href="/directory/{{ $directory->id }}">Open</a>
            </table>
        </div>
    @endforeach
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
</body>


<style>
    head {
        float: left;
    }

    body {
        background: lightpink;
    }

    .form-group {
        align-items: center;
        display: inline;
    }

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

    .files {
        display: flex;
        align-items: center;
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
