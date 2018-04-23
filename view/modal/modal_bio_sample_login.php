<!-- Modal -->
<div class="modal fade" id="modal_bio_sample_login" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-envelope-square'></i>&nbsp; Biodegradation Sample Login</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <form class="form-horizontal" id="form_mbsl">
                    <div class="form-group mbsl_hideFill">      
                        <label class="col-md-4 control-label">Certificate No.</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control mbsl_viewOnly" name="mbsl_bdtRep_no2" id="mbsl_bdtRep_no2" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Customer Name</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control select2" name="mbsl_client_id" id="mbsl_client_id" style="width:100%"></select>
                        </div> 
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Sample Description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_sampleDesc" id="mbsl_bdtRep_sampleDesc" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Number of Sample</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_totalSample" id="mbsl_bdtRep_totalSample" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Name of Substance</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_substance" id="mbsl_bdtRep_substance" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Empirical Formula</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_formula" id="mbsl_bdtRep_formula" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Purity / Relative Proportion</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_component" id="mbsl_bdtRep_component" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Physical Characteristics</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_physical" id="mbsl_bdtRep_physical" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Solubility</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_solubility" id="mbsl_bdtRep_solubility" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Storage Condition</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mbsl_bdtRep_condition" id="mbsl_bdtRep_condition" />
                        </div>   
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> MSDS</label>
                        <div class="col-md-8">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mbsl_bdtRep_msds" value="1">
                                <span>Available</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mbsl_bdtRep_msds" value="0">
                                <span>Not Available</span>  
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Remarks</label>
                        <div class="col-md-8">   
                            <textarea class="form-control" name="mbsl_bdtRep_remark" id="mbsl_bdtRep_remark" rows="4"></textarea>
                        </div>
                    </div>  
                    <input type="hidden" name="funct" id="mbsl_funct" />
                    <input type="hidden" name="mbsl_bdtRep_no" id="mbsl_bdtRep_no" />
                </form>
            </div>            
            <div class="modal-footer padding-10">
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-success mbsl_editView" id="mbsl_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>