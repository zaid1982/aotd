<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>AOTD</li><li>Ecotoxicity Testing Services</li><li>Lab Manager</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-flask fa-fw "></i> 
                Ecotoxicity Testing Services
                <span>> 
                    Laboratory Manager
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-12">						
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-elm1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>Laboratory Information</h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_mle2_load_lab(2, elm_lab_id.value, 'elm');" rel="tooltip" data-placement="left" data-original-title="Edit Laboratory Information"><i class="fa fa-edit"></i> Edit Information</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body">      
                            <form class="form-horizontal padding-bottom-10">
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Lab ID</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lelm_lab_id"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Laboratory Name</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lelm_lab_name"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Laboratory Description</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lelm_lab_desc"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Head of Unit</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lelm_name_head_unit"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Quality Manager</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lelm_name_quality_manager"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Research Officer</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lelm_name_research_officer"></span>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-md-3 control-label font-sm"><strong>Cost</strong></label>
                                    <div class="col-md-9 control-label font-sm text-align-left">
                                        <span id="lelm_lab_cost"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="elm_lab_id" id="elm_lab_id" />
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
<?php 
    include 'view/modal/modal_lab_edit2.php';
?>
    