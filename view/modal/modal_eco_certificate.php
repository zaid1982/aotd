<!-- Modal -->
<div class="modal fade" id="modal_eco_certificate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-certificate'></i>&nbsp; Ecotoxicity Certificate Information</h4>
            </div>
            <div class="modal-body modal-fixHeight"> 
                <div class="row padding-15">
                    <div class="process">
                        <div class="process-row3 nav nav-tabs" id="mccr_steps"></div>
                    </div>
                </div>  
                <h6>Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mccr_infoView" onclick="f_mcsl_load_sample_login(2, mccr_ectRep_no.value, 'mccr');" rel="tooltip" data-placement="left" data-original-title="Edit Certificate Information"><i class="fa fa-edit"></i> Edit Certificate Info</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal mccr_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Certificate No.</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_timeReceived"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_status_desc"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Sample Description</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_sampleDesc"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Name of Substance</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_substance"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Empirical Formula</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_formula"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Purity / Relative Proportion</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_component"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Physical Characteristics</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_physical"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Solubility</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_solubility"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">      
                                    <label class="col-md-6 control-label"><strong>Sample Condition</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_condition"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">      
                                    <label class="col-md-6 control-label"><strong>MSDS</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_msdss"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Remarks</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmccr_ectRep_remark"></span> 
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </form>
                </div>        
                <h6 class="padding-top-10 mccr_div_sample">Add Sample Description</h6>
                <div class="row mccr_div_sample">
                    <form class="form-horizontal" id="form_mccr_form">
                        <article class="col-md-12">
                            <table id="datatable_mccr_sample" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40px">No.</th>                    
                                        <th width="25%">Sample Code</th>   
                                        <th>Sample Description</th>
                                        <th width="40%">Result</th>
                                        <th width="40px"></th>
                                    </tr>
                                </thead> 
                                <tbody></tbody>									
                            </table>   
                        </article>
                    </form>
                </div>
                <h6 class="padding-top-10 mccr_div_sampleView">Sample List</h6>
                <div class="row mccr_div_sampleView">
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
                        <table id="datatable_mccr_sampleView" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">No.</th>                    
                                    <th width="25%">Sample Code</th>   
                                    <th>Sample Description</th>
                                    <th width="40%">Result</th>
                                    <th width="40px"></th>
                                </tr>
                            </thead> 
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>
                <h6 class="padding-top-10 mccr_div_workbook">Workbook
<!--                    <div class="pull-right">
                        <a href="javascript:void(0);" class="btn btn-xs btn-primary mccr_infoView" onclick="f_xxx();" rel="tooltip" data-placement="bottom" data-original-title="Edit Day 0"><i class="fa fa-calendar-o"></i> Day 0</a>
                        <a href="javascript:void(0);" class="btn btn-xs btn-primary mccr_infoView" onclick="f_xxx();" rel="tooltip" data-placement="bottom" data-original-title="Edit Day 1"><i class="fa fa-calendar-o"></i> Day 1</a>
                        <a href="javascript:void(0);" class="btn btn-xs btn-primary mccr_infoView" onclick="f_xxx();" rel="tooltip" data-placement="bottom" data-original-title="Edit Day 2"><i class="fa fa-calendar-o"></i> Day 2</a>
                        <a href="javascript:void(0);" class="btn btn-xs btn-primary mccr_infoView" onclick="f_xxx();" rel="tooltip" data-placement="bottom" data-original-title="Edit Day 3"><i class="fa fa-calendar-o"></i> Day 3</a>
                        <a href="javascript:void(0);" class="btn btn-xs btn-danger mccr_infoView" onclick="f_xxx();" rel="tooltip" data-placement="bottom" data-original-title="Edit Day 4"><i class="fa fa-calendar-plus-o"></i> Day 4</a>
                    </div>-->
                </h6>
                <div class="well well-light mccr_div_workbook">
                    <form class="form-horizontal" id="form_mccr_workbook">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Range-Finding Test (RFT) - Day 0</label>
                            <div class="col-md-9">
                                <table id="datatable_mccr_workbook_10" class="table table-bordered table-hover margin-bottom-5" width="100%">
                                    <thead>
                                        <tr>                                                        
                                            <th width="10%">Tank</th>   
                                            <th>Concentration (mg/l)</th>   
                                            <th width="15%">pH</th>   
                                            <th width="15%">O<sub>2</sub></th> 
                                            <th width="20%">Temperature</th>   
                                            <th width="20%">Observation</th>  
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Range-Finding Test (RFT) - Day 1</label>
                            <div class="col-md-9">
                                <table id="datatable_mccr_workbook_11" class="table table-bordered table-hover margin-bottom-5" width="100%">
                                    <thead>
                                        <tr>                                                        
                                            <th width="5%">Tank</th>   
                                            <th>Concentration (mg/l)</th>  
                                            <th width="15%">pH</th>   
                                            <th width="15%">O<sub>2</sub></th> 
                                            <th width="20%">Temperature</th>   
                                            <th width="20%">Observation</th>  
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Definitive Test (DT) - Day 0</label>
                            <div class="col-md-9">
                                <table id="datatable_mccr_workbook_20" class="table table-bordered table-hover margin-bottom-5" width="100%">
                                    <thead>
                                        <tr>                                                        
                                            <th width="5%">Tank</th>   
                                            <th>Concentration (mg/l)</th>  
                                            <th width="15%">pH</th>   
                                            <th width="15%">O<sub>2</sub></th> 
                                            <th width="20%">Temperature</th>   
                                            <th width="20%">Observation</th>  
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Definitive Test (DT) - Day 1</label>
                            <div class="col-md-9">
                                <table id="datatable_mccr_workbook_21" class="table table-bordered table-hover margin-bottom-5" width="100%">
                                    <thead>
                                        <tr>                                                        
                                            <th width="5%">Tank</th>   
                                            <th>Concentration (mg/l)</th> 
                                            <th width="15%">pH</th>   
                                            <th width="15%">O<sub>2</sub></th> 
                                            <th width="20%">Temperature</th>   
                                            <th width="20%">Observation</th>  
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Definitive Test (DT) - Day 2</label>
                            <div class="col-md-9">
                                <table id="datatable_mccr_workbook_22" class="table table-bordered table-hover margin-bottom-5" width="100%">
                                    <thead>
                                        <tr>                                                        
                                            <th width="5%">Tank</th>   
                                            <th>Concentration (mg/l)</th> 
                                            <th width="15%">pH</th>   
                                            <th width="15%">O<sub>2</sub></th> 
                                            <th width="20%">Temperature</th>   
                                            <th width="20%">Observation</th>  
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Definitive Test (DT) - Day 3</label>
                            <div class="col-md-9">
                                <table id="datatable_mccr_workbook_23" class="table table-bordered table-hover margin-bottom-5" width="100%">
                                    <thead>
                                        <tr>                                                        
                                            <th width="5%">Tank</th>   
                                            <th>Concentration (mg/l)</th>   
                                            <th width="15%">pH</th>   
                                            <th width="15%">O<sub>2</sub></th> 
                                            <th width="20%">Temperature</th>   
                                            <th width="20%">Observation</th>  
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Definitive Test (DT) - Day 4</label>
                            <div class="col-md-9">
                                <table id="datatable_mccr_workbook_24" class="table table-bordered table-hover margin-bottom-5" width="100%">
                                    <thead>
                                        <tr>                                                        
                                            <th width="5%">Tank</th>   
                                            <th>Concentration (mg/l)</th>  
                                            <th width="15%">pH</th>   
                                            <th width="15%">O<sub>2</sub></th> 
                                            <th width="20%">Temperature</th>   
                                            <th width="20%">Observation</th>  
                                        </tr>
                                    </thead> 
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Result</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="mccr_snote_ectLab_results" id="mccr_snote_ectLab_results" rows="6"></textarea>
                                <input type="hidden" name=mccr_ectLab_results" id="mccr_ectLab_results" />
                            </div>
                        </div>  
                    </form>
                </div>
                <h6 class="padding-top-10 mccr_div_upload">Attachments<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right mccr_attachEdit" onclick="f_mup_load_upload(1, mccr_ectRep_no.value, mccr_wfTrans_id.value, 'mccr');" rel="tooltip" data-placement="left" data-original-title="Add Attachment"><i class="fa fa-upload"></i> Add Attachment</a></h6>
                <div class="row mccr_div_upload">
                    <article class="col-md-12">
                        <table id="datatable_mccr_upload" class="table table-bordered table-hover" width="100%">
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
                
                <h6 class="padding-top-10 mccr_div_action">Result Status</h6>
                <div class="well well-light mccr_div_action">
                    <form class="form-horizontal" id="form_mccr_action">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Final Test Status</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mccr_action" value="42">
                                    <span>Completed</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="mccr_action" value="50">
                                    <span>Incomplete</span>  
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Conclusion</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="mccr_snote_wfTask_remark" id="mccr_snote_wfTask_remark" rows="6"></textarea>
                                <input type="hidden" name="mccr_wfTask_remark" id="mccr_wfTask_remark" />
                            </div>
                        </div>    
                    </form>                    
                </div>      
                <h6 class="padding-top-10">Transaction History</h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_mccr_history" class="table table-bordered table-hover" width="100%">
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
                <form id="form_mccr">
                    <input type="hidden" name="funct" id="mccr_funct" />
                    <input type="hidden" name="mccr_ectRep_no" id="mccr_ectRep_no" />
                    <input type="hidden" name="mccr_wfTrans_id" id="mccr_wfTrans_id" />
                    <input type="hidden" name="mccr_wfTask_id" id="mccr_wfTask_id" />
                    <input type="hidden" name="mccr_wfTask_status" id="mccr_wfTask_status" />
                    <input type="hidden" name="mccr_wfTaskType_id" id="mccr_wfTaskType_id" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </button>
                        <button type="button" class="btn btn-labeled btn-success mccr_editView" id="mccr_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                        <button type="button" class="btn btn-labeled btn-warning mccr_editView" id="mccr_btn_submit">
                            <span class="btn-label"><i class="fa fa-mail-forward"></i></span>Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
                