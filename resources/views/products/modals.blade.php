<!-- Pop-up for adding new products -->
<div class="modal custom-modal" id="add-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4>Add New Product</h4>
            </div>

            <form class="form" method="POST" action="/products" id="product-add-form">
            <div class="modal-body">
                <div id="products-add-errors-container">
                    @include('partials.modal_errors')
                </div>

                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Unit Price (GHS)</label>
                            <input type="text" name="unit_price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Dosage Information</label>
                            <textarea name="dosage_info" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label>Product Categories:</label>

                                    <div class="select2-wrapper">
                                        <select name="classifications[]" class="form-control select2 select2-hidden-accessible" multiple>
                                            @foreach($classifications as $classification)
                                            <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label>Dosage Forms:</label>

                                    <div class="select2-wrapper">
                                        <select name="dosage_forms[]" class="form-control select2 select2-hidden-accessible" multiple>
                                            @foreach($dosageForms as $dosageForm)
                                            <option value="{{ $dosageForm->id }}">{{ $dosageForm->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-offset-1 col-md-offset-1">
                            <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            
            </form>
        </div>
    </div>
</div>

<!-- Pop-up for restocking products -->
<div class="modal custom-modal" id="restock-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4>Restock Product</h4>
            </div>

            <form class="form-horizontal" method="POST" action="" id="restock-form">
            <div class="modal-body">
               {{ csrf_field() }}
               {{ method_field('PUT') }}
                <input type="hidden" name="restock" value="true">

                <div id="products-restock-errors-container">
                    @include('partials.modal_errors')
                </div>


                <div class="form-group">
                    <label class="control-label">
                         Product:
                    </label>
                    
                    <input type="text"  class="form-control" id="product-name-field" readonly="">
                </div>

                <div class="form-group">
                    <label class="control-label">
                         Currently In Stock:
                    </label>
                    
                    <input type="text" class="form-control" id="current-stock-field" readonly="">
                </div>

                <div class="form-group">
                    <label class="control-label">
                         Add New Quantity:
                    </label>
                    
                    <input type="text" name="in_stock" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary btn-block">Restock</button>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Pop-up for updating products -->
<div class="modal" id="edit-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                </button>

                <h4>Update Product</h4>
            </div>

            <form class="form" method="POST" action="" id="product-edit-form">
            <div class="modal-body">
                <div id="products-update-errors-container">
                    @include('partials.modal_errors')
                </div>

                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="" id="edit-name-field">
                        </div>

                        <div class="form-group">
                            <label>Unit Price (GHS)</label>
                            <input type="text" name="unit_price" class="form-control" value="" id="edit-price-field">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" id="edit-description-field"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Dosage Information</label>
                            <textarea name="dosage_info" class="form-control" rows="3" id="edit-dosage-field"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label>Product Categories:</label>

                                    <div class="select2-wrapper">
                                        <select name="classifications[]" class="form-control select2 select2-hidden-accessible" id="edit-classifications" multiple>
                                            @foreach($classifications as $classification)
                                            <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label>Dosage Forms:</label>

                                    <div class="select2-wrapper">
                                        <select name="dosage_forms[]" class="form-control select2 select2-hidden-accessible" id="edit-dosage-forms" multiple>
                                            @foreach($dosageForms as $dosageForm)
                                            <option value="{{ $dosageForm->id }}">{{ $dosageForm->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary btn-block">Update Product</button>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            
            </form>
        </div>
    </div>
</div>