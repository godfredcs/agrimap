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
				@foreach($regions as $region)
					<li>{{ $region->name }}</li>
				@endforeach
			</ul>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Regions</th>
						<th>Crops</th>
					</tr>
				</thead>
				<tbody>
						@foreach($regions as $region)
					<tr>
							<td>{{ $region->name }}</td>
							<td>
								@foreach($regions->crops as $crop)
									{{ $crop->name }}, 
								@endforeach
							</td>
					</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endsection