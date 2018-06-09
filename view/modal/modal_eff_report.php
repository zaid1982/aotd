<!-- Modal -->
<div class="modal fade" id="modal_eff_report" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">  
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title"><i class='fa fa-certificate'></i>&nbsp; Efficacy Report Information</h4>
            </div>
            <div class="modal-body modal-fixHeight">  
                <h6>Information</h6>
                <div class="well well-light">
                    <form class="form-horizontal mer_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Report No.</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_timeReceived"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Completed</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_timeCompleted"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Physical Form</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_physical"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Quantity</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_quantity"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Colour</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_color"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Other</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_other"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Test</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effTest_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_status_desc"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-4 control-label"><strong>Date Started</strong></label>
                                    <div class="col-md-8 control-label text-align-left">
                                        <span id="lmer_effRep_timeStarted"></span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <div class="modal-footer padding-10">
                <form class="form-horizontal" id="form_mer" method="post" target="_blank" action="pdf/eff.php">
                    <input type="hidden" name="funct" id="mer_funct" />
                    <input type="hidden" name="mer_effRep_no" id="mer_effRep_no" />
                    <input type="hidden" name="mer_lab_name" id="mer_lab_name" />
                    <input type="hidden" name="mer_effTest_name" id="mer_effTest_name" />
                    <input type="hidden" name="mer_effTest_cost" id="mer_effTest_cost" />
                    <input type="hidden" name="mer_client_pic" id="mer_client_pic" />
                    <input type="hidden" name="mer_client_organisation" id="mer_client_organisation" />
                    <input type="hidden" name="mer_client_address" id="mer_client_address" />
                    <input type="hidden" name="mer_client_postcode" id="mer_client_postcode" />
                    <input type="hidden" name="mer_client_city" id="mer_client_city" />
                    <input type="hidden" name="mer_client_state" id="mer_client_state" />
                    <input type="hidden" name="mer_client_phoneNo" id="mer_client_phoneNo" />
                    <input type="hidden" name="mer_client_faxNo" id="mer_client_faxNo" />
                    <input type="hidden" name="mer_timeReceived" id="mer_timeReceived" />
                    <input type="hidden" name="mer_timeStarted" id="mer_timeStarted" />
                    <input type="hidden" name="mer_timeCompleted" id="mer_timeCompleted" />
                    <input type="hidden" name="mer_name_head_unit" id="mer_name_head_unit" />
                    <input type="hidden" name="mer_name_quality_manager" id="mer_name_quality_manager" />
                    <input type="hidden" name="mer_name_technical_manager2" id="mer_name_technical_manager2" />
                    <input type="hidden" name="mer_profile_designation" id="mer_profile_designation" />
                    <input type="hidden" name="mer_effRep_totalSample" id="mer_effRep_totalSample" />
                    <input type="hidden" name="mer_effRep_physical" id="mer_effRep_physical" />
                    <input type="hidden" name="mer_effRep_quantity" id="mer_effRep_quantity" />
                    <input type="hidden" name="mer_effRep_color" id="mer_effRep_color" />
                    <input type="hidden" name="mer_effRep_other" id="mer_effRep_other" />
                    <input type="hidden" name="mer_wfTrans_id" id="mer_wfTrans_id" />
                    <input type="hidden" name="mer_wfTask_id" id="mer_wfTask_id" />
                    <input type="hidden" name="mer_wfTask_status" id="mer_wfTask_status" />
                    <input type="hidden" name="mer_wfTaskType_id" id="mer_wfTaskType_id" />
                    <input type="hidden" name="mer_effRep_cycle" id="mer_effRep_cycle" />
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </button>
                            <button type="submit" class="btn btn-labeled btn-warning" id="effCover" name="effCover">
                                <span class="btn-label"><i class="fa fa-envelope-o"></i></span>Cover Letter
                            </button>
                            <button type="submit" class="btn btn-labeled btn-primary" id="effReport" name="effReport">
                                <span class="btn-label"><i class="fa fa-folder-open-o"></i></span>Report
                            </button>                            
                            <button type="submit" class="btn btn-labeled btn-success" id="effMemo" name="effMemo">
                                <span class="btn-label"><i class="glyphicon glyphicon-briefcase"></i></span>Memorandum
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
                