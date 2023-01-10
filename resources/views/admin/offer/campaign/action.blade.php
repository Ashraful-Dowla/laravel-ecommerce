<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCampaignModal"
    onclick="getCampaignById(`{{ $row->id }}`)">
    <i class="fa fa-edit"></i>
</a>
<a href="#" class="btn btn-danger btn-sm"
    onclick="deleteCampaignById('{{ $row->id }}')">
    <i class="fa fa-trash"></i>
</a>
