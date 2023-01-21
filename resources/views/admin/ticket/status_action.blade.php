@php
    $status_name_list = ['Pending', 'Replied', 'Close'];
    $status_badge = ['danger', 'muted', 'warning'];
@endphp

<a href="#" onclick="ticketStatus('{{ $row->id }}')">
    <i class="fa fa-{{ $row->status == 0 ? 'thumbs-up text-success' : 'thumbs-down text-danger' }}">
        <span class="badge badge-{{ $status_badge[$row->status] }}">
            {{ $status_name_list[$row->status] }}
        </span>
    </i>
</a>
