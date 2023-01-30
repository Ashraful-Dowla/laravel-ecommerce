<form action={{ route('contact.update', $contact->id) }} method="POST" id="update_contact_form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $contact->status == 1 ? 'selected' : null }}>Replied</option>
                <option value="0" {{ $contact->status == 0 ? 'selected' : null }}>New message</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script>
    $("#update_contact_form").submit(function(e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let request = $(this).serialize();

        $("button[type=submit]").attr('disabled', true);

        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            async: false,
            data: request,
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
                $("#update_contact_form")[0].reset();
                $("#editContactModal").modal("hide");
                $("button[type=submit]").attr('disabled', false);
            },
            error: function(error) {
                $("button[type=submit]").attr('disabled', false);
            }
        });
    });
</script>
