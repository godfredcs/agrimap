@extends('layouts.app')

@section('title')
	Settings
@endsection

@section('page_title')
	Settings
@endsection

@section('content') 
	<div class="row">
	    <div class="col-sm-12 col-md-12 col-lg-12">
	        <div class="x_panel">
				<div class="x_title">
					<div class="row">
					    <div class="col-lg-12 col-md-12 col-sm-12">
							<p class="undertext">Here you can add, update or delete the dosage forms and classifications of drugs</p> 
					    </div>
					</div>
				</div>

				<div class="x_content" id="settings-container">
					<div class="row">
						{{-- Dosage Forms --}}
						<div class="col-lg-6 col-md-6 col-sm-6">
					        <div class="x_panel">
								<div class="x_title">
									<div class="row">
									    <div class="col-lg-12 col-md-12 col-sm-12">
											<h2>Dosage Forms</h2>

											<button class="btn btn-primary pull-right add-item" data-toggle="modal" data-target="#item-modal" data-rel="dosage_forms"><i class="fa fa-plus"></i> Add New Dosage Form</button>
									    </div>
									</div>
								</div>

								<div class="x_content" id="dosage-forms-container">
									@include('settings.table', ['items' => $dosage_forms, 'rel' => 'dosage_forms'])
								</div>
							</div>
						</div>

						{{-- Classifications --}}
						<div class="col-lg-6 col-md-6 col-sm-6">
					        <div class="x_panel">
								<div class="x_title">
									<div class="row">
									    <div class="col-lg-12 col-md-12 col-sm-12">
											<h2>Classifications</h2> 
	
											<button class="btn btn-primary pull-right add-item" data-toggle="modal" data-target="#item-modal" data-rel="classifications"><i class="fa fa-plus"></i> Add New Classification</button>
									    </div>
									</div>
								</div>

								<div class="x_content" id="classifications-container">
									@include('settings.table', ['items' => $classifications, 'rel' => 'classifications'])
								</div>
							</div>
						</div>
					</div>
				</div>
	        </div>
	    </div>
	</div>

	@include('settings.modals')
@endsection

@section('scripts')
	<script src="{{ URL::asset('js/settings.js') }}"></script>
@endsection