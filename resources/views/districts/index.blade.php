@extends('layouts.app')

@section('title')
	Districts
@endsection

@section('page_title')
	Districts
@endsection

@section('content') 
	<div class="col-sm-12 col-md-12 col-lg-12">
        <div class="x_panel">
             <div class="x_title">
                 <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12">
            
                         <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#add-district"><i class="fa fa-plus"></i> Add New District</button>

                         <p class="undertext">You can add,update and remove districts here</p>
                     </div>
                 </div>
             </div>

             <div class="x_content"> 
                <div class="row margin-bottom">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <form method="POST" action="/districts/filter" class="districts-filter-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-5">
                                    <div class="select2-wrapper">
                                        <select name="region_id" class="form-control select2 select2-hidden-accessible" id="district-regions-filter-select">
                                            <option value="0">All Regions</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="select2-wrapper">
                                        <select name="crop_id" class="form-control select2 select2-hidden-accessible" id="district-crops-filter-select">
                                            <option value="0">All Crops</option>
                                            @foreach($crops as $crop)
                                                <option value="{{ $crop->id }}">{{ $crop->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success input-custom-height"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 col-lg-5 col-sm-12">
                        <form method="POST" action="/districts/search" class="districts-filter-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control input-custom-height" placeholder="Search For District" name="name">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success input-custom-height"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="districts-container">
                     @include('districts.table')
                </div>
             </div>
        </div>
    </div>
 @include('districts.modals')
@endsection

@section('scripts')
<script src="/js/districts.js"></script>
@endsection