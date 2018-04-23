<div class="modal fade" id="modal_icert_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="modal_title_casis">&nbsp; <span id=''></span> Certificate List</h4>
            </div>
            <div class="modal-body padding-gutter modal-fixHeight">
                <section id="widget-grid"> 
                    <div class="row">
                        <article class="col-md-12">						
                            <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-alm1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                                    <h2>Certificate Information</h2>
                                </header>
                                <div>
                                    <div class="widget-body">      
                                        <form class="form-horizontal mism_infoView" id="form_lmism" method="post" target="_blank" action="process/pdf/report.php">
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Certificate No</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="atsCert_no"></span>
                                                </div>
                                                <input type="hidden" id="lmism_atsCert_no" name="lmism_atsCert_no" />
                                                <input type="hidden" id="atsCert_no1" name="atsCert_no1" />
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Sample Status</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_status_desc"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Customer Name</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="client_organisation"></span>
                                                    <!--<span id="client_organisation1"></span>-->
                                                </div>
                                                <input type="hidden" id="lmism_client_organisation" name="lmism_client_organisation" />
                                                <input type="hidden" id="lmism_client_address" name="lmism_client_address" />
                                                <input type="hidden" id="lmism_client_postcode" name="lmism_client_postcode" />
                                                <input type="hidden" id="lmism_client_city" name="lmism_client_city" />
                                                <input type="hidden" id="lmism_client_state" name="lmism_client_state" />
                                                <input type="hidden" id="client_organisation1" name="client_organisation1" />
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Attention</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="client_pic"></span>
                                                </div>
                                                <input type="hidden" id="lmism_client_pic" name="lmism_client_pic" />
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Accredited</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_accrediteds"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Analyst</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_profile_fullname"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Equipment</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_equipments"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Chemical/Glassware/Reagent</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_chemicals"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Sample Condition</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_condition"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Remarks</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_remark"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Number of Sample</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_totalSample"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Date Received</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_timeReceived"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Days Taken</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="lmism_atsCert_days"></span>
                                                </div>
                                            </div>
                                            <div class="form-group no-margin">
                                                <label class="col-md-3 control-label"><strong>Date Reported</strong></label>
                                                <div class="col-md-9 control-label text-align-left">
                                                    <span id="atsCert_timeReported"></span>
                                                </div>
                                                <input type="hidden" id="lmism_atsCert_timeReported" name="lmism_atsCert_timeReported" />
                                            </div>
                                            <input type="hidden" name="lmism_atsCert_id" id="lmism_atsCert_id" />
                                            <input type="hidden" id="lmism_atsTest_name" name="lmism_atsTest_name" />
                                            <input type="hidden" id="lmism_atsTest_cat" name="lmism_atsTest_cat" />
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-xs btn-success malt_editView" data-placement="left" data-original-title="Certificate View" name="certificate"><i class="fa fa-certificate"></i> Certificate</button>
                                                <!--<a href="javascript:void(0);" class="btn btn-xs btn-success  malt_editView" onclick="f_malc_load_component(1, '', 'malt');" rel="tooltip" data-placement="left" data-original-title="Certificate View"><i class="fa fa-certificate"></i> Certificate</a>&nbsp;&nbsp;-->
                                                <!--<a href="javascript:void(0);" class="btn btn-xs btn-warning  malt_editView" onclick="f_malc_load_component(1, '', 'malt');" rel="tooltip" data-placement="left" data-original-title="Download Certificate"><i class="fa fa-file-pdf-o"></i> Digital Copy</a>-->
                                            </div><br>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
                <h6>Test Result</h6>
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
<!--                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_malt_component" class="table table-bordered table-hover margin-bottom-5" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center bg-color-teal txt-color-white" rowspan="2" width="30px">No.</th>
                                    <th class="text-center bg-color-teal txt-color-white">Lab Code</th>
                                    <th class="text-center bg-color-teal txt-color-white">QEA/ATS/INT/NAC/114-17/01</th>
                                    <th class="text-center bg-color-teal txt-color-white">QEA/ATS/INT/NAC/114-17/02</th>
                                    <th class="text-center bg-color-teal txt-color-white">QEA/ATS/INT/NAC/114-17/03</th>
                                    <th class="text-center bg-color-teal txt-color-white" rowspan="2" style="width: 68px; max-width: 68px">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th class="text-center bg-color-teal txt-color-white">Sample Code</th>
                                    <th class="text-center bg-color-teal txt-color-white">PKC (Method Firdaus)</th>
                                    <th class="text-center bg-color-teal txt-color-white">PKC Filter (Method Firdaus)</th>
                                    <th class="text-center bg-color-teal txt-color-white">PKC Centrifuge (Method Firdaus)</th>
                                </tr>
                            </thead>
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>-->
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
                <!--                <div class="form-actions margin-top-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                                            </a>
                                            <button type="button" class="btn btn-labeled btn-success" id="">
                                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                                            </button>
                                        </div>
                                    </div>
                                </div>-->
            </div> 

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->