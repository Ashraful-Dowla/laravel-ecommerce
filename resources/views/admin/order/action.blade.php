<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewOrderModal"
    onclick="getViewOrderById(`{{ $row->id }}`)">
    <i class="fa fa-eye"></i>
</a>
<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editOrderModal"
    onclick="getOrderById(`{{ $row->id }}`)">
    <i class="fa fa-edit"></i>
</a>
<a href="#" class="btn btn-danger btn-sm" onclick="deleteOrderById(`{{ $row->id }}`)">
    <i class="fa fa-trash"></i>
</a>
