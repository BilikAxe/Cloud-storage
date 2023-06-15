<head>

    <form method="post" action="{{ route('logout') }}">
        @csrf

        <button class="logout">Log Out</button>
    </form>

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
                <td>
                    <a style="text-decoration: none; margin: 20px;" href="/directory/{{ $directory->id }}">Open</a>
                </td>
                <td>
                    <form style="margin: 20px" action="{{ route("deleteDirectory") }}" method="post">
                        @csrf
                        <input type="hidden" name="directoryId" value="{{ $directory->id }}" >
                        <button class="btn" type="submit">Delete</button>
                    </form>
                </td>
            </table>
        </div>
    @endforeach
    @foreach($files as $file)
        <div class="files">
            <table>
                <td> {{ $file->name }} </td>
                <td> {{ $file->size }} </td>
                <td> {{ Auth::user()->user_name }} </td>
                <td>
                    <a style="text-decoration: none; margin: 20px" href="{{ asset("/storage/$file->path") }}">Open</a>
                </td>
                <td>
                    <form style="margin: 20px" action="{{ route("download") }}" method="post">
                        @csrf
                        <input type="hidden" name="fileId" value="{{ $file->id }}" >
                        <button class="btn" type="submit">Download</button>
                    </form>
                </td>
                <td>
                    <form style="margin: 20px" action="{{ route("delete") }}" method="post">
                        @csrf
                        <input type="hidden" name="fileId" value="{{ $file->id }}" >
                        <button class="btn" type="submit">Delete</button>
                    </form>
                </td>
            </table>
        </div>
    @endforeach

</body>

<style>

    .logout {
        position: relative;
        top: 0;
        left: 1830px;
    }

    body {
        background: pink;
    }
</style>
