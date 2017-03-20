@extends('layouts.app')

@section('title')
	Regions
@endsection

@section('page_title')
	Regions
@endsection

@section('content')
    <div class="row"> 
    	<div class="col-sm-12 col-md-12 col-lg-12">
            <div class="x_panel">
                 <div class="x_title">
                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                
                             <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#add-region"><i class="fa fa-plus"></i> Add New Region</button>

                             <p class="undertext">You can add, update and remove regions from the database</p>
                            
                         </div>
                     </div>
                 </div>

                 <div class="x_content" id="order-items-container">
                     @include('regions.table')
                 </div>
            </div>
        </div>
    </div>
 @include('regions.modals')
@endsection

@section('scripts')
<script src="/js/regions.js"></script>
@endsection