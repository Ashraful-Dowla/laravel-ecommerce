<a href="#" onclick="productStatus('{{ $status_type }}','{{ $row->id }}', '{{ $row[$status_type] }}')">
    <i class="fa fa-{{ $row[$status_type] == 0 ? 'thumbs-up text-success' : 'thumbs-down text-danger' }}">
        <span
            class="badge badge-{{ $row[$status_type] ? 'success' : 'danger' }}">{{ $row[$status_type] ? 'active' : 'inactive' }}</span>
    </i>
</a>
