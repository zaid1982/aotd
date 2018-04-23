<!-- Modal -->
<div class="modal fade" id="modal_ats_certificate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-certificate'></i>&nbsp; Analytical Certificate Information</h4>
            </div>
            <div class="modal-body modal-fixHeight">      
                <div class="row padding-15">
                    <div class="process">
                        <div class="process-row nav nav-tabs" id="macr_steps"></div>
                    </div>
                </div>  
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right macr_infoView" onclick="f_masl_load_sample_login(2, macr_atsCert_id.value, 'macr');" rel="tooltip" data-placement="left" data-original-title="Edit Certificate Information"><i class="fa fa-edit"></i> Edit Certificate Info</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal macr_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Certificate No.</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_status_desc"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Accredited</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_accrediteds"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Equipment</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_equipments"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Chemical / Glassware / Reagent</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_chemicals"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">      
                                    <label class="col-md-6 control-label"><strong>Sample Condition</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_condition"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Remarks</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_remark"></span> 
                                    </div>
                                </div>  
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacr_atsCert_timeReceived"></span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <h6 class="padding-top-10 macr_div_sample">Add Sample Description</h6>
                <div class="row macr_div_sample">
                    <form class="form-horizontal" id="form_macr_form">
                        <article class="col-md-12">
                            <table id="datatable_macr_sample" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40px">No.</th>                    
                                        <th>Sample Code</th>   
                                        <th width="40%">Test Name</th>
                                    </tr>
                                </thead> 
                                <tbody></tbody>									
                            </table>   
                        </article>
                    </form>
                </div>
                <h6 class="padding-top-10 macr_div_costing">Test Costing and Overrid Value</h6>
                <div class="row macr_div_costing">
                    <article class="col-md-12">
                        <table id="datatable_macr_costing" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">No.</th>                    
                                    <th>Analysis</th>   
                                    <th width="15%">Overrid Value</th>
                                    <th width="15%">Cost/Sample</th>
                                    <th width="15%">Total Sample</th>
                                    <th width="15%">No. of Test</th>
                                    <th width="15%">Total Cost</th>
                                </tr>
                            </thead>                            
                            <tfoot>
                                <tr>
                                    <th colspan="6" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
                <h6 class="padding-top-10 macr_div_result">Test Result</h6>
                <div class="row macr_div_result">						
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
                        <div class="jarviswidget well margin-bottom-10" id="macr_wid-id-0">
                            <div>
                                <div class="widget-body no-padding">
                                    <table id="datatable_macr_result" class="display projects-table table table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="60px"></th>
                                                <th>Sample Code</th>
                                                <th>Test Name</th>
                                                <th width="45px"></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>                             
                        </div>                                    
                    </article>
                </div>
                <h6 class="padding-top-10 macr_div_workbook">Workbook</h6>
                <div class="well well-light macr_div_workbook">
                    <div class="row">
                        <article class="col-md-12">
                            <table id="datatable_macr_workSummary" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr><th colspan="6" style="background-color: lightgrey">Test Summary</tr>
                                    <tr>
                                        <th width="40px">No</th>
                                        <th>Analysis</th>
                                        <th>Component Name</th>
                                        <th width="35%">Formula</th>
                                        <th width="15%">Sample Done</th>
                                        <th style="width: 32px; max-width: 32px">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>  
                        </article>
                    </div>
                    <div class="row macr_div_workbook2">
                        <article class="col-md-12">
                            <table id="datatable_macr_book" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr><th colspan="12" style="background-color: lightgrey">Test Result</tr>
                                    <tr>                   
                                        <th style="width: 180px; min-width: 180px">Sample Code</th>   
                                        <th>p6</th>
                                        <th>p7</th>
                                        <th>p8</th>
                                        <th>p9</th>
                                        <th>p10</th>
                                        <th>p6</th>
                                        <th>p7</th>
                                        <th>p8</th>
                                        <th>p9</th>
                                        <th>p10</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>  									
                            </table>   
                        </article>
                    </div>
                    <div class="row">
                        <article class="col-md-12">
                            <table id="datatable_macr_upload" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr><th colspan="6" style="background-color: lightgrey">Attachments<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right macr_attachEdit" onclick="f_mup_load_upload(1, macr_atsCert_id.value, macr_wfTrans_id.value, 'macr');" rel="tooltip" data-placement="left" data-original-title="Add Attachment"><i class="fa fa-upload"></i> Add Attachment</a></tr>
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
                <h6 class="padding-top-10 macr_div_action">Action</h6>
                <div class="well well-light macr_div_action">
                    <form class="form-horizontal" id="form_macr_action">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Action / Result</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="macr_action" value="10">
                                    <span>Validate</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="macr_action" value="12">
                                    <span>Return Test for Correction</span>  
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message / Feedback</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="macr_snote_wfTask_remark" id="macr_snote_wfTask_remark" rows="6"></textarea>
                                <input type="hidden" name="macr_wfTask_remark" id="macr_wfTask_remark" />
                            </div>
                        </div>    
                    </form>                    
                </div>                
                <h6 class="padding-top-10">Transaction History</h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_macr_history" class="table table-bordered table-hover" width="100%">
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
                <form id="form_macr">
                    <input type="hidden" name="funct" id="macr_funct" />
                    <input type="hidden" name="macr_atsCert_id" id="macr_atsCert_id" />
                    <input type="hidden" name="macr_wfTrans_id" id="macr_wfTrans_id" />
                    <input type="hidden" name="macr_wfTask_id" id="macr_wfTask_id" />
                    <input type="hidden" name="macr_wfTask_status" id="macr_wfTask_status" />
                    <input type="hidden" name="macr_wfTaskType_id" id="macr_wfTaskType_id" />
                    <input type="hidden" name="macr_atsFormula_id" id="macr_atsFormula_id" />
                    <input type="hidden" name="macr_atsCert_cycle" id="macr_atsCert_cycle" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </button>
                        <button type="button" class="btn btn-labeled btn-success macr_editView" id="macr_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                        <button type="button" class="btn btn-labeled btn-warning macr_editView" id="macr_btn_submit">
                            <span class="btn-label"><i class="fa fa-mail-forward"></i></span>Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>