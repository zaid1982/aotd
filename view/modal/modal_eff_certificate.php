<!-- Modal -->
<div class="modal fade" id="modal_eff_certificate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-certificate'></i>&nbsp; Efficacy Certificate Information</h4>
            </div>
            <div class="modal-body modal-fixHeight"> 
                <div class="row padding-15">
                    <div class="process">
                        <div class="process-row nav nav-tabs" id="mfcr_steps"></div>
                    </div>
                </div>  
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mfcr_infoView" onclick="f_mfsl_load_sample_login(2, mfcr_effRep_no.value, 'mfcr');" rel="tooltip" data-placement="left" data-original-title="Edit Certificate Information"><i class="fa fa-edit"></i> Edit Certificate Info</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal mfcr_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Certificate No.</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_timeReceived"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Completed</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_timeCompleted"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Physical Form</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_physical"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Quantity</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_quantity"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Colour</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_color"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Other</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_other"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Test</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effTest_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_status_desc"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Started</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmfcr_effRep_timeStarted"></span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <h6 class="padding-top-10 mfcr_div_sample">Add Sample Description</h6>
                <div class="row mfcr_div_sample">
                    <form class="form-horizontal" id="form_mfcr_form">
                        <article class="col-md-12">
                            <table id="datatable_mfcr_sample" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40px">No.</th>                    
                                        <th>Sample Code</th>   
                                        <th width="23%">Sample Name</th>
                                        <th width="25%">Sample Description</th>
                                        <th width="15%">Cost</th>
                                    </tr>
                                </thead> 
                                <tbody></tbody>									
                            </table>   
                        </article>
                    </form>
                </div>
                <h6 class="padding-top-10 mfcr_div_sampleView">Sample List</h6>
                <div class="row mfcr_div_sampleView">
                    <article class="col-md-12">
                        <div class="row" style="display: none;">
                            <div class="col-md-3">
                                <div id="printcode">
                                    <center>
                                        <svg id="barcode" style="width: 100%; height: 100%;"></svg>
                                        <span style="font-size: 8px; font-family: arial;" id="sampleNo"></span>
                                    </center>
                                </div>  
                            </div>
                        </div>
                        <table id="datatable_mfcr_sampleView" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">No.</th>                    
                                    <th>Sample Code</th>   
                                    <th width="23%">Sample Name</th>
                                    <th width="25%">Sample Description</th>
                                    <th width="15%">Cost</th>
                                    <th width="40px"></th>
                                </tr>
                            </thead> 
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
                <h6 class="padding-top-10 mfcr_div_starting">Add Starting Date</h6>
                <div class="well well-light mfcr_div_starting">
                    <form class="form-horizontal" id="form_mfcr_starting">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Starting Date</label>
                            <div class="col-md-3">   
                                <div class="input-group">
                                    <input type="text" name="mfcr_effRep_timeStarted" id="mfcr_effRep_timeStarted" class="form-control" readonly>
                                    <span class="input-group-addon hidden-sm hidden-xs"><i class="fa fa-calendar"></i></span>        
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <h6 class="padding-top-10 mfcr_div_workbook">Workbook</h6>
                <div class="well well-light mfcr_div_workbook">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Code</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmfcr_effLab_code"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin margin-bottom-10">
                                    <label class="col-md-4 control-label"><strong>Sample Description</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmfcr_effLab_sampleDesc"></span>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmfcr_effLab_sampleCode"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin margin-bottom-10">
                                    <label class="col-md-4 control-label"><strong>Cost</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmfcr_effLab_cost"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <form class="form-horizontal" id="form_mfcr_workbook">
                            <article class="col-md-12">
                                <table id="datatable_mfcr_workbook" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr><th colspan="4" style="background-color: lightgrey">Test Results</tr>
                                        <tr>
                                            <th width="40px">No.</th>                    
                                            <th width="40%">Field</th>   
                                            <th>Result</th> 
                                            <th>Result</th>
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>   
                            </article> 
                            <input type="hidden" name="mfcr_effLab_code" id="mfcr_effLab_code" />
                        </form>
                    </div>
                    <div class="row">
                        <article class="col-md-12">
                            <table id="datatable_mfcr_upload" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr><th colspan="6" style="background-color: lightgrey">Attachments<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mfcr_attachEdit" onclick="f_mup_load_upload(1, mfcr_effRep_no.value, mfcr_wfTrans_id.value, 'mfcr');" rel="tooltip" data-placement="left" data-original-title="Add Attachment"><i class="fa fa-upload"></i> Add Attachment</a></tr>
                                    <tr>
                                        <th width="40px">No.</th>                    
                                        <th width="23%">Document Name</th>        
                                        <th width="20%">Sample Code</th>   
                                        <th width="15%">Category</th>                   
                                        <th>Description</th>   
                                        <th style="width: 60px; max-width: 60px">&nbsp;</th>
                                    </tr>
                                </thead> 
                                <tbody></tbody>									
                            </table>   
                        </article>   
                    </div>
                </div>
                <h6 class="padding-top-10 mfcr_div_action">Action</h6>
                <div class="well well-light mfcr_div_action">
                    <form class="form-horizontal" id="form_mfcr_action">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Action / Result</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mfcr_action" value="10">
                                    <span>Validate</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mfcr_action" value="12">
                                    <span>Return Test for Correction</span>  
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message / Feedback</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="mfcr_snote_wfTask_remark" id="mfcr_snote_wfTask_remark" rows="6"></textarea>
                                <input type="hidden" name="mfcr_wfTask_remark" id="mfcr_wfTask_remark" />
                            </div>
                        </div>    
                    </form>                    
                </div>     
                <h6 class="padding-top-10">Transaction History</h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_mfcr_history" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px" data-hide="phone">No</th>
                                    <th data-class="expand">Task Name</th>
                                    <th data-hide="phone">Task Status</th>
                                    <th data-hide="phone,tablet" width="20%">Action By</th>
                                    <th style="min-width: 70px">Submitted Time</th>
                                    <th data-hide="phone,tablet" width="30%">Message</th>
                                </tr>
                            </thead>
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
            </div>            
            <div class="modal-footer padding-10">
                <form id="form_mfcr">
                    <input type="hidden" name="funct" id="mfcr_funct" />
                    <input type="hidden" name="mfcr_effRep_no" id="mfcr_effRep_no" />
                    <input type="hidden" name="mfcr_wfTrans_id" id="mfcr_wfTrans_id" />
                    <input type="hidden" name="mfcr_wfTask_id" id="mfcr_wfTask_id" />
                    <input type="hidden" name="mfcr_wfTask_status" id="mfcr_wfTask_status" />
                    <input type="hidden" name="mfcr_wfTaskType_id" id="mfcr_wfTaskType_id" />
                    <input type="hidden" name="mfcr_effRep_cycle" id="mfcr_effRep_cycle" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </button>
                        <button type="button" class="btn btn-labeled btn-success mfcr_editView" id="mfcr_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                        <button type="button" class="btn btn-labeled btn-warning mfcr_editView" id="mfcr_btn_submit">
                            <span class="btn-label"><i class="fa fa-mail-forward"></i></span>Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
                