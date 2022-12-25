<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editChildCategoryModal"
    onclick="getChildCategoryDataById(`{{ $row->id }}`)">
    <i class="fa fa-edit"></i>
</a>
<a href="{{ route('childcategory.delete', $row->id) }}" class="btn btn-danger btn-sm" id="delete">
    <i class="fa fa-trash"></i>
</a>
