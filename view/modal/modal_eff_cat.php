<!-- Modal -->
<div class="modal fade" id="modal_eff_cat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mfc">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-tag'></i>&nbsp; Efficacy Lab Evaluation Group</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Evaluation Group Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mfc_effCat_name" id="mfc_effCat_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Filtered Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mfc_effCat_filter" id="mfc_effCat_filter" class="form-control"/>
                        </div>
                    </div> 
                </div>
                <input type="hidden" name="funct" id="mfc_funct" value="add_eff_cat" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mfc_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>