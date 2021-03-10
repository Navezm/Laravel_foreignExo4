<h1 class="text-center">Edit photo</h1>
<form action="/albums/{{$edit->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Photo</label>
        <input type="file" name="url" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>