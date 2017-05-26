@extends('website.layouts.master')

@section('title')
	Regions
@endsection

@section('content')
	<section class="content">
		<div class="gap"></div>
		<div class="gap"></div>
		<div class="container">
			<h2 class="text-center">{{ $region->name }}</h2>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Districts</th>
						<th>Crops</th>
					</tr>
				</thead>
				<tbody>
					@foreach($region->districts as $district)
						<tr>
							<td>{{ $district->name }}</td>
							<td>
								@foreach($district->crops as $crops)
									{{ $crops->name . ', '}}
								@endforeach
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endsection