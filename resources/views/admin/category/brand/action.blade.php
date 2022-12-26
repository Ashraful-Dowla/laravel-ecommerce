<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editBrandModal"
    onclick="getBrandById(`{{ $row->id }}`)">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route('brand.delete', $row->id) }}" class="btn btn-danger btn-sm" id="delete">
    <i class="fa fa-trash"></i>
</a>
