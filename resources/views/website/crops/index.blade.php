@extends('website.layouts.master')

@section('title')
	Crops
@endsection

@section('content')
	<section class="content">
		<div class="gap"></div>
		<div class="gap"></div>
		<div class="container">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Crops</th>
						<th>Districts</th>
					</tr>
				</thead>
				<tbody>
					@foreach($crops as $crop)
						<tr>
							<td>{{ $crop->name }}</td>
							<td>
								@foreach($crop->districts as $district)
									{{ $district->name }} ({{ $district->region->name }}) <br>
								@endforeach
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $crops->links() }}
		</div>
	</section>
@endsection

