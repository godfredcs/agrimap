@if(count($districts))
<table class="table table-bordered">
    <tr>
        <th style="width: 30%">District</th>
        <th style="width: 30%">Region</th>
        <th style="width: 30%">Crops</th>
        <th>Actions</th>
    </tr>

    @foreach($districts as $district)
        <tr>
            <td>{{ $district->name }}</td>
            <td>{{ $district->region->name }}</td>
            <td>
                @foreach($district->crops as $crop)
                    {{ $crop->name }}<br />
                @endforeach
            </td>
            <td>
             	<button class="btn btn-info btn-sm update-district" data-id="{{ $district->id }}" title="Update District"><i class="fa fa-pencil"></i></button>
             	<button class="btn btn-danger btn-sm delete-district" data-id="{{ $district->id }}" title="Delete District"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
    @endforeach
</table>

<div id="pagination">
    {!! 
        $districts->render() 
    !!}
</div>
@else
    <div class="well">
        <p>No districts added yet</p>
    </div>
@endif