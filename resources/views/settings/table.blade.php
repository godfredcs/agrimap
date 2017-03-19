<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th width="95px">Actions</th>
        </tr>
    </thead>

    <tbody data-rel="{{ $rel }}">
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>
                	<button class="btn btn-info btn-sm update-item" data-toggle="modal" data-target="#item-modal" data-id="{{ $item->id }}"><i class="fa fa-pencil"></i></button>
                	<button class="btn btn-danger btn-sm delete-item" data-id="{{ $item->id }}"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
 </table>