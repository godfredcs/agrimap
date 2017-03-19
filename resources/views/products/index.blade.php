@extends('layouts.app')

@section('title')
	Products
@endsection

@section('page_title')
	Products
@endsection

@section('content') 
	<div class="row">
	    <div class="col-sm-12 col-md-12 col-lg-12">
	        <div class="x_panel">
	             <div class="x_title">
	                 <div class="row">
	                     <div class="col-lg-12 col-md-12 col-sm-12">
	                         <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#add-product"><i class="fa fa-plus"></i> Add New Product</button>

	                         <p class="undertext">You can add, update and delete products</p>
	                     </div>
	                 </div>
	             </div>

	             <div class="x_content" id="products-container">
	                 @include('products.table')
	             </div>
	        </div>
	    </div>
	</div>

	@include('products.modals')
	@include('partials.loader')
@endsection

@section('scripts')
<script src="/js/products.js"></script>
@endsection