<!-- Modal -->
<div class="modal fade" id="modal_eff_sample_login" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-envelope-square'></i>&nbsp; Efficacy Sample Login</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <form class="form-horizontal" id="form_mfsl">
                    <div class="form-group mfsl_hideFill">      
                        <label class="col-md-4 control-label">Certificate No.</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control mfsl_viewOnly" name="mfsl_effRep_no2" id="mfsl_effRep_no2" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Customer Name</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control select2" name="mfsl_client_id" id="mfsl_client_id" style="width:100%"></select>
                        </div> 
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Number of Sample</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mfsl_effRep_totalSample" id="mfsl_effRep_totalSample" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Physical Form</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mfsl_effRep_physical" id="mfsl_effRep_physical" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Quantity</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mfsl_effRep_quantity" id="mfsl_effRep_quantity" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Colour</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mfsl_effRep_color" id="mfsl_effRep_color" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Other</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mfsl_effRep_other" id="mfsl_effRep_other" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Test Method</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control select2" name="mfsl_effTest_id" id="mfsl_effTest_id" style="width:100%"></select>
                        </div>    
                    </div>
                    <input type="hidden" name="funct" id="mfsl_funct" />
                    <input type="hidden" name="mfsl_effRep_no" id="mfsl_effRep_no" />
                </form>
            </div>            
            <div class="modal-footer padding-10">
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-success mfsl_editView" id="mfsl_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>