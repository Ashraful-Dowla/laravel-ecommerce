<form action="{{ route('order.update', $order->id) }}" method="POST" id="edit_order_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="c_name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="c_name" value="{{ $order->c_name }}" required>
        </div>
        <div class="form-group">
            <label for="c_email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="c_email" value="{{ $order->c_email }}" required>
        </div>
        <div class="form-group">
            <label for="c_address">Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="c_address" value="{{ $order->c_address }}" required>
        </div>
        <div class="form-group">
            <label for="c_phone">Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="c_phone" value="{{ $order->c_phone }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status">
                <option value="0" {{ $order->status == 0 ? 'selected' : null }}>Pending</option>
                <option value="1" {{ $order->status == 1 ? 'selected' : null }}>Received</option>
                <option value="2" {{ $order->status == 2 ? 'selected' : null }}>Shipped</option>
                <option value="3" {{ $order->status == 3 ? 'selected' : null }}>Done</option>
                <option value="4" {{ $order->status == 4 ? 'selected' : null }}>Return</option>
                <option value="5" {{ $order->status == 5 ? 'selected' : null }}>Cancel</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script>
    $("#edit_order_form").submit(function(e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let request = $(this).serialize();

        $("button[type=submit]").attr('disabled', true);

        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: request,
            success: function(data) {
                toastr.success(data);
                $("#edit_order_form")[0].reset();
                $("#editOrderModal").modal("hide");
                $("button[type=submit]").attr('disabled', false);
                table.ajax.reload();
            },
            error: function(error) {
                $("button[type=submit]").attr('disabled', false);
            }
        });
    });
</script>
