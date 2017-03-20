@if(count($regions))
<table class="table table-bordered">
    <tr>
        <th style="width: 800px">Regions</th>
        <th>Actions</th>
    </tr>

    @foreach($regions as $region)
        <tr>
            <td>{{ $region->name }}</td>
            <td>
             	<button class="btn btn-info btn-sm update-region" data-id="{{ $region->id }}"><i class="fa fa-pencil"></i></button>
             	<button class="btn btn-danger btn-sm delete-product" data-id="{{ $region->id }}"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
    @endforeach
</table>
@else
    <div class="well">
        <p>No regions added yet</p>
    </div>
@endif