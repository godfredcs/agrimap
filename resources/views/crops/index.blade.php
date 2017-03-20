@extends('layouts.app')

@section('title')
	Crops
@endsection

@section('page_title')
	Crops
@endsection

@section('content') 
	<div class="col-sm-12 col-md-12 col-lg-12">
        <div class="x_panel">
             <div class="x_title">
                 <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12">
            
                         <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#add-crop"><i class="fa fa-plus"></i> Add New Crop</button>

                         <p class="undertext">You can add, update and remove crops from the database</p>
                        
                     </div>
                 </div>
             </div>

             <div class="x_content">
                <div id="crops-container">
                     @include('crops.table')
                </div>
             </div>
        </div>
    </div>
 @include('crops.modals')
@endsection

@section('scripts')
<script src="/js/crops.js"></script>
@endsection