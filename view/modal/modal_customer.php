<!-- Modal -->
<div class="modal fade" id="modal_customer" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mcu">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-suitcase'></i>&nbsp; Customer</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Customer Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcu_client_organisation" id="mcu_client_organisation" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Category Name</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control" name="mcu_clientGrp_id" id="mcu_clientGrp_id" style="width:100%"></select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Person In Charge</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcu_client_pic" id="mcu_client_pic" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Designation</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcu_client_designation" id="mcu_client_designation" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Address</label>
                        <div class="col-md-8">   
                            <textarea class="form-control" name="mcu_client_address" id="mcu_client_address" rows="4" style="overflow-x: hidden"></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">City</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcu_client_city" id="mcu_client_city" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">State</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcu_client_state" id="mcu_client_state" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Postcode</label>
                        <div class="col-md-3">   
                            <input type="text" name="mcu_client_postcode" id="mcu_client_postcode" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Country</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control" name="mcu_country_id" id="mcu_country_id" style="width:100%"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Phone No.</label>
                        <div class="col-md-5">   
                            <input type="text" name="mcu_client_phoneNo" id="mcu_client_phoneNo" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Fax No.</label>
                        <div class="col-md-5">   
                            <input type="text" name="mcu_client_faxNo" id="mcu_client_faxNo" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Email</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcu_client_email" id="mcu_client_email" class="form-control"/>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">URL</label>
                        <div class="col-md-8">   
                            <input type="text" name="mcu_client_url" id="mcu_client_url" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Blacklisted</label>
                        <div class="col-md-8">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mcu_client_black" value="1">
                                <span>Yes</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mcu_client_black" value="0" checked>
                                <span>No</span>  
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="mcu_client_id" id="mcu_client_id" />
                <input type="hidden" name="funct" id="mcu_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mcu_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>