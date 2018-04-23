<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>AOTD</li><li>Analytical Testing Services</li><li>Lab Manager</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-flask fa-fw "></i> 
                Analytical Testing Services
                <span>> 
                    Laboratory Manager
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-12">						
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-alm1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>Laboratory Information</h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_mle_load_lab(2, alm_lab_id.value, 'alm');" rel="tooltip" data-placement="left" data-original-title="Edit Laboratory Information"><i class="fa fa-edit"></i> Edit Information</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body">      
                            <form class="form-horizontal padding-bottom-10">
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Lab ID</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_lab_id"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_lab_name"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Laboratory Description</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_lab_desc"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Head of Unit</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_name_head_unit"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Quality Manager</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_name_quality_manager"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Technical Manager I</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_name_technical_manager"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Technical Manager II</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_name_technical_manager2"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Research Officer</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_name_research_officer"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Laboratory Supervisor</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lalm_name_supervisor"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="alm_lab_id" id="alm_lab_id" />
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-alm2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Test List &nbsp;<span class="font-xs text-danger" id="alm_table_title"></span></h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_malt_load_test(1,'','alm');" rel="tooltip" data-placement="left" data-original-title="Add new Test"><i class="fa fa-plus-square"></i> Add Test</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_alm" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th>
                                                <select class="form-control" id="alm_statusName" style="width: 100%"></select>
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th data-hide="phone" width="30px">No.</th>         
                                            <th data-class="expand" width="8%">Test ID</th>               
                                            <th >Test Name</th>   
                                            <th data-hide="phone,tablet" width="20%">Test Method</th>
                                            <th data-hide="phone" width="10%">Total Component</th>
                                            <th width="10%">Cost</th>
                                            <th style="width: 88px; max-width: 88px">Status</th>
                                            <th style="width: 34px; max-width: 34px">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>									
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
<?php 
    include 'view/modal/modal_lab_edit.php';
    include 'view/modal/modal_ats_lab_test.php';
    include 'view/modal/modal_ats_lab_component.php';
?>
