@extends('layouts.app')

@section('title')
	Orders
@endsection

@section('page_title')
	Orders
@endsection

@section('content') 
	<div class="row">
	    <div class="col-sm-12 col-md-12 col-lg-12">
	        <div class="x_panel">
	             <div class="x_title">
	                 <div class="row">
	                     <div class="col-lg-12 col-md-12 col-sm-12">
	                         @if(Auth::user()->isPharmacist())
	                         <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#add-order"><i class="fa fa-cart-plus"></i> Start New Order</button>

	                         <p class="undertext">You can create, update and delete orders</p>

	                         @elseif(Auth::user()->isCashier())
	                         <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#add-sale" id="start-sale"><i class="fa fa-shopping-cart"></i> Start New Sale</button>

 	                         <p class="undertext">You can process orders and print receipts for sales</p>

	                         @else
	                         @endif
	                     </div>
	                 </div>
	             </div>

	             <div class="x_content" id="order-items-container">
	                 @include('orders.orders_table')
	             </div>
	        </div>
	    </div>
	</div>

	@include('orders.modals')
	@include('partials.view_product')
	@include('partials.loader')
@endsection

@section('scripts')
<script src="/js/orders.js"></script>
@endsection
