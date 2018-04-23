<!-- Modal -->
<div class="modal fade" id="modal_ats_lab_test" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-dashboard'></i>&nbsp; Analytical Test Information</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right malt_infoView" onclick="f_malt_edit(1);" rel="tooltip" data-placement="left" data-original-title="Edit Test Details"><i class="fa fa-edit"></i> Edit Test</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal malt_infoView">
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Laboratory Name</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_lab_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test ID</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_atsTest_id"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Name</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_atsTest_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Description</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_atsTest_desc"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Method</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_atsTest_cat"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Size</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_atsTest_equipment"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Cost</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_atsTest_cost"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Status</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmalt_status_desc"></span> 
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal malt_editView" id="form_malt_form">
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Laboratory Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control malt_viewOnly" name="malt_lab_name" id="malt_lab_name" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test ID</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control malt_viewOnly" name="malt_atsTest_ids" id="malt_atsTest_ids" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label"><font color="red">*</font> Test Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="malt_atsTest_name" id="malt_atsTest_name" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test Description</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="malt_atsTest_desc" id="malt_atsTest_desc" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test Method</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="malt_atsTest_cat" id="malt_atsTest_cat" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test Size</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="malt_atsTest_equipment" id="malt_atsTest_equipment" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Cost</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="malt_atsTest_cost" id="malt_atsTest_cost" />
                            </div>   
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Status</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="malt_atsTest_status" value="1">
                                    <span>Active</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="malt_atsTest_status" value="41">
                                    <span>Hidden</span>  
                                </label>
                            </div>
                        </div> 
                    </form>
                </div>
                <h6 class="padding-top-10">Component List<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right malt_editView" onclick="f_malc_load_component(1, '', malt_atsTest_id.value, 'malt');" rel="tooltip" data-placement="left" data-original-title="Add new Component"><i class="fa fa-plus-square"></i> Add Component</a></h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_malt_component" class="table table-bordered table-hover margin-bottom-5" width="100%">
                            <thead>
                                <tr>
                                    <th width="30px">No.</th>                    
                                    <th>Component Name</th>   
                                    <th width="40%">Formula List</th>
                                    <th style="width: 68px; max-width: 68px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
            </div>
            
            <div class="modal-footer padding-10">
                <form class="form-horizontal" id="form_malt">
                    <input type="hidden" name="funct" id="malt_funct" />
                    <input type="hidden" name="malt_atsTest_id" id="malt_atsTest_id" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-warning malt_editView" id="malt_btn_cancel" onclick="f_malt_edit(0);">
                            <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                        </button>
                        <button type="button" class="btn btn-labeled btn-success malt_editView" id="malt_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>