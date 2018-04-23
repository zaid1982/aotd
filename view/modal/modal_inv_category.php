<!-- Modal -->
<div class="modal fade" id="modal_inv_category" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mvc">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; Inventory Category</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Category Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mvc_inventory_type" id="mvc_inventory_type" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Status</label>
                        <div class="col-md-8 selectContainer">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mvc_inventory_type_status" value="1">
                                <span>Active</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mvc_inventory_type_status" value="0">
                                <span>Inactive</span>  
                            </label>
                        </div>
                    </div>  
                </div>
                <input type="hidden" name="mvc_inventory_type_id" id="mvc_inventory_type_id" />
                <input type="hidden" name="funct" id="mvc_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mvc_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>