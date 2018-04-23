<!-- Modal -->
<div class="modal fade" id="modal_ats_lab_component" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-file-code-o'></i>&nbsp; Analytical Test Component</h4>
            </div>
            <div class="modal-body modal-fixHeight">                      
                <form class="form-horizontal" id="form_malc">
                    <input type="hidden" name="funct" id="malc_funct" />
                    <div class="form-group">
                        <label class="col-md-3 control-label">Test Name</label>
                        <div class="col-md-7">   
                            <input type="text" id="malc_atsTest_name" class="form-control malc_viewOnly"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Component Name</label>
                        <div class="col-md-7">   
                            <input type="text" name="malc_atsField_name" id="malc_atsField_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Formula</label>
                        <div class="col-md-9">   
                            <table id="datatable_malc_formula" class="table table-striped table-bordered table-condensed table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center bg-color-teal txt-color-white" width="30px"></th>
                                        <th class="text-center bg-color-teal txt-color-white" width="25%">Formula Name</th>
                                        <th class="text-center bg-color-teal txt-color-white">Formula</th>
                                        <th class="text-center bg-color-teal txt-color-white" width="30%">Notes</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="malc_atsTest_id" id="malc_atsTest_id" />
                    <input type="hidden" name="malc_atsField_id" id="malc_atsField_id" />
                </form>
            </div>
            
            <div class="modal-footer padding-10">
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-success" id="malc_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>