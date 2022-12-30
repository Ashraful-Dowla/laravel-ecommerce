<form action="{{ route('coupon.update', $coupon->id) }}" method="POST" id="edit_coupon_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" class="form-control" name="coupon_code" value="{{ $coupon->coupon_code }}"
                placeholder="Coupon Code" required>
        </div>
        <div class="form-group">
            <label for="coupon_type">Coupon Type</label>
            <select name="coupon_type" class="form-control">
                <option value="1" {{ $coupon->coupon_type == '1' ? 'selected' : null }}>Fixed</option>
                <option value="2" {{ $coupon->coupon_type == '2' ? 'selected' : null }}>Percentage</option>
            </select>
        </div>
        <div class="form-group">
            <label for="coupon_amount">Coupon Amount</label>
            <input type="number" min="0"class="form-control" name="coupon_amount"
                value="{{ $coupon->coupon_amount }}" placeholder="Coupon Amount" required>
        </div>
        <div class="form-group">
            <label for="coupon_valid_date">Coupon Valid Date</label>
            <input type="date" class="form-control" name="coupon_valid_date" value="{{ $coupon->coupon_valid_date }}"
                placeholder="Coupon Valid Date" required>
        </div>
        <div class="form-group">
            <label for="coupon_status">Coupon Status</label>
            <select name="coupon_status" class="form-control">
                <option value="1" {{ $coupon->coupon_status == '1' ? 'selected' : null }}>Active</option>
                <option value="2" {{ $coupon->coupon_status == '2' ? 'selected' : null }}>Inactive</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script>
    $("#edit_coupon_form").submit(function(e) {
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
                $("#edit_coupon_form")[0].reset();
                $("#editCouponModal").modal("hide");
                $("button[type=submit]").attr('disabled', false);
                table.ajax.reload();
            },
            error: function(error) {
                $("button[type=submit]").attr('disabled', false);
            }
        });
    });
</script>
