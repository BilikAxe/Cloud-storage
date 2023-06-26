<!DOCTYPE html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="logout">Log Out</button>
    </form>
    <form action="{{ route('main') }}" method="get">
        <button class="main"></button>
    </form>
    <form class="search-group" method="post" action="{{ route('search') }}">
        @csrf
        <label style="position: relative; left: 680px;">Search</label>
        <input class="search" name="search" type="search" id="search" value="">
        <button class="btn-search" type="submit">Search</button>
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
            <span class='label-text-dir'>{{ $message }}</span>
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
            <span class='label-text-file'>{{ $message }}</span>
            @enderror
            <input id="directoryId" type="hidden" name="directoryId" value="{{ $id }}">
            <label>File lifetime up to (optional):
                <input style="margin-top: 20px;" id="die" type="datetime-local" name="die">
            </label>
            <button class="btn-save" type="submit">Save</button>
        </form>
    </div>
    <table style="margin-top: 20px; margin-bottom: 1px">
        <td class="name">File name
            <form action="{{ route('search') }}" method="post">
                @csrf
                <input style="width: 300px;" class="titFileName" name="fileName">
                <button type="submit">Search</button>
            </form>
        </td>
        <td class="size">Size
            <form action="{{ route('search') }}" method="post">
                @csrf
                <input style="width: 150px;" class="titSize" name="fileSize">
                <button type="submit">Search</button>
            </form>
        </td>
        <td class="owner">Owner
            <form action="{{ route('search') }}" method="post">
                @csrf
                <input style="width: 150px;" class="titOwner" name="fileOwner">
                <button type="submit">Search</button>
            </form>
        </td>
        <td class="open">Open</td>
        <td class="download">Download</td>
        <td class="delete">Delete</td>
    </table>
    @foreach($directories as $directory)
        <div class="files">
            <table>
                <td class="name"> {{ $directory->name }} </td>
                <td class="size">--</td>
                <td class="owner"> {{ $directory->owner }} </td>
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
                <td class="owner"> {{ $file->owner }} </td>
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
        width: 1700px;
        border: 1px solid black;
        margin: auto;
        border-radius: 10px;
    }
    td {
        /*border: 1px solid #333;*/
    }

    button {
        cursor: pointer;
    }

    .main {
        position: relative;
        /*left: 100px;*/
        bottom: 20px;
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 50px;
        background-size: cover;
        background-image: url("https://cdn.icon-icons.com/icons2/1458/PNG/512/homebutton_99695.png");
    }

    .main:hover {
        opacity: 0.8;
    }

    .search-group {
        position: relative;
        bottom: 70px;
    }

    .main:active {
        transform: scale(0.95);
    }


    .btn-search {
        position: relative;
        left: 700px;
    }

    .name {
        width: 400px;
    }

    .size {
        text-align: center;
        width: 200px;
    }

    .owner {
        text-align: center;
        width: 200px;
    }

    .search {
        position: relative;
        left: 690px;
        width: 400px;
     }

    .weather {
        position: relative;
        margin-bottom: 20px;
    }

    .open {
        text-align: center;
        width: 100px;
    }

    .download {
        width: 150px;
        text-align: center;
    }

    .logout {
        position: relative;
        top: 0;
        left: 1830px;
    }

    .delete {
        text-align: center;
        width: 100px;
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
        top: -330px;
        left: 750px;
        margin-bottom: 20px;
    }

    .label-text-file {
        color: red;
    }
</style>
