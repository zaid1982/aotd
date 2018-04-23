<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>Inventory</li><li>Inventory Category</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-barcode fa-fw "></i> 
                Inventory
                <span>> 
                    Inventory Category
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
                                    <h5 class="padding-5 vct_lbl_summary vct_lbl_summary_ text-bold"> All Category <span class="txt-color-blue"><i class="fa fa-tags" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvct_summary" id="lvct_summary_" onclick="f_vct_summary_click('', 'All Users');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 vct_lbl_summary vct_lbl_summary_1"> Active Category <span class="txt-color-green"><i class="fa fa-tag" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvct_summary" id="lvct_summary_1" onclick="f_vct_summary_click('1', 'Active User');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 vct_lbl_summary vct_lbl_summary_0"> Inactive Category <span class="txt-color-red"><i class="fa fa-tag" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvct_summary" id="lvct_summary_0" onclick="f_vct_summary_click('0', 'Inactive User');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="well padding-10">
                    <h5 class="margin-top-0"><i class="fa fa-search"></i> Search Category</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Category" id="vct_srch_name" rel="tooltip" data-placement="bottom" data-original-title="Search for Category">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" rel="tooltip" data-placement="right" data-original-title="Click to search..." id="vct_btn_search">
                                <i class="fa fa-search"></i>
                            </button> 
                        </span>
                    </div>
                </div>
            </article>
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-vct1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Inventory Category List : <span class="text-italic" id="vct_table_header"></span> &nbsp;<span class="font-xs text-danger" id="vct_table_title"></span></h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_mvc_load_inventory_category(1,'','vct');" rel="tooltip" data-placement="left" data-original-title="Create new Inventory Category"><i class="fa fa-plus"></i> Add Inventory Category</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_vct" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th width="40px">No.</th>                   
                                            <th>Inventory Category</th>   
                                            <th style="width: 100px; max-width: 100px">Status</th>
                                            <th style="width: 28px; max-width: 28px">&nbsp;</th>
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
    include 'view/modal/modal_inv_category.php';
?>