@extends('website.layouts.master')

@section('title')
	Welcome
@endsection

@section('carousel')
	@include('website.partials.carousel')
@endsection

@section('content')
	<section id="services">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="text-center">Below is a list of the ten regions in Ghana. Click on any of the regions in order to view the districts and the crops associated with each district in the region. Crop varieties grown in various districts in a region are similar and almost the same crops are grown in all the districts of the selected region.</p>
				</div>
			</div>
		</div>
	</section>

	<section id="name">
		<div class="container">
			<center><h2>WEB-BASED FARM LOCATOR SYSTEM</h2></center>
			<hr>		

	        <?php $curr = 0; ?>

			@for($i = 1; $i <= 4; $i++)
			    <div class="row">
			        @for($j = 1; $j <= 3; $j++)
			            @if($curr < count($regions))
			                <div class="col-md-4 text-center">
			                    <h4><a href="show_region/{{ $regions[$curr]->id }}">{{ $regions[$curr]->name }}</a></h4>
			                    <p>{{ $regions[$curr]->name }} has a variety of crops that are grown within it. Click on this region to know the crops grown there.</p>
			                </div>
			            @endif
			        <?php $curr++; ?>
			        @endfor
			    </div>
			    <div class="gap"></div>
			@endfor
		</div>
	</section>

	<section id="products">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="text-center">Web-based farm locator system makes it easier to locate and collect farm crops and data about them in each region or district. Exploring the variety of crops and the regions or districts that produce them is also made quite easy.</p>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('footer')
	@include('website.partials.footer')
@endsection