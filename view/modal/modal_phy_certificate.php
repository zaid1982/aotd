<!-- Modal -->
<div class="modal fade" id="modal_phy_certificate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-certificate'></i>&nbsp; Physical Certificate Information</h4>
            </div>
            <div class="modal-body modal-fixHeight"> 
                <div class="row padding-15">
                    <div class="process">
                        <div class="process-row nav nav-tabs" id="mpcr_steps"></div>
                    </div>
                </div>  
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mpcr_infoView" onclick="f_mpsl_load_sample_login(2, mpcr_phyRep_no.value, 'mpcr');" rel="tooltip" data-placement="left" data-original-title="Edit Certificate Information"><i class="fa fa-edit"></i> Edit Certificate Info</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal mpcr_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Certificate No.</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_timeReceived"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Completed</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_timeCompleted"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Physical Form</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_physical"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Quantity</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_quantity"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Colour</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_color"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Other</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_other"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Test</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyTest_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_status_desc"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Started</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpcr_phyRep_timeStarted"></span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <h6 class="padding-top-10 mpcr_div_sample">Add Sample Description</h6>
                <div class="row mpcr_div_sample">
                    <form class="form-horizontal" id="form_mpcr_form">
                        <article class="col-md-12">
                            <table id="datatable_mpcr_sample" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40px">No.</th>                    
                                        <th>Sample Code</th>   
                                        <th width="23%">Sample Name</th>
                                        <th width="25%">Sample Description</th>
                                        <th width="25%">Test Condition</th>
                                    </tr>
                                </thead> 
                                <tbody></tbody>									
                            </table>   
                        </article>
                    </form>
                </div>
                <h6 class="padding-top-10 mpcr_div_sampleView">Sample List</h6>
                <div class="row mpcr_div_sampleView">
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
                        <table id="datatable_mpcr_sampleView" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">No.</th>                    
                                    <th>Sample Code</th>   
                                    <th width="23%">Sample Name</th>
                                    <th width="25%">Sample Description</th>
                                    <th width="25%">Test Condition</th>
                                    <th width="40px"></th>
                                </tr>
                            </thead> 
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
                <h6 class="padding-top-10 mpcr_div_workbook">Workbook</h6>
                <div class="well well-light mpcr_div_workbook">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Code</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmpcr_phyLab_code"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin margin-bottom-10">
                                    <label class="col-md-4 control-label"><strong>Sample Description</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmpcr_phyLab_sampleDesc"></span>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmpcr_phyLab_sampleCode"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin margin-bottom-10">
                                    <label class="col-md-4 control-label"><strong>Test Condition</strong></label>
                                    <div class="col-md-8 control-label text-align-left">   
                                        <span id="lmpcr_phyLab_testCondition"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <form class="form-horizontal" id="form_mpcr_workbook">
                            <article class="col-md-12">
                                <table id="datatable_mpcr_workbook" class="table table-bordered table-hover" width="100%">
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
                            <input type="hidden" name="mpcr_phyLab_code" id="mpcr_phyLab_code" />
                        </form>
                    </div>
                    <div class="row">
                        <article class="col-md-12">
                            <table id="datatable_mpcr_upload" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr><th colspan="6" style="background-color: lightgrey">Attachments<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mpcr_attachEdit" onclick="f_mup_load_upload(1, mpcr_phyRep_no.value, mpcr_wfTrans_id.value, 'mpcr');" rel="tooltip" data-placement="left" data-original-title="Add Attachment"><i class="fa fa-upload"></i> Add Attachment</a></tr>
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
                <h6 class="padding-top-10 mpcr_div_action">Action</h6>
                <div class="well well-light mpcr_div_action">
                    <form class="form-horizontal" id="form_mpcr_action">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Action / Result</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mpcr_action" value="10">
                                    <span>Validate</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mpcr_action" value="12">
                                    <span>Return Test for Correction</span>  
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message / Feedback</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="mpcr_snote_wfTask_remark" id="mpcr_snote_wfTask_remark" rows="6"></textarea>
                                <input type="hidden" name="mpcr_wfTask_remark" id="mpcr_wfTask_remark" />
                            </div>
                        </div>    
                    </form>                    
                </div>      
                <h6 class="padding-top-10">Transaction History</h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_mpcr_history" class="table table-bordered table-hover" width="100%">
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
                <form id="form_mpcr">
                    <input type="hidden" name="funct" id="mpcr_funct" />
                    <input type="hidden" name="mpcr_phyRep_no" id="mpcr_phyRep_no" />
                    <input type="hidden" name="mpcr_wfTrans_id" id="mpcr_wfTrans_id" />
                    <input type="hidden" name="mpcr_wfTask_id" id="mpcr_wfTask_id" />
                    <input type="hidden" name="mpcr_wfTask_status" id="mpcr_wfTask_status" />
                    <input type="hidden" name="mpcr_wfTaskType_id" id="mpcr_wfTaskType_id" />
                    <input type="hidden" name="mpcr_phyRep_cycle" id="mpcr_phyRep_cycle" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </button>
                        <button type="button" class="btn btn-labeled btn-success mpcr_editView" id="mpcr_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                        <button type="button" class="btn btn-labeled btn-warning mpcr_editView" id="mpcr_btn_submit">
                            <span class="btn-label"><i class="fa fa-mail-forward"></i></span>Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
                