<!-- Modal -->
<div class="modal fade" id="modal_ats_sample_login" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-envelope-square'></i>&nbsp; Analytical Sample Login</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <form class="form-horizontal" id="form_masl">
                    <div class="form-group masl_hideFill">      
                        <label class="col-md-4 control-label">Certificate No.</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control masl_viewOnly" name="masl_atsCert_no" id="masl_atsCert_no" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Customer Name</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control select2" name="masl_client_id" id="masl_client_id" style="width:100%"></select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Accredited</label>
                        <div class="col-md-8">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="masl_atsCert_accredited" value="1">
                                <span>Yes</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="masl_atsCert_accredited" value="0">
                                <span>No</span>  
                            </label>
                        </div>
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Number of Sample</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="masl_atsCert_totalSample" id="masl_atsCert_totalSample" />
                        </div>   
                    </div>
                    <div class="form-group masl_hideEdit">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Analysis</label>
                        <div class="col-md-8 selectContainer">
                            <select multiple class="form-control select2" name="masl_atsTest_id[]" id="masl_atsTest_id" style="width:100%"></select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Equipment</label>
                        <div class="col-md-8">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="masl_atsCert_equipment" value="1">
                                <span>Available</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="masl_atsCert_equipment" value="0">
                                <span>Not Available</span>  
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Chemical/Glassware</label>
                        <div class="col-md-8">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="masl_atsCert_chemical" value="1">
                                <span>Available</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="masl_atsCert_chemical" value="0">
                                <span>Not Available</span>  
                            </label>
                        </div>
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Type of Sample</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control" name="masl_atsType_id" id="masl_atsType_id"></select>
                        </div>  
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Condition of Sample</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control" name="masl_atsCondition_id" id="masl_atsCondition_id"></select>
                        </div>  
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Analyst</label>
                        <div class="col-md-8 selectContainer">
                            <select multiple class="form-control select2" name="masl_ats_analyst_user[]" id="masl_ats_analyst_user" style="width:100%"></select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Remarks</label>
                        <div class="col-md-8">   
                            <textarea class="form-control" name="masl_atsCert_remark" id="masl_atsCert_remark" rows="4"></textarea>
                        </div>
                    </div>  
                    <input type="hidden" name="funct" id="masl_funct" />
                    <input type="hidden" name="masl_atsCert_id" id="masl_atsCert_id" />
                </form>
            </div>            
            <div class="modal-footer padding-10">
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-success masl_editView" id="masl_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>