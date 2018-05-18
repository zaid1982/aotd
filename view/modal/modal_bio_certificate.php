<!-- Modal -->
<div class="modal fade" id="modal_bio_certificate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-certificate'></i>&nbsp; Biodegradation Certificate Information</h4>
            </div>
            <div class="modal-body modal-fixHeight"> 
                <div class="row padding-15">
                    <div class="process">
                        <div class="process-row3 nav nav-tabs" id="mbcr_steps"></div>
                    </div>
                </div>  
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mbcr_infoView" onclick="f_mbsl_load_sample_login(2, mbcr_bdtRep_no.value, 'mbcr');" rel="tooltip" data-placement="left" data-original-title="Edit Certificate Information"><i class="fa fa-edit"></i> Edit Certificate Info</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal mbcr_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Certificate No.</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_timeReceived"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Days Completed</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_days"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_status_desc"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Sample Description</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_sampleDesc"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Name of Substance</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_substance"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Empirical Formula</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_formula"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Purity / Relative Proportion</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_component"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Physical Characteristics</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_physical"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Solubility</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_solubility"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">      
                                    <label class="col-md-6 control-label"><strong>Sample Condition</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_condition"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">      
                                    <label class="col-md-6 control-label"><strong>MSDS</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_msdss"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Remarks</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmbcr_bdtRep_remark"></span> 
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </form>
                </div>                
                <h6 class="padding-top-10 mbcr_div_sample">Add Sample Description</h6>
                <div class="row mbcr_div_sample">
                    <form class="form-horizontal" id="form_mbcr_form">
                        <article class="col-md-12">                            
                            <table id="datatable_mbcr_sample" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40px">No.</th>                      
                                        <th>Sample Code</th>   
                                        <th width="25%">Sample Description</th>
                                        <th width="10%">THOD</th>
                                        <th width="35%">Result</th>
                                        <th width="40px"></th>                                     
                                    </tr>
                                </thead> 
                                <tbody></tbody>									
                            </table>   
                        </article>
                    </form>
                </div>
                <h6 class="padding-top-10 mbcr_div_sampleView">Sample List</h6>
                <div class="row mbcr_div_sampleView">
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
                        <table id="datatable_mbcr_sampleView" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">No.</th>                    
                                    <th>Sample Code</th>   
                                    <th width="25%">Sample Description</th>
                                    <th width="10%">THOD</th>
                                    <th width="35%">Result</th>
                                    <th width="40px"></th>
                                </tr>
                            </thead> 
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
                <h6 class="padding-top-10 mbcr_div_workbook">Workbook</h6>
                <div class="well well-light mbcr_div_workbook">
                    <form class="form-horizontal" id="form_mbcr_workbook">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><font color="red">*</font> THOD</label>
                            <div class="col-md-4">   
                                <input type="text" class="form-control" name="mbcr_bdtLab_thod" id="mbcr_bdtLab_thod" />
                            </div>
                        </div>
                        <div class="row">
                            <article class="col-md-12">
                                <table id="datatable_mbcr_workSummary" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="8%">Day</th>                    
                                            <th>Reference</th>   
                                            <th>RELEASOL</th>
                                            <th>Toxic Control</th>
                                            <th width="20%">Status</th>
                                            <th style="width: 32px; max-width: 32px">&nbsp;</th>
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>   
                            </article>
                        </div>
                        <div class="row margin-top-5">
                            <article class="col-md-12">
                                <table id="datatable_mbcr_workbook_1" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr><th colspan="13" class="bg-color-white">Test Name : mg O<sub>2</sub>/l</th></tr>
                                        <tr>
                                            <th rowspan="2">Day</th>
                                            <th colspan="3" width="23%" class="text-center">Blank (inoculum)</th>
                                            <th colspan="3" width="23%" class="text-center">Reference substance + inoculum</th>
                                            <th colspan="3" width="23%" class="text-center">RELEASOL + inoculum</th>
                                            <th colspan="3" width="23%" class="text-center">Reference substance + RELEASOL + inoculum</th>
                                        </tr>
                                        <tr>                                                        
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>   
                            </article>
                        </div>
                        <div class="row margin-top-5">
                            <article class="col-md-12">
                                <table id="datatable_mbcr_workbook_2" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr><th colspan="13" class="bg-color-white">Test Name : % Saturation</th></tr>
                                        <tr>
                                            <th rowspan="2">Day</th>
                                            <th colspan="3" width="23%" class="text-center">Blank (inoculum)</th>
                                            <th colspan="3" width="23%" class="text-center">Reference substance + inoculum</th>
                                            <th colspan="3" width="23%" class="text-center">RELEASOL + inoculum</th>
                                            <th colspan="3" width="23%" class="text-center">Reference substance + RELEASOL + inoculum</th>
                                        </tr>
                                        <tr>                                                        
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>   
                            </article>
                        </div>
                        <div class="row margin-top-5">
                            <article class="col-md-12">
                                <table id="datatable_mbcr_workbook_3" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr><th colspan="13" class="bg-color-white">Test Name : <sup>o</sup>C</th></tr>
                                        <tr>
                                            <th rowspan="2">Day</th>
                                            <th colspan="3" width="23%" class="text-center">Blank (inoculum)</th>
                                            <th colspan="3" width="23%" class="text-center">Reference substance + inoculum</th>
                                            <th colspan="3" width="23%" class="text-center">RELEASOL + inoculum</th>
                                            <th colspan="3" width="23%" class="text-center">Reference substance + RELEASOL + inoculum</th>
                                        </tr>
                                        <tr>                                                        
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                            <th>Flask 1</th>   
                                            <th>Flask 2</th>   
                                            <th>Mean</th> 
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>   
                            </article>
                        </div>
                        <div class="form-group padding-top-15">
                            <label class="col-md-3 control-label"><font color="red">*</font> Result</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="mbcr_snote_bdtLab_result" id="mbcr_snote_bdtLab_result" rows="6"></textarea>
                                <input type="hidden" name=mbcr_bdtLab_result" id="mbcr_bdtLab_result" />
                            </div>
                        </div>    
                    </form>          
                </div>
                <h6 class="padding-top-10 mbcr_div_upload">Attachments<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mbcr_attachEdit" onclick="f_mup_load_upload(1, mbcr_bdtRep_no.value, mbcr_wfTrans_id.value, 'mbcr');" rel="tooltip" data-placement="left" data-original-title="Add Attachment"><i class="fa fa-upload"></i> Add Attachment</a></h6>
                <div class="row mbcr_div_upload">
                    <article class="col-md-12">
                        <table id="datatable_mbcr_upload" class="table table-bordered table-hover" width="100%">
                            <thead>
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
                <h6 class="padding-top-10 mbcr_div_action">Result Status</h6>
                <div class="well well-light mbcr_div_action">
                    <form class="form-horizontal" id="form_mbcr_action">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Final Test Status</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mbcr_action" value="42">
                                    <span>Completed</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mbcr_action" value="50">
                                    <span>Incomplete</span>  
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Conclusion</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="mbcr_snote_wfTask_remark" id="mbcr_snote_wfTask_remark" rows="6"></textarea>
                                <input type="hidden" name="mbcr_wfTask_remark" id="mbcr_wfTask_remark" />
                            </div>
                        </div>    
                    </form>                    
                </div>      
                <h6 class="padding-top-10">Transaction History</h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_mbcr_history" class="table table-bordered table-hover" width="100%">
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
                <form id="form_mbcr">
                    <input type="hidden" name="funct" id="mbcr_funct" />
                    <input type="hidden" name="mbcr_bdtRep_no" id="mbcr_bdtRep_no" />
                    <input type="hidden" name="mbcr_wfTrans_id" id="mbcr_wfTrans_id" />
                    <input type="hidden" name="mbcr_wfTask_id" id="mbcr_wfTask_id" />
                    <input type="hidden" name="mbcr_wfTask_status" id="mbcr_wfTask_status" />
                    <input type="hidden" name="mbcr_wfTaskType_id" id="mbcr_wfTaskType_id" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </button>
                        <button type="button" class="btn btn-labeled btn-success mbcr_editView" id="mbcr_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                        <button type="button" class="btn btn-labeled btn-warning mbcr_editView" id="mbcr_btn_submit">
                            <span class="btn-label"><i class="fa fa-mail-forward"></i></span>Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
                