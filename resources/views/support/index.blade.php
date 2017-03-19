@extends('layouts.app')

@section('title')
	Support
@endsection

@section('page_title')
	Support
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="x_panel">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
		                    <div class="x_title">
		                        <h2><i class="fa fa-envelope"></i> Contact Us </h2>
		                        <div class="clearfix"></div>
		                    </div>

		                    <div class="x_content">
		                        <form method="post" action="{!! URL::to('/support/send_message') !!}" data-parsley-validate="true">

		                            {!! csrf_field() !!}
		                            @include('errors.form_errors')

		                            <div class="form-group">
		                                <label class="control-label">Name:</label>
		                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
		                            </div>

		                            <div class="row">
		                                <div class="col-lg-6 col-md-6 col-sm-6">
		                                	<div class="form-group">
				                                <label class="control-label">Telephone:</label>
				                                <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required>
				                            </div>
		                                </div>

		                                <div class="col-lg-6 col-md-6 col-sm-6">
		                                	<div class="form-group">
				                                <label class="control-label">Email:</label>
				                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
				                            </div>
		                                </div>
		                            </div>

		                            <div class="form-group">
		                                <label class="control-label">Subject:</label>
		                                <input type="text" class="form-control" name="subject" value="{{ old('subject')}}" required>
		                            </div>

		                            <div class="form-group">
		                                <label for="control-label">Message:</label>
		                                <textarea class="form-control" rows="6" name="body" required>{{ old('body')}}</textarea>
		                            </div>

		                            <div class="row">
		                                <div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
				                            <div class="form-group">
				                                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-send margin-right"></i> Send Message</button>
				                            </div>
				                        </div>
				                    </div>
		                        </form>
		                    </div>
		                </div>
	                </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="x_panel">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
		                    <div class="x_title">
		                        <h2><i class="fa fa-gear"></i> Our Contact Details</h2>
		                        <div class="clearfix"></div>
		                    </div>

		                    <div class="x_content contact-info-sidebar">
		                        <p><i class="fa fa-envelope-o"></i> <a href="mailto:info@ezipharmacy.com">info@ezipharmacy.com</a></p>
		                        <p><i class="fa fa-envelope-o"></i> <a href="mailto:support@ezipharmacy.com">support@ezipharmacy.com</a></p>

								<br>

		                        <p><i class="fa fa-phone"></i> +233 54 204 3151</p>
		                        <p><i class="fa fa-phone"></i> +233 54 079 2532</p>
		                    </div>
		                </div>
		            </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection