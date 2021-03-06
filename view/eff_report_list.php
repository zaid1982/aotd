<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>Home</li><li>AOTD</li><li>Efficacy Testing Services</li><li>Report List</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-flask fa-fw "></i> 
                Efficacy Testing Services
                <span>> 
                    Report List
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
                                    <h5 class="padding-5 frl_lbl_summary frl_lbl_summary_42 text-bold"> Completed Report <span class="txt-color-green"><i class="fa fa-certificate"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lfrl_summary" id="lfrl_summary_42" onclick="f_frl_summary_click('42', 'Completed Report');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>                        
                    </div>
                </div>
                <div class="well padding-10">
                    <form id="form_frl_search">
                        <h5 class="margin-top-0"><i class="fa fa-search"></i> Search...</h5>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="frl_srch_no" id="frl_srch_no" placeholder="Report No."></div>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="frl_srch_customer" id="frl_srch_customer" placeholder="Customer"></div>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="frl_srch_pic" id="frl_srch_pic" placeholder="Attention"></div>
                        <div class="text-right">
                            <button type="button" class="btn btn-labeled btn-default" id="frl_btn_search">
                                <span class="btn-label"><i class="fa fa-search"></i></span>Search
                            </button>
                        </div>
                    </form>
                </div>
            </article>
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-frl1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Report List : <span class="text-italic" id="frl_table_header"></span> &nbsp;<span class="font-xs text-danger" id="frl_table_title"></span></h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_frl" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="5" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>                                            
                                            <th><input type="text" class="form-control" id="frl_dateReceived" readonly /></th>
                                            <!--<th></th>-->
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th data-hide="phone" width="30px">No.</th>         
                                            <th data-class="expand">Report No.</th>               
                                            <th data-hide="phone" width="9%">Number of Sample</th>   
                                            <th data-hide="phone,tablet" width="24%">Customer Name</th>
                                            <th data-hide="phone,tablet" width="18%">Attention</th>
                                            <th style="width: 88px; min-width: 88px">Date Received</th>
                                            <!--<th style="width: 58px; max-width: 58px">Status</th>-->
                                            <th style="width: 32px; min-width: 32px">&nbsp;</th>
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
    include 'view/modal/modal_eff_report.php';
    include 'view/modal/modal_eff_sample_login.php';
?>
      