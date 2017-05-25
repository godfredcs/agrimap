@extends('website.layouts.master')

@section('title')
	Districts
@endsection

@section('content')
	<section class="section">
		<div class="container">
			<div class="gap"></div>
			<div class="gap"></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="bg-success">Districts</th>
						<th class="bg-success">Crops</th>
					</tr>
				</thead>
				<tbody>
					@foreach($districts as $district)
						<tr>
							<td>{{ $district->name }}</td>
							<td>
								@foreach($district->crops as $crop)
									{{ $crop->name .", " }}
								@endforeach
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $districts->links() }}
		</div>
	</section>
@endsection