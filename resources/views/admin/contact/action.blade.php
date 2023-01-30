<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editContactModal"
    onclick="getContactById(`{{ $row->id }}`)">
    <i class="fa fa-edit"></i>
</a>
<a href="#" onclick="deleteContactById(`{{ $row->id }}`)" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i>
</a>
