<form action="{{ route('order.details.update', $order->id) }}" method="Post" id="view_edit_form">
    @csrf
    <div class="modal-body">
        <strong>Order Details</strong>
        <div class="row">
            <div class="col-4">
                <p>Name : {{ $order->c_name }}</p>
            </div>
            <div class="col-4">
                <p>Phone : {{ $order->c_phone }}</p>
            </div>
            <div class="col-4">
                <p>Email : {{ $order->c_email }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Country : {{ $order->c_country }}</p>
            </div>
            <div class="col-4">
                <p>City : {{ $order->c_city }}</p>
            </div>
            <div class="col-4">
                <p>Zipcode : {{ $order->c_zipcode }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>OrderID : {{ $order->order_id }}</p>
            </div>
            <div class="col-4">
                <p>Subtotal : {{ $order->subtotal }} {{ $setting->currency }}</p>
            </div>
            <div class="col-4">
                <p>Total : {{ $order->total }} {{ $setting->currency }}</p>
            </div><br>

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Size</th>
                            <th scope="col">Color</th>
                            <th scope="col">QtyxPrice</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_details as $row)
                            <tr>
                                <th scope="row">{{ $row->product_name }}</th>
                                <td>{{ $row->product_size }}</td>
                                <td>{{ $row->product_color }} </td>
                                <td>{{ $row->product_quantity }} x {{ $setting->currency }} {{ $row->product_price }}
                                </td>
                                <td>{{ $setting->currency }}{{ $row->subtotal }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
        <div class="modal-footer">
            <button type="Submit" class="btn btn-primary"><span class="loader d-none">..Loading</span> Update</button>
        </div>
</form>
<script>
    $("#view_edit_form").submit(function(e) {
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
                $("#view_edit_form")[0].reset();
                $("#viewOrderModal").modal("hide");
                $("button[type=submit]").attr('disabled', false);
                table.ajax.reload();
            },
            error: function(error) {
                $("button[type=submit]").attr('disabled', false);
            }
        });
    });
</script>
