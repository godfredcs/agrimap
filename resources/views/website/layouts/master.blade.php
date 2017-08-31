<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WBFLS | @yield('title')</title>
	@include('website.partials.stylesheets')
</head>
<body>
	@include('website.partials.header')
	@yield('carousel')
	
	@yield('content')
	
	@yield('footer')	
	@include('website.partials.scripts')
</body>
</html>