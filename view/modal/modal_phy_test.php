<!-- Modal -->
<div class="modal fade" id="modal_phy_test" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-dashboard'></i>&nbsp; PHY Test Information</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mplt_infoView" onclick="f_mplt_edit(1);" rel="tooltip" data-placement="left" data-original-title="Edit Test Details"><i class="fa fa-edit"></i> Edit Test</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal mplt_infoView">
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Laboratory Name</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_lab_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test ID</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_phyTest_id"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Name</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_phyTest_name"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Test Parameters</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_phyTest_parameters"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Category</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_phyTest_cat"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Equipment Used</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_phyTest_equipment"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Cost</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_phyTest_cost"></span> 
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Status</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lmplt_status_desc"></span> 
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal mplt_editView" id="form_mplt_form">
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Laboratory Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mplt_viewOnly" name="mplt_lab_name" id="mplt_lab_name" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test ID</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control mplt_viewOnly" name="mplt_phyTest_ids" id="mplt_phyTest_ids" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label"><font color="red">*</font> Test Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mplt_phyTest_name" id="mplt_phyTest_name" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Test Parameters</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="mplt_phyTest_parameters" id="mplt_phyTest_parameters" rows="4" style="overflow-x: hidden"></textarea>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Category</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mplt_phyTest_cat" id="mplt_phyTest_cat" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Equipment Used</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mplt_phyTest_equipment" id="mplt_phyTest_equipment" />
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label"><font color="red">*</font> Cost</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mplt_phyTest_cost" id="mplt_phyTest_cost" />
                            </div>   
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Status</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mplt_phyTest_status" value="1">
                                    <span>Active</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mplt_phyTest_status" value="41">
                                    <span>Hidden</span>  
                                </label>
                            </div>
                        </div> 
                    </form>
                </div>
                <h6 class="padding-top-10">Field Name List<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mplt_editView" onclick="f_mplf_load_field(1, '', mplt_phyTest_id.value, 'mplt');" rel="tooltip" data-placement="left" data-original-title="Add new Field Name"><i class="fa fa-plus-square"></i> Add Field Name</a></h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_mplt_field" class="table table-bordered table-hover margin-bottom-5" width="100%">
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
                <form class="form-horizontal" id="form_mplt">
                    <input type="hidden" name="funct" id="mplt_funct" />
                    <input type="hidden" name="mplt_phyTest_id" id="mplt_phyTest_id" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-warning mplt_editView" id="mplt_btn_cancel" onclick="f_mplt_edit(0);">
                            <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                        </button>
                        <button type="button" class="btn btn-labeled btn-success mplt_editView" id="mplt_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>