<div class="modal fade" id="modal_ana_cert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="modal_title_casis"><i class='fa fa-certificate'></i>&nbsp; Certificate List</h4>
            </div>
            <div class="modal-body modal-fixHeight">
                <h6>Information</h6>
                <div class="well well-light">
                    <form class="form-horizontal macl_infoView">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Certificate No.</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_no"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_lab_name"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Number of Sample</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_totalSample"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Customer Name</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_client_organisation"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Attention</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_client_pic"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Analyst</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_profile_fullname"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Sample Status</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_status_desc"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Accredited</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_accrediteds"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Equipment</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_equipments"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Chemical / Glassware / Reagent</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_chemicals"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">      
                                    <label class="col-md-6 control-label"><strong>Sample Condition</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_condition"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Remarks</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_remark"></span> 
                                    </div>
                                </div>  
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Date Received</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_timeReceived"></span> 
                                    </div>
                                </div>
<!--                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Quality Manager</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_name_quality_manager"></span> 
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-6 control-label"><strong>Accredited</strong></label>
                                    <div class="col-md-6 control-label text-align-left">
                                        <span id="lmacl_atsCert_accredited"></span> 
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer padding-10">
                <form class="form-horizontal" id="form_macl" method="post" target="_blank" action="pdf/ana.php">
                    <input type="hidden" name="macl_atsCert_id" id="macl_atsCert_id" />
                    <input type="hidden" name="macl_atsCert_no" id="macl_atsCert_no" />
                    <input type="hidden" name="macl_lab_name" id="macl_lab_name" />
                    <input type="hidden" name="macl_client_pic" id="macl_client_pic" />
                    <input type="hidden" name="macl_client_organisation" id="macl_client_organisation" />
                    <input type="hidden" name="macl_client_address" id="macl_client_address" />
                    <input type="hidden" name="macl_client_postcode" id="macl_client_postcode" />
                    <input type="hidden" name="macl_client_city" id="macl_client_city" />
                    <input type="hidden" name="macl_client_state" id="macl_client_state" />
                    <input type="hidden" name="macl_client_phoneNo" id="macl_client_phoneNo" />
                    <input type="hidden" name="macl_client_faxNo" id="macl_client_faxNo" />
                    <input type="hidden" name="macl_timeReceived" id="macl_timeReceived" />
                    <input type="hidden" name="macl_timeReported" id="macl_timeReported" />
                    <input type="hidden" name="macl_timeReported2" id="macl_timeReported2" />
                    <input type="hidden" name="macl_name_head_unit" id="macl_name_head_unit" />
                    <input type="hidden" name="macl_name_quality_manager" id="macl_name_quality_manager" />
                    <input type="hidden" name="macl_name_technical_manager2" id="macl_name_technical_manager2" />
                    <input type="hidden" name="macl_name_research_officer" id="macl_name_research_officer" />
                    <input type="hidden" name="macl_profile_designation" id="macl_profile_designation" />
                    <input type="hidden" name="macl_atsCert_totalSample" id="macl_atsCert_totalSample" />
                    <input type="hidden" name="macl_atsCert_physical" id="macl_atsCert_physical" />
                    <input type="hidden" name="macl_atsCert_quantity" id="macl_atsCert_quantity" />
                    <input type="hidden" name="macl_atsCert_color" id="macl_atsCert_color" />
                    <input type="hidden" name="macl_atsCert_other" id="macl_atsCert_other" />
                    <input type="hidden" name="macl_atsCert_remark" id="macl_atsCert_remark" />
                    <input type="hidden" name="macl_wfTrans_id" id="macl_wfTrans_id" />
                    <input type="hidden" name="macl_wfTask_id" id="macl_wfTask_id" />
                    <input type="hidden" name="macl_wfTask_status" id="macl_wfTask_status" />
                    <input type="hidden" name="macl_wfTaskType_id" id="macl_wfTaskType_id" />
                    <input type="hidden" name="macl_atsCert_cycle" id="macl_atsCert_cycle" />
                    <input type="hidden" name="macl_timeprint" id="macl_timeprint" />
                    <input type="hidden" name="macl_atsCert_condition" id="macl_atsCert_condition" />
                    <input type="hidden" name="macl_atsCert_remark" id="macl_atsCert_remark" />
                    <input type="hidden" name="lmacl_name_quality_manager" id="lmacl_name_quality_manager" />
                    <input type="hidden" name="macl_quality_manager_designation" id="macl_quality_manager_designation" />
                    <input type="hidden" name="macl_atsCert_accredited" id="macl_atsCert_accredited" />
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </button>
                            <button type="submit" class="btn btn-labeled btn-primary" id="anaCert" name="anaCert">
                                <span class="btn-label"><i class="fa fa-certificate"></i></span>Certificate
                            </button>
                            <button type="submit" class="btn btn-labeled btn-warning" id="anaCover" name="anaCover">
                                <span class="btn-label"><i class="fa fa-envelope-o"></i></span>Cover Letter
                            </button>
                            <button type="submit" class="btn btn-labeled btn-success" id="anaMemo" name="anaMemo">
                                <span class="btn-label"><i class="fa fa-briefcase"></i></span>Memorandum
                            </button>
                            <button type="submit" class="btn btn-labeled btn-info" id="anaDigital" name="anaDigital">
                                <span class="btn-label"><i class="fa fa-file-pdf-o"></i></span>Digital Copy
                            </button>
                            <!-- <button type="submit" class="btn btn-xs btn-primary malt_editView" data-placement="left" data-original-title="Cover Letter View" name="coverletter"><i class="fa fa-file-pdf-o"></i> Cover Letter</button>
                            <button type="submit" class="btn btn-xs btn-success malt_editView" data-placement="left" data-original-title="Certificate View" name="certificate"><i class="fa fa-certificate"></i> Certificate</button>
                            <button type="submit" class="btn btn-xs btn-warning malt_editView" data-placement="left" data-original-title="Digital Copy View" name="digital"><i class="fa fa-file-pdf-o"></i> Digital Copy</button>
                            <button type="submit" class="btn btn-xs btn-info malt_editView" data-placement="left" data-original-title="Memorandom View" name="memorandum"><i class="fa fa-certificate"></i> Memorandum</button>   -->                         
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>