@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('page_title')

@endsection

@section('content') 
    <div class="col-md-12 col-lg-12 col-sm-12">
	    <div class="row tile_count">
	        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
	            <span class="count_top"><i class="fa fa-home"></i> Districts</span>
	            <div class="count">{{ count($districts) }}</div>
	        </div>

	        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
	            <span class="count_top"><i class="fa fa-pagelines"></i> Crops</span>
	            <div class="count">{{ count($crops) }}</div>
	        </div>

	        <div class="col-md-3 col-sm-5 col-xs-6 tile_stats_count">
	            <span class="count_top"><i class="fa fa-search"></i> Views This Week</span>
	            <div class="count">{{ '230' }}</div>
	        </div>

	        <div class="col-md-3 col-sm-5 col-xs-6 tile_stats_count">
	            <span class="count_top"><i class="fa fa-user"></i> Administrators</span>
	            <div class="count">{{ count($admins) }}</div>
	        </div>
	    </div> 
	</div>
@endsection

@section('scripts')
<script src="/js/dashboard.js"></script>
@endsection