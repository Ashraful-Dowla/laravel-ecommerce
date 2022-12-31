<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editPickupPointModal"
    onclick="getPickupPointById(`{{ $row->id }}`)">
    <i class="fa fa-edit"></i>
</a>
<a href="#" class="btn btn-danger btn-sm" onclick="deletePickupPointById(`{{ $row->id }}`)">
    <i class="fa fa-trash"></i>
</a>
