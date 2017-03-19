{{-- Add Modal --}}
<div class="modal fade custom-modal" id="item-modal">
	<div class="modal-dialog">
		<form role="form" class="modal-content" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4 id="item-modal-header"></h4>
            </div>
            
			<div class="modal-body">
	            <div class="error-container">
	                @include('partials.modal_errors')
	            </div>

				<div class="row">
					<div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
						{!! csrf_field() !!}
						<input type="hidden" name="_method" value="PUT" disabled="disabled">

						<!-- This is the name field -->
						<div class="form-group">
							<label for="name">Name</label>
							<input  type         = "text"
									class        = "form-control" 
									id           = "name" 
									name         = "name"
									placeholder  = "Name"
									autocomplete = "off">
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<button type="submit" id="item-modal-submit-button" class="btn btn-primary btn-block"></button>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6">
						<button type="button" class=" btn btn-default btn-block" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>