<form action="{{ route('pickup.point.update', $pickup_point->id) }}" method="POST" id="edit_pickup_point_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="pickup_point_name">Pickup Point Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pickup_point_name"
                value="{{ $pickup_point->pickup_point_name }}" placeholder="Pickup Point Name" required>
        </div>
        <div class="form-group">
            <label for="pickup_point_address">Pickup Point Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pickup_point_address"
                value="{{ $pickup_point->pickup_point_address }}" placeholder="Pickup Point Address" required>
        </div>
        <div class="form-group">
            <label for="pickup_point_phone">Pickup Point Phone <span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control" name="pickup_point_phone"
                value="{{ $pickup_point->pickup_point_phone }}" placeholder="Pickup Point Phone" required>
        </div>
        <div class="form-group">
            <label for="pickup_point_phone_two">Pickup Point Another Phone</label>
            <input type="number" min="0" class="form-control" name="pickup_point_phone_two"
                value="{{ $pickup_point->pickup_point_phone_two }}" placeholder="Pickup Point Phone Two">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script>
    $("#edit_pickup_point_form").submit(function(e) {
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
                $("#edit_pickup_point_form")[0].reset();
                $("#editPickupPointModal").modal("hide");
                $("button[type=submit]").attr('disabled', false);
                table.ajax.reload();
            },
            error: function(error) {
                $("button[type=submit]").attr('disabled', false);
            }
        });
    });
</script>
