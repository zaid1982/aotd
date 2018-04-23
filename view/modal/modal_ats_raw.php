<div class="modal fade" id="modal_ats_raw" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_marw">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; Analytical Test Result</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="well well-light">
                        <div class="form-group no-margin">
                            <label class="col-md-4 control-label"><strong>Sample Code</strong></label>
                            <div class="col-md-8 control-label text-align-left">
                                <span id="lmarw_atsLab_code"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-4 control-label"><strong>Analysis</strong></label>
                            <div class="col-md-8 control-label text-align-left">
                                <span id="lmarw_atsTest_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-4 control-label"><strong>Component Name</strong></label>
                            <div class="col-md-8 control-label text-align-left">
                                <span id="lmarw_atsField_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-4 control-label"><strong>Formula</strong></label>
                            <div class="col-md-8 control-label text-align-left">
                                <span id="lmarw_formula"><img src="" alt=" " id="marw_formula" style="max-width:100%"></span> 
                            </div>
                        </div>
                    </div>     
                    <?php for($var=0; $var<10; $var++) { ?>
                    <div class="form-group marw_div_var" id="marw_div_var_<?php echo $var;?>">
                        <label class="col-md-5 control-label"><font color="red">*</font> <span id="lmarw_atsVar_name_<?php echo $var;?>"></span></label>
                        <div class="col-md-7">  
                            <div class="input-group">
                                <input type="text" name="marw_atsRaw_value_<?php echo $var;?>" id="marw_atsRaw_value_<?php echo $var;?>" class="form-control" />
                                <span class="input-group-addon" id="lmarw_atsVar_unit_<?php echo $var;?>"></span>     
                            </div>
                            <input type="hidden" name="marw_atsRaw_id_<?php echo $var;?>" id="marw_atsRaw_id_<?php echo $var;?>" />
                        </div>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label class="col-md-5 control-label">Saved Result</label>
                        <div class="col-md-7">   
                            <input type="text" name="marw_atsRes_res" id="marw_atsRes_res" class="form-control" disabled />
                        </div>
                    </div>  
                </div>
                <input type="hidden" name="marw_atsLab_id" id="marw_atsLab_id" />
                <input type="hidden" name="marw_atsCert_id" id="marw_atsCert_id" />
                <input type="hidden" name="marw_atsField_id" id="marw_atsField_id" />
                <input type="hidden" name="marw_atsRes_id" id="marw_atsRes_id" />
                <input type="hidden" name="marw_atsFormula_id" id="marw_atsFormula_id" />
                <input type="hidden" name="funct" id="marw_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="marw_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>