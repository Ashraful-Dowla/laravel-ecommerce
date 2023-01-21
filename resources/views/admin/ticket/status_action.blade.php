@php
    $status_name_list = ['Pending', 'Replied', 'Closed'];
    $status_badge = ['warning', 'success', 'danger'];
@endphp

<span class="badge badge-{{ $status_badge[$row->status] }}">
    {{ $status_name_list[$row->status] }}
</span>
