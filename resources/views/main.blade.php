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
            <th> {{ $file->name }} </th>
            <th> {{ $file->size }} </th>
            <th> {{ $file->user_id }} </th>
        </table>
    </div>
@endforeach

<style>
    .label-text {
        color: red;
    }

    form {
        align-content: center;
        display: flex;
    }
</style>
