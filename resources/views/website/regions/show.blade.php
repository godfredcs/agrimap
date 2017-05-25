@extends('website.layouts.master')

@section('title')
	Regions
@endsection

@section('content')
	<section class="content">
		<div class="gap"></div>
		<div class="gap"></div>
		<div class="container">
			<ul>
			
				<li>{{ $region }}</li>
				
			</ul>
		</div>
	</section>
@endsection