<form method="post" action="{{ route('add') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <lable for="file">Upload file</lable>
        <input type="file" name="file" class="form-control">
        @error('file')<div class="panel alert-danger">{{ $message }}</div>@enderror
    </div>
    <button type="submit">Save</button>
</form>

<style>
    form {
        display: flex;
    }
</style>
