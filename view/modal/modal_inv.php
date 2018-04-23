<div class="modal fade" id="modal_inv" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mvi" method="post" enctype="multipart/form-data">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; Inventory Item</h4>
                </div>
                <div class="modal-body modal-fixHeight"> 
                    <div class="form-group mvi_div_picture">
                        <label class="col-md-4 control-label">&nbsp;</label>
                        <div class="col-md-8">   
                            <img src="" alt="Item picture" id="mvi_picture" style="max-width: 100%; max-height: 230px; padding:2px; border:thin solid lightgrey;" border="5">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Item Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_item_name" id="mvi_item_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Inventory Category</label>
                        <div class="col-md-8">   
                            <select class="form-control select2" name="mvi_inventory_type_id" id="mvi_inventory_type_id" style="width:100%"></select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-4 control-label">Location</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_location" id="mvi_location" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Classification</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_classification" id="mvi_classification" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Form</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_form" id="mvi_form" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Packing Size</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_packing_size" id="mvi_packing_size" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Formula</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_formulation" id="mvi_formulation" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">MSDS</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_msds" id="mvi_msds" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Balance</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_balance" id="mvi_balance" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Minimum Level</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvi_min_level" id="mvi_min_level" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Cost</label>
                        <div class="col-md-8">   
                            <div class="input-group">
                                <span class="input-group-addon">RM</span> 
                                <input type="text" name="mvi_price" id="mvi_price" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Image File</label>
                        <div class="col-md-8">   
                            <input type="file" name="mvi_img_file" id="mvi_img_file" class="form-control">
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Status</label>
                        <div class="col-md-8 selectContainer">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mvi_inventory_status" value="1">
                                <span>Active</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mvi_inventory_status" value="0">
                                <span>Inactive</span>  
                            </label>
                        </div>
                    </div>  
                </div>
                <input type="hidden" name="mvi_inventory_id" id="mvi_inventory_id" />
                <input type="hidden" name="funct" id="mvi_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mvi_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>