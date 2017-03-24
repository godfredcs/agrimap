@if(count($crops))
<table class="table table-bordered">
    <tr>
        <th style="width: 45%">Crop</th>
        <th style="width: 44%">Grown In</th>
        <th>Actions</th>
    </tr>

    @foreach($crops as $crop)
        <tr>
            <td>{{ $crop->name }}</td>
            <td>{{ count($crop->districts) }} districts</td>
            <td>
             	<button class="btn btn-info btn-sm update-crop" data-id="{{ $crop->id }}"  title="Update Crop"><i class="fa fa-pencil"></i></button>
             	<button class="btn btn-danger btn-sm delete-crop" data-id="{{ $crop->id }}"  title="Delete Crop"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
    @endforeach
</table>

<div id="pagination">
    {!! 
        $crops->render() 
    !!}
</div>
@else
    <div class="well">
        <p>No crops added yet</p>
    </div>
@endif