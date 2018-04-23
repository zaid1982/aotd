<div class="modal fade" id="modal_isample_mgmt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-color-blueLight txt-color-white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="modal_title_casis">&nbsp; <span id=''></span> Sample Manager</h4>
            </div>
            <div class="modal-body modal-fixHeight">
                <h6>Laboratory Information<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right malt_infoView" onclick="f_mism_edit(1);" rel="tooltip" data-placement="left" data-original-f_malt_edittitle="Edit Test Details"><i class="fa fa-edit"></i> Edit Test</a></h6>
                <div class="well well-light">
                    <form class="form-horizontal mism_infoView">
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Certificate No</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_lab_id"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Sample Status</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_lab_name"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Customer Name</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_lab_desc"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Attention</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_head_unit"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Accredited</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_quality_manager"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Analyst</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_technical_manager"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Equipment</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_technical_manager2"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Chemical/Glassware/Reagent</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_research_officer"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Sample Condition</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_supervisor"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Remarks</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_supervisor"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Number of Sample</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_supervisor"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Date Received</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_supervisor"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Days Taken</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_supervisor"></span>
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-md-3 control-label"><strong>Date Reported</strong></label>
                            <div class="col-md-9 control-label text-align-left">
                                <span id="lalm_name_supervisor"></span>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal mism_editView" id="form_mism_form">
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Certificate No</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control mism_viewOnly" name="" id="" disabled=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Sample Status</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control mism_viewOnly" name="" id="" disabled=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Attention</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control mism_viewOnly" name="" id="" disabled=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Accredited</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control mism_viewOnly" name="" id="" disabled/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Analyst</label>
                            <div class="col-md-9 selectContainer">
                                <select class="form-control mism_EditOnly" name="" id="">
                                    <option></option>
                                    <option>Khomsatun</option>
                                </select>
                            </div>   
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Equipment</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="" value="1">
                                    <span>Available</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="" value="41">
                                    <span>Not Available</span>  
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><font color="red">*</font> Chemical/Glassware/Reagent</label>
                            <div class="col-md-9">   
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="" value="1">
                                    <span>Available</span> 
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" class="radiobox" name="" value="41">
                                    <span>Not Available</span>  
                                </label>
                            </div>
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Sample Condition</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control" name="" id=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Remarks</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control" name="" id=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Number of Sample</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control mism_viewOnly" name="" id=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Date Received</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control mism_viewOnly" name="" id=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Day Taken</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control" name="" id=""/>
                            </div>   
                        </div>
                        <div class="form-group">      
                            <label class="col-md-3 control-label">Date Report</label>
                            <div class="col-md-9 selectContainer">
                                <input type="text" class="form-control" name="" id=""/>
                            </div>   
                        </div>
                    </form>
                </div>
<!--                <section id="widget-grid"> 
                    <div class="row">
                        <article class="col-md-12">						
                            <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-alm1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                                    <h2>Laboratory Information</h2>
                                    <div class="widget-toolbar">
                                        <a href="javascript:void(0);" class="btn btn-primary mism_infoView" onclick="f_malt_edit();" rel="tooltip" data-placement="left" data-original-title="Edit Laboratory Information"><i class="fa fa-edit"></i> Edit Information</a>
                                    </div>
                                </header>
                                <div>
                                    <div class="widget-body">      
                                        <form class="form-horizontal mism_infoView">
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <input type="hidden" name="" id="" />
                                        </form>
                                        
                                            
                                            
                                            
                                            
                                            
                                             
                                             
                                            
                                            
                                            
                                            
                                            
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>-->
                <h6>Test Result<a href="javascript:void(0);" class="btn btn-xs btn-primary pull-right malt_editView" onclick="f_malc_load_component(1, '', 'malt');" rel="tooltip" data-placement="left" data-original-title="Add new Component"><i class="fa fa-plus-square"></i> Add Component</a></h6>
                <div class="row">
                    <article class="col-md-12">
                        <table id="datatable_malt_component" class="table table-bordered table-hover margin-bottom-5" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center bg-color-teal txt-color-white" width="30px">No.</th>                    
                                    <th class="text-center bg-color-teal txt-color-white">Component Name</th>   
                                    <th class="text-center bg-color-teal txt-color-white" width="40%">Formula List</th>
                                    <th class="text-center bg-color-teal txt-color-white" style="width: 68px; max-width: 68px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody></tbody>									
                        </table>   
                    </article>
                </div>

                <div class="modal-footer padding-10">
                <form class="form-horizontal" id="form_mism">
                    <input type="hidden" name="funct" id="mism_funct" />
                    <input type="hidden" name="malt_atsTest_id" id="malt_atsTest_id" />
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                            <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                        </a>
                        <button type="button" class="btn btn-labeled btn-warning mism_editView" id="mism_btn_cancel" onclick="f_mism_edit(0);">
                            <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                        </button>
                        <button type="button" class="btn btn-labeled btn-success mism_editView" id="mism_btn_save">
                            <span class="btn-label"><i class="fa fa-save"></i></span>Save
                        </button>
                    </div>
                </div>
            </div>
            </div> 

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->