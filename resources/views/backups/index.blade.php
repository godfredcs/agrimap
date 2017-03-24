@extends('layouts.app')

@section('title')
	Backups
@endsection

@section('page_title')
	Backups
@endsection

@section('content') 
	<div class="col-sm-12 col-md-12 col-lg-12">
        <div class="x_panel">
             <div class="x_title">
                 <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12">
            
                         <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#restore-modal"><i class="fa fa-upload"></i> Restore Database</button>

                         <p class="undertext">You can make database backups and recoveries here</p>
                        
                     </div>
                 </div>
             </div>

             <div class="x_content">
                 <div class="row">
                     <div class="col-md-4 col-md-offset-4">
                         <form method="POST" action="/backup" id="backups-form">
                             {{ csrf_field() }}
                             <div class="form-group">
                                <label>Select Destination Drive</label>

                                <div class="select2-wrapper">
                                    <select name="drive" class="form-control select2 select2-hidden-accessible category-filter" id="category-filter">
                                        @foreach($drives as $drive)
                                            <option value="{{ $drive }}">{{ $drive.':\\' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <p class="form-info">Backup file will be saved in the 'agrimap_backups' folder on the selected drive</p>
                            </div>

                            <div class="form-group">
                                <input  type    = "submit"
                                        class   = "btn btn-success form-control" 
                                        value   = "BACK UP DATABASE" id="backup-form-button">
                            </div>
                         </form>
                     </div>
                 </div>
             </div>
        </div>
    </div>
    @include('backups.modals')
@endsection

@section('scripts')
<script src="/js/backups.js"></script>
@endsection