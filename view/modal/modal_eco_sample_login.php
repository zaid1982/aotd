<!-- Modal -->
<div class="modal fade" id="modal_eco_sample_login" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-envelope-square'></i>&nbsp; Ecotoxicity Sample Login</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <form class="form-horizontal" id="form_mcsl">
                    <div class="form-group mcsl_hideFill">      
                        <label class="col-md-4 control-label">Certificate No.</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control mcsl_viewOnly" name="mcsl_ectRep_no2" id="mcsl_ectRep_no2" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Customer Name</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control select2" name="mcsl_client_id" id="mcsl_client_id" style="width:100%"></select>
                        </div> 
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Sample Description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_sampleDesc" id="mcsl_ectRep_sampleDesc" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Number of Sample</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_totalSample" id="mcsl_ectRep_totalSample" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Name of Substance</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_substance" id="mcsl_ectRep_substance" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Empirical Formula</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_formula" id="mcsl_ectRep_formula" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Purity / Relative Proportion</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_component" id="mcsl_ectRep_component" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Physical Characteristics</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_physical" id="mcsl_ectRep_physical" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Solubility</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_solubility" id="mcsl_ectRep_solubility" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Storage Condition</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mcsl_ectRep_condition" id="mcsl_ectRep_condition" />
                        </div>   
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> MSDS</label>
                        <div class="col-md-8">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mcsl_ectRep_msds" value="1">
                                <span>Available</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mcsl_ectRep_msds" value="0">
                                <span>Not Available</span>  
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Remarks</label>
                        <div class="col-md-8">   
                            <textarea class="form-control" name="mcsl_ectRep_remark" id="mcsl_ectRep_remark" rows="4"></textarea>
                        </div>
                    </div>  
                    <input type="hidden" name="funct" id="mcsl_funct" />
                    <input type="hidden" name="mcsl_ectRep_no" id="mcsl_ectRep_no" />
                </form>
            </div>            
            <div class="modal-footer padding-10">
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-success mcsl_editView" id="mcsl_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>