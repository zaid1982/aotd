<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>Home</li><li>AOTD</li><li>Biodegradation Testing Services</li><li>Sample Log-in</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-flask fa-fw "></i> 
                Biodegradation Testing Services
                <span>> 
                    Sample Log-in
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-3">
                <div class="well">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 blg_lbl_summary blg_lbl_summary_2 text-bold"> Draft <span class="txt-color-red"><i class="fa fa-certificate"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lblg_summary" id="lblg_summary_2" onclick="f_blg_summary_click('2', 'Draft');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 blg_lbl_summary blg_lbl_summary_42"> Completed Certificate <span class="txt-color-green"><i class="fa fa-certificate"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lblg_summary" id="lblg_summary_42" onclick="f_blg_summary_click('42', 'Completed Certificate');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
<!--                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 blg_lbl_summary blg_lbl_summary_4"> Current Running Certificate <span class="txt-color-blueLight"><i class="fa fa-certificate"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lblg_summary" id="lblg_summary_4" onclick="f_blg_summary_click('4', 'Current Running Certificate');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 blg_lbl_summary blg_lbl_summary_48"> Validation <span class="txt-color-pinkDark"><i class="fa fa-certificate"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lblg_summary" id="lblg_summary_48" onclick="f_blg_summary_click('48', 'Validation');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>-->
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 blg_lbl_summary blg_lbl_summary_50"> Incomplete <span class="txt-color-red"><i class="fa fa-certificate"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lblg_summary" id="lblg_summary_50" onclick="f_blg_summary_click('50', 'Incomplete');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="well padding-10">
                    <form id="form_blg_search">
                        <h5 class="margin-top-0"><i class="fa fa-search"></i> Search...</h5>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="blg_srch_no" id="blg_srch_no" placeholder="Certificate No."></div>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="blg_srch_customer" id="blg_srch_customer" placeholder="Customer"></div>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="blg_srch_pic" id="blg_srch_pic" placeholder="Attention"></div>
                        <div class="text-right">
                            <button type="button" class="btn btn-labeled btn-default" id="blg_btn_search">
                                <span class="btn-label"><i class="fa fa-search"></i></span>Search
                            </button>
                        </div>
                    </form>
                </div>
            </article>
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-blg1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Certificate List : <span class="text-italic" id="blg_table_header"></span> &nbsp;<span class="font-xs text-danger" id="blg_table_title"></span></h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_mbsl_load_sample_login(1,'','blg');" rel="tooltip" data-placement="left" data-original-title="Create new Sample Set"><i class="fa fa-plus-square"></i> Add New Sample Set</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_blg" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="5" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>                                            
                                            <th><input type="text" class="form-control" id="blg_dateReceived" readonly /></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th width="30px">No.</th>         
                                            <th data-class="expand">Certificate No.</th>               
                                            <th data-hide="phone" width="9%">Number of Sample</th>   
                                            <th data-hide="phone,tablet" width="24%">Customer Name</th>
                                            <th data-hide="phone,tablet" width="18%">Attention</th>
                                            <th style="width: 88px; min-width: 88px">Date Received</th>
                                            <th style="width: 58px; max-width: 58px">Status</th>
                                            <th style="width: 53px; min-width: 53px">&nbsp;</th> 
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
    include 'view/modal/modal_bio_certificate.php';
    include 'view/modal/modal_bio_sample_login.php';
?>
      