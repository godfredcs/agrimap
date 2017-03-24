@if(count($regions))
<table class="table table-bordered">
    <tr>
        <th style="width: 45%">Regions</th>
        <th style="width: 44%">Districts Added</th>
        <th>Actions</th>
    </tr>

    @foreach($regions as $region)
        <tr>
            <td>{{ $region->name }}</td>
            <td>{{ count($region->districts) }}</td>
            <td>
             	<button class="btn btn-info btn-sm update-region" data-id="{{ $region->id }}" title="Update Region"><i class="fa fa-pencil"></i></button>
             	<button class="btn btn-danger btn-sm delete-region" data-id="{{ $region->id }}" title="Delete Region"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
    @endforeach
</table>
@else
    <div class="well">
        <p>No regions added yet</p>
    </div>
@endif