<form action={{ route('subcategory.update') }} method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == $subcategory->category_id ? 'selected' : null }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            @error('category_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_name">Sub Category Name</label>
            <input type="text" class="form-control" id="category_name" name="subcategory_name"
                value="{{ $subcategory->subcategory_name }}" required>
            <input type="hidden" name="id" value="{{ $subcategory->id }}">
        </div>
        @error('subcategory_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        @error('subcategory_slug')
            <span class="invalid-feedback" role="alert">
                <strong>sub category name already exists</strong>
            </span>
        @enderror
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
