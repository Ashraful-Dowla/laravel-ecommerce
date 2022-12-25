<form action={{ route('childcategory.update') }} method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <select name="category_id" class="form-control" onchange="getEditSubcategoryByCategoryId(this)">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == $childcategory->category_id ? 'selected' : null }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_name">Sub Category Name</label>
            <select id="e_subcategory" name="subcategory_id" class="form-control">
                <option selected disabled>Choose Subcategory</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}"
                        {{ $subcategory->id == $childcategory->subcategory_id ? 'selected' : null }}>
                        {{ $subcategory->subcategory_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_name">Child Category Name</label>
            <input type="text" class="form-control" name="childcategory_name"
                value="{{ $childcategory->childcategory_name }}" required>
            <input type="hidden" name="id" value="{{ $childcategory->id }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
