@if(count($crops))
<table class="table table-bordered">
    <tr>
        <th style="width: 800px">Crop</th>
        <th>Actions</th>
    </tr>

    @foreach($crops as $crop)
        <tr>
            <td>{{ $crop->name }}</td>
            <td>
             	<button class="btn btn-info btn-sm update-crop" data-id="{{ $crop->id }}"><i class="fa fa-pencil"></i></button>
             	<button class="btn btn-danger btn-sm delete-product" data-id="{{ $crop->id }}"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
    @endforeach
</table>
@else
    <div class="well">
        <p>No crops added yet</p>
    </div>
@endif