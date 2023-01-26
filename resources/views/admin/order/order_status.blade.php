@if ($order_status == 0)
    <span class="badge badge-danger">Order Pending</span>
@elseif($order_status == 1)
    <span class="badge badge-info">Order Recieved</span>
@elseif($order_status == 2)
    <span class="badge badge-primary">Order Shipped</span>
@elseif($order_status == 3)
    <span class="badge badge-success">Order Done</span>
@elseif($order_status == 4)
    <span class="badge badge-warning">Order Return</span>
@elseif($order_status == 5)
    <span class="badge badge-danger">Order Cancel</span>
@endif
