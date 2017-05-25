@extends('website.layouts.master')

@section('title')
	Crops
@endsection

@section('content')
	<section class="content">
		<div class="gap"></div>
		<div class="gap"></div>
		<div class="container">
			<ul>
				@foreach($crops as $crop)
					<li>{{ $crop->name }}</li>
				@endforeach
			</ul>
		</div>
	</section>
@endsection
