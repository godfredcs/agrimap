	<div id="students-table">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Email</th>

					<!-- The role filter -->
					<th>
						<select class="form-control filter" onchange="Users.FilterTable(); return false;" name="role">
							<option value="">Role</option> 

							@foreach ($roles as $role)
								<option value="{{ $role->id }}" {{ $role->id == $role_id ? 'selected' : '' }}>{{ $role->name }}</option>
							@endforeach
						</select>
					</th>

					<!-- The group filter -->
					<th>
						<select class="form-control filter" onchange="Users.FilterTable(); return false;" name="status">
							<option value="">Status</option> 

							@foreach ($statuses as $status)
								<option value="{{ $status->id }}" {{ $status->id == $status_id ? 'selected' : '' }}>{{ $status->name }}</option>
							@endforeach
						</select>
					</th>

					<th>Joined</th>
					<th style="width: 95px">Actions</th>
				</tr>
			</thead>

			@if (!$users->isEmpty())
				<tbody>
					@foreach($users as $user)
						<tr class="{{ $user->status->name == 'Inactive' ? 'danger' : '' }}">
							<td>{{ $user->username }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email ? $user->email : 'N/A' }}</td>
							<td>{{ $user->role->name }}</td>
							<td>{{ $user->status->name }}</td>
							<td>{{ $user->created_at->toDayDateTimeString() }}</td>

							<td>
	                         	<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit" data-id="{{ $user->id }}" onclick="Users.InitiateUpdate(this); return false;"><i class="fa fa-pencil"></i></button>

	                         	@if ($user->status->name != 'Inactive')
	                         		<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" data-id="{{ $user->id }}" onclick="Users.InitiateDelete(this); return false;"><i class="fa fa-trash-o"></i></button>
	                         	@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			@endif
		</table>
	</div>

@if (!$users->isEmpty())
	<div id="pagination">
		{!! 
			$users->appends([
			'role'   => $role_id,
			'status' =>  $status_id,
			])->render() 
		!!}
	</div>
@else
	<h2 class="empty">There are no users or such users in the database.</h2>
@endif
