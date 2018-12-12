<!-- Modal -->
<div class="modal fade" id="modal_lab_edit" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mle">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-flask'></i>&nbsp; Lab Information</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-4 control-label">Lab ID</label>
                        <div class="col-md-8">   
                            <input type="text" id="mle_lab_ids" class="form-control mle_viewOnly"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Laboratory Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mle_lab_name" id="mle_lab_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Laboratory Description</label>
                        <div class="col-md-8">   
                            <input type="text" name="mle_lab_desc" id="mle_lab_desc" class="form-control"/>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Head of Unit</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control select2" name="mle_lab_head_unit" id="mle_lab_head_unit" style="width:100%"></select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Quality Manager</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control select2" name="mle_lab_quality_manager" id="mle_lab_quality_manager" style="width:100%"></select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Technical Manager I</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control select2" name="mle_lab_technical_manager" id="mle_lab_technical_manager" style="width:100%"></select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Technical Manager II</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control select2" name="mle_lab_technical_manager2" id="mle_lab_technical_manager2" style="width:100%"></select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Research Officer</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control select2" name="mle_lab_research_officer" id="mle_lab_research_officer" style="width:100%"></select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Laboratory Supervisor</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control select2" name="mle_lab_supervisor" id="mle_lab_supervisor" style="width:100%"></select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Accountant</label>
                        <div class="col-md-8 selectContainer">   
                            <select class="form-control select2" name="mle_lab_accountant" id="mle_lab_accountant" style="width:100%"></select>
                        </div>
                    </div>  
                </div>
                <input type="hidden" name="mle_lab_id" id="mle_lab_id" />
                <input type="hidden" name="funct" id="mle_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mle_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>