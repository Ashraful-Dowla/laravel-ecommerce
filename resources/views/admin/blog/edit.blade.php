<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<form action={{ route('blog.update', $blog->id) }} method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="title">Category</label>
            <select name="blog_category_id" class="form-control">
                @foreach ($blog_categories as $row)
                    <option value="{{ $row->id }}" {{ $blog->blog_category_id == $row->id ? 'selected' : null }}>
                        {{ $row->blog_category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required value="{{ $blog->title }}">
        </div>
        <div class="form-group">
            <label for="published_date">Date</label>
            <input type="date" class="form-control" name="published_date" required
                value="{{ $blog->published_date }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $blog->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Tags</label><br>
            <input type="text" name="tags" class="form-control tag" data-role="tagsinput" style="min-width: 100%;"
                value="{{ $blog->tags }}">
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" class="dropify" name="thumbnail">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $blog->status == 1 ? 'selected' : null }}>Active</option>
                <option value="0" {{ $blog->status == 0 ? 'selected' : null }}>Inactive</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Click here',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
</script>
