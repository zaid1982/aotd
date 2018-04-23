<!-- Modal -->
<div class="modal fade" id="modal_eff_test" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-dashboard'></i>&nbsp; EFF Test Information</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mflt_infoView" onclick="f_mflt_edit(1);" rel="tooltip" data-placement="left" data-original-title="Edit Test Details"><i class="fa fa-edit"></i> Edit Test</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal mflt_infoView">
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Laboratory Name</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmflt_lab_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test ID</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmflt_effTest_id"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Name</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmflt_effTest_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Evaluation Group</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmflt_effCat_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Description</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmflt_effTest_desc"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Cost</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmflt_effTest_cost"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Status</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmflt_status_desc"></span> 
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal mflt_editView" id="form_mflt_form">
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Laboratory Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mflt_viewOnly" name="mflt_lab_name" id="mflt_lab_name" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test ID</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mflt_viewOnly" name="mflt_effTest_ids" id="mflt_effTest_ids" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label"><font color="red">*</font> Test Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mflt_effTest_name" id="mflt_effTest_name" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label"><font color="red">*</font> Evaluation Group</label>
                            <div class="col-md-9 selectContainer">
                                <select class="form-control" name="mflt_effCat_id" id="mflt_effCat_id"></select>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test Description</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mflt_effTest_desc" id="mflt_effTest_desc" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label"><font color="red">*</font> Cost</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mflt_effTest_cost" id="mflt_effTest_cost" />
                            </div>   
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Status</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mflt_effTest_status" value="1">
                                    <span>Active</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mflt_effTest_status" value="41">
                                    <span>Hidden</span>  
                                </label>
                            </div>
                        </div> 
                    </form>
                </div>
                <h6 class="padding-top-10">Field Name List<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mflt_editView" onclick="f_mflf_load_field(1, '', mflt_effTest_id.value, 'mflt');" rel="tooltip" data-placement="left" data-original-title="Add new Field Name"><i class="fa fa-plus-square"></i> Add Field Name</a></h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_mflt_field" class="table table-bordered table-hover margin-bottom-5" width="100%">
                            <thead>
                                <tr>
                                    <th width="8%">No.</th>                    
                                    <th>Field Name</th>                   
                                    <th>Status</th>   
                                    <th style="width: 68px; max-width: 68px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
            </div>
            
            <div class="modal-footer padding-10">
                <form class="form-horizontal" id="form_mflt">
                    <input type="hidden" name="funct" id="mflt_funct" />
                    <input type="hidden" name="mflt_effTest_id" id="mflt_effTest_id" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-warning mflt_editView" id="mflt_btn_cancel" onclick="f_mflt_edit(0);">
                            <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                        </button>
                        <button type="button" class="btn btn-labeled btn-success mflt_editView" id="mflt_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>