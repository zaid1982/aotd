<!-- Modal -->
<div class="modal fade" id="modal_phy_sample_login" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-envelope-square'></i>&nbsp; Physical Sample Login</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <form class="form-horizontal" id="form_mpsl">
                    <div class="form-group mpsl_hideFill">      
                        <label class="col-md-4 control-label">Certificate No.</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control mpsl_viewOnly" name="mpsl_phyRep_no2" id="mpsl_phyRep_no2" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Customer Name</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control select2" name="mpsl_client_id" id="mpsl_client_id" style="width:100%"></select>
                        </div> 
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label"><font color="red">*</font> Number of Sample</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mpsl_phyRep_totalSample" id="mpsl_phyRep_totalSample" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Physical Form</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mpsl_phyRep_physical" id="mpsl_phyRep_physical" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Quantity</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mpsl_phyRep_quantity" id="mpsl_phyRep_quantity" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Colour</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mpsl_phyRep_color" id="mpsl_phyRep_color" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Other</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="mpsl_phyRep_other" id="mpsl_phyRep_other" />
                        </div>   
                    </div>
                    <div class="form-group">      
                        <label class="col-md-4 control-label">Test Method</label>
                        <div class="col-md-8 selectContainer">
                            <select class="form-control select2" name="mpsl_phyTest_id" id="mpsl_phyTest_id" style="width:100%"></select>
                        </div>    
                    </div>
                    <input type="hidden" name="funct" id="mpsl_funct" />
                    <input type="hidden" name="mpsl_phyRep_no" id="mpsl_phyRep_no" />
                </form>
            </div>            
            <div class="modal-footer padding-10">
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-success mpsl_editView" id="mpsl_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>