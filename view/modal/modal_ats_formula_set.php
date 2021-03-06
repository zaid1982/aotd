<!-- Modal -->
<div class="modal fade" id="modal_ats_formula_set" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_masf">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; <span id="masf_title"></span></h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Analysis Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="masf_atsTest_name" id="masf_atsTest_name" class="form-control" disabled=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Component Name</label>
                        <div class="col-md-8" id="masf_div_component"></div>
                    </div>  
                </div>
                <input type="hidden" name="masf_atsCert_id" id="masf_atsCert_id" />
                <input type="hidden" name="masf_atsTest_id" id="masf_atsTest_id" />
                <input type="hidden" name="masf_atsField_id" id="masf_atsField_id" />
                <input type="hidden" name="masf_atsCertField_id" id="masf_atsCertField_id" />
                <input type="hidden" name="funct" id="masf_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="masf_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>