<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<form action={{ route('campaign.update', $campaign->id) }} method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="campaign_title">Campaign Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="campaign_title" value="{{ $campaign->campaign_title }}"
                required>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="campaign_start_date">Campaign Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="campaign_start_date"
                        value="{{ $campaign->campaign_start_date }}" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="campaign_end_date">Campaign End Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="campaign_end_date"
                        value="{{ $campaign->campaign_end_date }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="campaign_status">Campaign Status</label>
                    <select name="campaign_status" class="form-control">
                        <option value="1" {{ $campaign->campaign_status == 1 ? 'selected' : null }}>Active</option>
                        <option value="0" {{ $campaign->campaign_status == 0 ? 'selected' : null }}>Inactive
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="campaign_discount">Campaign Discount <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="campaign_discount"
                        value="{{ $campaign->campaign_discount }}" required>
                    <small class="form-text text-danger">Discount percentage are apply for all product
                        selling price</small>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="campaign_image">Campaign Logo</span></label>
            <input type="file" class="dropify" name="campaign_image">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
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
