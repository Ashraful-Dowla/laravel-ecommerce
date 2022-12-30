<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCouponModal"
    onclick="getCouponById(`{{ $row->id }}`)">
    <i class="fa fa-edit"></i>
</a>
<a href="#" class="btn btn-danger btn-sm" onclick="deleteCouponById(`{{ $row->id }}`)">
    <i class="fa fa-trash"></i>
</a>
