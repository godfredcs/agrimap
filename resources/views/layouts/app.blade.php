<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Styles -->
		@include('layouts.styles')
		@yield('styles')

		<title>@yield('title') | Ezi Pharmacy</title>
	</head>

	<?php
		$body_class = '';

		if (Request::segment(1) == 'login') {
			$body_class = 'login-page';
		} else if (Request::segment(1) == 'activate') {
			$body_class = 'activation-page';
		}
	?>

	<body class="nav-md {{ $body_class }}"> 
		<div class="container body">
			<div class="main_container">
				@if (Auth::check())
					{{-- Sidebar --}}
					<div class="col-lg-3 col-md-3 col-sm-3 left_col admin-sidebar">
						@include('layouts.sidebar')
					</div>

					{{-- Top Navigation --}}
					<div class="top_nav">
						@include('layouts.nav')
					</div>

					<!-- page content -->
					<div class="right_col" role="main">
						<div class="page-title">
							<div class="title_left">
								<h1 class="animated fadeInDown">@yield('page_title')</h1>
							</div>
						</div>

						<div class="clearfix"></div>

						<div id="content">
							@yield('content')
						</div>
					</div>

					<footer>
						<div class="pull-right">
							<p>&copy; {{ date('Y') }} - Ezipharmacy</p>
						</div>

						<div class="clearfix"></div>
					</footer>
				@else
					@yield('content')
				@endif
			</div>
		</div>
		
         @include('partials.confirm_dialog')
         
		{{-- Scripts --}}
		@include('layouts.scripts')
		@yield('scripts')
	</body>
</html>
