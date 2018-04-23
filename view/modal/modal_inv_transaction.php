<div class="modal fade" id="modal_inv_transaction" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mvt">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; Inventory Transaction</h4>
                </div>
                <div class="modal-body modal-fixHeight"> 
                    <div class="form-group" id="mvt_div_transaction_no">
                        <label class="col-md-4 control-label">Transaction No.</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvt_transaction_no" id="mvt_transaction_no" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Item Name</label>
                        <div class="col-md-8">   
                            <select class="form-control select2" name="mvt_inventory_id" id="mvt_inventory_id" style="width:100%"></select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-4 control-label">Recorded By</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvt_profile_name" id="mvt_profile_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group" id="mvt_div_date_trans">
                        <label class="col-md-4 control-label">Transaction Time</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvt_date_trans" id="mvt_date_trans" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Total Stock</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvt_total_stock" id="mvt_total_stock" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Transaction Type</label>
                        <div class="col-md-8">   
                            <select class="form-control" name="mvt_transaction_type" id="mvt_transaction_type" style="width:100%">
                                <option value=""></option>
                                <option value="1">Purchase Stock</option>
                                <option value="2">Consume Item</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group" id="mvt_div_stock_purchased">
                        <label class="col-md-4 control-label"><font color="red">*</font> Stock Purchased</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvt_stock_purchased" id="mvt_stock_purchased" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group" id="mvt_div_quantity_taken">
                        <label class="col-md-4 control-label"><font color="red">*</font> Quantity Taken</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvt_quantity_taken" id="mvt_quantity_taken" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Balance</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvt_balance" id="mvt_balance" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Notes</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="mvt_notes" id="mvt_notes" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="mvt_transaction_id" id="mvt_transaction_id" />
                <input type="hidden" name="mvt_inventory_ids" id="mvt_inventory_ids" />
                <input type="hidden" name="funct" id="mvt_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mvt_btn_save">
                                <span class="btn-label"><i class="fa fa-mail-forward"></i></span>Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>   