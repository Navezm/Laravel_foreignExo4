<h1 class="text-center">Add an Album</h1>
<form action="/albums" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label>Author</label>
        <input type="text" name="author" class="form-control">
    </div>
    <div class="form-group">
        <label>Photo</label>
        <input type="file" name="url" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>