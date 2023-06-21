<!DOCTYPE html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <form method="post" action="{{ route('logout') }}">
        @csrf

        <button class="logout">Log Out</button>
    </form>

    <div class="weather">
        @include('weather')
    </div>

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

    <form id="myForm" name="myForm" method="post" action="{{ route('add') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-top: 20px;">
            <lable for="file">Upload file</lable>
            <input id="file" type="file" name="file" class="form-control">
            @error('file')
            <span class='label-text'>{{ $message }}</span>
            @enderror
            <input id="directoryId" type="hidden" name="directoryId" value="{{ $id }}">
            <label>File lifetime up to (optional):</label>
            <input id="die" type="datetime-local" name="die">

            <button class="btnSave" type="submit">Save</button>
        </div>
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

{{--<script--}}
{{--    src="https://code.jquery.com/jquery-3.7.0.min.js"--}}
{{--    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="--}}
{{--    crossorigin="anonymous">--}}
{{--</script>--}}

{{--<script type="text/javascript">--}}

{{--    $(document).ready(function () {--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}

{{--        $('#myForm:first').submit(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var formData = new FormData(this);--}}

{{--            $.ajax({--}}
{{--                type: 'POST',--}}
{{--                url: $(this).attr('action'),--}}
{{--                data: formData,--}}
{{--                cache: false,--}}
{{--                dataType: 'json',--}}
{{--                contentData: false,--}}
{{--                processData: false,--}}
{{--                success: function (data) {--}}
{{--                    console.log('success');--}}
{{--                    console.log(data);--}}
{{--                },--}}
{{--                error: function(data) {--}}
{{--                    console.log(data);--}}

{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}

<style>
    .weather {
        position: relative;
        top: 0;
        left: 1600px;
    }

    .logout {
        position: relative;
        top: 0;
        left: 1830px;
    }

    body {
        background: pink;
    }
</style>
