@extends('website.layouts.master')

@section('title')
	Regions
@endsection

@section('content')
	<section class="content">
		<div class="gap"></div>
		<div class="gap"></div>
		<div class="container">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Regions</th>
						<th>Districts</th>
					</tr>
				</thead>
				<tbody>
					@foreach($regions as $region)
						<tr>
							<td>{{ $region->name }}</td>
							<td>
								@foreach($region->districts as $district)
									{{ $district->name }} <br>
								@endforeach
							</td>							
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endsection