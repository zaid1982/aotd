<!-- Modal -->
<div class="modal fade" id="modal_phy_report" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-certificate'></i>&nbsp; Physical Report Information</h4>
            </div>
            <div class="modal-body modal-fixHeight">  
                <h6>Information</h6>
                <div class="well well-light">
                    <form class="form-horizontal mpr_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Report No.</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_timeReceived"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Completed</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_timeCompleted"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Physical Form</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_physical"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Quantity</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_quantity"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Colour</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_color"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Other</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_other"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Test</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyTest_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_status_desc"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Started</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmpr_phyRep_timeStarted"></span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <div class="modal-footer padding-10">
                <form class="form-horizontal" id="form_mpr" method="post" target="_blank" action="pdf/phy.php">
                    <input type="hidden" name="funct" id="mpr_funct" />
                    <input type="hidden" name="mpr_lab_name" id="mpr_lab_name" />
                    <input type="hidden" name="mpr_phyRep_no" id="mpr_phyRep_no" />
                    <input type="hidden" name="mpr_phyTest_name" id="mpr_phyTest_name" />
                    <input type="hidden" name="mpr_phyTest_cost" id="mpr_phyTest_cost" />
                    <input type="hidden" name="mpr_client_organisation" id="mpr_client_organisation" />
                    <input type="hidden" name="mpr_client_pic" id="mpr_client_pic" />
                    <input type="hidden" name="mpr_client_address" id="mpr_client_address" />
                    <input type="hidden" name="mpr_client_postcode" id="mpr_client_postcode" />
                    <input type="hidden" name="mpr_client_city" id="mpr_client_city" />
                    <input type="hidden" name="mpr_client_state" id="mpr_client_state" />
                    <input type="hidden" name="mpr_client_phoneNo" id="mpr_client_phoneNo" />
                    <input type="hidden" name="mpr_client_faxNo" id="mpr_client_faxNo" />
                    <input type="hidden" name="mpr_phyRep_totalSample" id="mpr_phyRep_totalSample" />
                    <input type="hidden" name="mpr_timeReceived" id="mpr_timeReceived" />
                    <input type="hidden" name="mpr_timeStarted" id="mpr_timeStarted" />
                    <input type="hidden" name="mpr_timeCompleted" id="mpr_timeCompleted" />
                    <input type="hidden" name="mpr_phyRep_physical" id="mpr_phyRep_physical" />
                    <input type="hidden" name="mpr_phyRep_quantity" id="mpr_phyRep_quantity" />
                    <input type="hidden" name="mpr_phyRep_color" id="mpr_phyRep_color" />
                    <input type="hidden" name="mpr_phyRep_other" id="mpr_phyRep_other" />
                    <input type="hidden" name="mpr_name_technical_manager" id="mpr_name_technical_manager" />
                    <input type="hidden" name="mpr_name_technical_manager2" id="mpr_name_technical_manager2" />
                    <input type="hidden" name="mpr_name_quality_manager" id="mpr_name_quality_manager" />
                    <input type="hidden" name="mpr_name_head_unit" id="mpr_name_head_unit" />
                    <input type="hidden" name="mpr_profile_designation" id="mpr_profile_designation" />
                    <input type="hidden" name="mpr_lab_quality_manager" id="mpr_lab_quality_manager" />
                    <input type="hidden" name="mpr_wfTrans_id" id="mpr_wfTrans_id" />
                    <input type="hidden" name="mpr_wfTask_id" id="mpr_wfTask_id" />
                    <input type="hidden" name="mpr_wfTask_status" id="mpr_wfTask_status" />
                    <input type="hidden" name="mpr_wfTaskType_id" id="mpr_wfTaskType_id" />
                    <input type="hidden" name="mpr_phyRep_cycle" id="mpr_phyRep_cycle" />                
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </button>
                            <button type="submit" class="btn btn-labeled btn-warning" id="phyCover" name="phyCover">
                                <span class="btn-label"><i class="fa fa-envelope-o"></i></span>Cover Letter
                            </button>
                            <button type="submit" class="btn btn-labeled btn-primary" id="phyReport" name="phyReport">
                                <span class="btn-label"><i class="fa fa-folder-open-o"></i></span>Report
                            </button>                            
                            <button type="submit" class="btn btn-labeled btn-success" id="phyMemo" name="phyMemo">
                                <span class="btn-label"><i class="glyphicon glyphicon-briefcase"></i></span>Memorandum
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
                