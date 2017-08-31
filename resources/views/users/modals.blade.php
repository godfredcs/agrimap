{{-- Add Modal --}}
<div class="modal fade custom-modal" id="add">
	<div class="modal-dialog">
		<form role="form" class="modal-content" action="{{ URL::to('admin/users') }}" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4>Add New User</h4>
            </div>
            
			<div class="modal-body">
	            <div class="error-container">
	                @include('partials.modal_errors')
	            </div>

				<div class="row">
					<div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
						{!! csrf_field() !!}

						<!-- This is the name field -->
						<div class="form-group">
							<label for="username">Username</label>
							<input  type         = "text"
									class        = "form-control" 
									id           = "username" 
									name         = "username"
									placeholder  = "Username"
									autocomplete = "off">
						</div>

						<div class="form-group">
							<label for="name">Name</label>
							<input  type         = "text"
									class        = "form-control" 
									id           = "name" 
									name         = "name"
									placeholder  = "Full Name"
									autocomplete = "off">
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input  type         = "text"
									class        = "form-control" 
									id           = "email" 
									name         = "email"
									placeholder  = "Email"
									autocomplete = "off">
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input  type         = "password"
									class        = "form-control" 
									id           = "password" 
									name         = "password"
									placeholder  = "Password"
									autocomplete = "off">
						</div>

						<div class="form-group">
							<label for="password_confirmation">Confirm Password</label>
							<input  type         = "password"
									class        = "form-control" 
									id           = "password_confirmation" 
									name         = "password_confirmation"
									placeholder  = "Confirm Password"
									autocomplete = "off">
						</div>

						<div class="form-group">
							<label for="role_id">Role</label>

							<select name="role_id" class="form-control">
								<option value="">Select A Role</option>

								@foreach ($roles as $role)
									<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<button type="submit" id="add-user" class="btn btn-primary btn-block" onclick="Users.Add(this); return false;">Add User</button>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6">
						<button type="button" class=" btn btn-default btn-block" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

{{-- Edit Modal --}}
<div class="modal fade custom-modal" id="edit">
	<div class="modal-dialog">
		<form role="form" class="modal-content" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4>Update Account</h4>
            </div>
            
			<div class="modal-body">
	            <div class="error-container">
	                @include('partials.modal_errors')
	            </div>

				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="admin_edit" value="true">

				<!-- This is the name field -->
				<div class="form-group">
					<label for="username">Username</label>
					<input  type         = "text"
							class        = "form-control" 
							id           = "username" 
							name         = "username"
							placeholder  = "Username"
							disabled     ="disabled" 
							autocomplete = "off">
				</div>

				<div class="form-group">
					<label for="name">Name</label>
					<input  type         = "text"
							class        = "form-control" 
							id           = "name" 
							name         = "name"
							placeholder  = "Full Name"
							autocomplete = "off">
				</div>

				<div class="form-group password-fields">
					<label for="password">Password</label>
					<input  type         = "password"
							class        = "form-control" 
							id           = "password" 
							name         = "password"
							placeholder  = "Type here if you only need to reset previous password."
							autocomplete = "off">
				</div>

				<div class="form-group password-fields">
					<label for="password_confirmation">Confirm Password</label>
					<input  type         = "password"
							class        = "form-control" 
							id           = "password_confirmation" 
							name         = "password_confirmation"
							placeholder  = "Type here to confirm new password if set."
							autocomplete = "off">
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="form-group">
							<label for="role_id">Role</label>

							<select name="role_id" class="form-control">
								<option value="">Select A Role</option>

								@foreach ($roles as $role)
									<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<button type="submit" class="btn btn-info btn-block" onclick="Users.Update(this); return false;">Update Account</button>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6">
						<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

{{-- Delete Modal --}}
<div class="modal fade custom-modal" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<form role="form" method="post">
				<div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">
	                    <span aria-hidden="true">x</span>
	                </button>

	                <h4>Deactive Account</h4>
				</div>

				<div class="modal-body">
		            <div class="error-container">
		                @include('partials.modal_errors')
		            </div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							{!! csrf_field() !!}

							<input type="hidden" name="_method" value="DELETE">

							<p class="centered">Are you sure you want to remove this user?</p>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<button type="submit" class="btn btn-danger btn-block" onclick="Users.Delete(this); return false;">Yes</button>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">No</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
