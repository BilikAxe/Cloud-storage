<!DOCTYPE html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <form method="post" action="{{ route('logout') }}">
        @csrf

        <button class="logout">Log Out</button>
    </form>
</head>

<body>

    <div class="weather">
        @include('weather')
    </div>

    <div class="create">
        <form method="post" action="{{ route('directory') }}">
            @csrf
            <label>Create directory
                <input style="margin-top: 20px;" type="text" name="directoryName" value="Untitled">
            </label>
            @error('directoryName')
            <span class='label-text'>{{ $message }}</span>
            @enderror
            <input type="hidden" name="parentId" value="{{ $id }}">
            <button type="submit" >Create</button>
        </form>
    </div>

    <div class="save">
        <form id="myForm" name="myForm" method="post" action="{{ route('add') }}" enctype="multipart/form-data">
            @csrf
            <lable for="file">Upload file
                <input style="margin-bottom: 20px;" id="file" type="file" name="file" class="form-control">
            </lable>
            @error('file')
            <span class='label-text'>{{ $message }}</span>
            @enderror
            <input id="directoryId" type="hidden" name="directoryId" value="{{ $id }}">
            <label>File lifetime up to (optional):
                <input style="margin-top: 20px;" id="die" type="datetime-local" name="die">
            </label>
            <button class="btn-save" type="submit">Save</button>
        </form>
    </div>

    <table style="margin-top: 20px; margin-bottom: 1px">
        <td class="name">File name</td>
        <td class="size">Size</td>
        <td class="user">Owner</td>
        <td class="open">Open</td>
        <td class="download">Download</td>
        <td class="delete">Delete</td>
    </table>
    @foreach($directories as $directory)
        <div class="files">
            <table>
                <td class="name"> {{ $directory->name }} </td>
                <td class="size">--</td>
                <td class="user"> {{ Auth::user()->user_name }} </td>
                <td class="open">
                    <a style="text-decoration: none; margin: 20px;" href="/directory/{{ $directory->id }}">Open</a>
                </td>
                <td class="download">--</td>
                <td class="delete">
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
                <td class="name"> {{ $file->name }} </td>
                <td class="size"> {{ $file->size }} KB </td>
                <td class="user"> {{ Auth::user()->user_name }} </td>
                <td class="open">
                    <a style="text-decoration: none; margin: 20px" href="{{ asset("/storage/$file->path") }}">Open</a>
                </td>
                <td class="download">
                    <form style="margin: 20px" action="{{ route("download") }}" method="post">
                        @csrf
                        <input type="hidden" name="fileId" value="{{ $file->id }}" >
                        <button class="btn" type="submit">Download</button>
                    </form>
                </td>
                <td class="delete">
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

    table {
        background-color: #f1f1f1;
        position: relative;
        top: -300px;
        width: 1700px; /* Ширина таблицы */
        border: 1px solid black; /* Рамка вокруг таблицы */
        margin: auto; /* Выравниваем таблицу по центру окна  */
        border-radius: 10px;
    }
    td {
        /*border: 1px solid #333;*/
        /*text-align: center; !* Выравниваем текст по центру ячейки *!*/
    }

    .name {
        width: 500px;
    }

    .size {
        text-align: center;
        width: 100px;
    }

    .user {
        text-align: center;
        width: 400px;
    }

    .weather {
        margin-bottom: 20px;
    }

    .open {
        text-align: center;
        width: 100px;
    }

    .download {
        width: 200px;
        text-align: center;
    }

    .logout {
        position: relative;
        top: 0;
        left: 1830px;
    }

    .delete {
        text-align: center;
        width: 150px;
    }

    body {
        background: #e1fcff;
    }

    .create, .save {
        position: relative;
        background-color: #f1f1f1;
        width: 350px;
        height: 100%;
        border-radius: 10px;
        /*box-shadow: -11px 11px 22px deepskyblue, 11px -11px 22px deepskyblue;*/
        padding: 20px;
        top: -310px;
        left: 750px;
        margin-bottom: 20px;
    }
</style>
