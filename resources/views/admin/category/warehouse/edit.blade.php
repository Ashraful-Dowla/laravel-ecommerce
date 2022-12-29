<form action="{{ route('warehouse.update', $warehouse->id) }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Warehouse Name</label>
            <input type="text" class="form-control" name="warehouse_name" value="{{ $warehouse->warehouse_name }}"
                placeholder="Warehouse name" required>
        </div>
        <div class="form-group">
            <label for="category_name">Warehouse Address</label>
            <textarea type="text" class="form-control" name="warehouse_address" placeholder="Warehouse address" required>{{ $warehouse->warehouse_address }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_name">Warehouse Phone</label>
            <input type="text" class="form-control" name="warehouse_phone" value="{{ $warehouse->warehouse_phone }}"
                placeholder="Warehouse phone" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
