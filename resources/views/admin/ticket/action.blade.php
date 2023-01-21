<a href="{{ route('ticket.view', $row->id) }}" class="btn btn-primary btn-sm">
    <i class="fa fa-eye"></i>
</a>
<a href="#" class="btn btn-danger btn-sm" onclick="deleteProductById('{{ $row->id }}')">
    <i class="fa fa-trash"></i>
</a>
