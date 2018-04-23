<!-- Modal -->
<div class="modal fade" id="modal_cust_category" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mcc">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; Customer Category</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Category Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcc_clientGrp_name" id="mcc_clientGrp_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Customer Type</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control" name="mcc_clientType_id" id="mcc_clientType_id" style="width:100%">
                                <option value="" selected></option>
                                <option value="INT">Internal</option>
                                <option value="EXT">External</option>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Category Description</label>
                        <div class="col-md-8">   
                            <textarea class="form-control" name="mcc_clientGrp_desc" id="mcc_clientGrp_desc" rows="4"></textarea>
                        </div>
                    </div>  
                </div>
                <input type="hidden" name="mcc_clientGrp_id" id="mcc_clientGrp_id" />
                <input type="hidden" name="funct" id="mcc_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mcc_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>