<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>Inventory</li><li>Inventory Management</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-barcode fa-fw "></i> 
                Inventory
                <span>> 
                    Inventory Management
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
                                    <h5 class="padding-5 vmg_lbl_summary vmg_lbl_summary_ text-bold"> All Items <span class="txt-color-blue"><i class="fa fa-tags" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvmg_summary" id="lvmg_summary_" onclick="f_vmg_summary_click('', 'All Items');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 vmg_lbl_summary vmg_lbl_summary_1"> Active Items <span class="txt-color-green"><i class="fa fa-tag" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvmg_summary" id="lvmg_summary_1" onclick="f_vmg_summary_click('1', 'Active Items');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 vmg_lbl_summary vmg_lbl_summary_0"> Inactive Items <span class="txt-color-red"><i class="fa fa-tag" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvmg_summary" id="lvmg_summary_0" onclick="f_vmg_summary_click('0', 'Inactive Items');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="well padding-10">
                    <h5 class="margin-top-0"><i class="fa fa-search"></i> Search Item</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Item Name" id="vmg_srch_name" rel="tooltip" data-placement="bottom" data-original-title="Search for Item">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" rel="tooltip" data-placement="right" data-original-title="Click to search..." id="vmg_btn_search">
                                <i class="fa fa-search"></i>
                            </button> 
                        </span>
                    </div>
                </div>
            </article>
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-vmg1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Inventory Item List : <span class="text-italic" id="vmg_table_header"></span> &nbsp;<span class="font-xs text-danger" id="vmg_table_title"></span></h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_mvi_load_inventory(1,'','vmg');" rel="tooltip" data-placement="left" data-original-title="Create new Inventory Item"><i class="fa fa-plus"></i> Add Inventory Item</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_vmg" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><select class="form-control" id="vmg_srchdt_cate" style="width:100%"></select></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th width="30px">No.</th>                   
                                            <th data-class="expand">Item Name</th>             
                                            <th data-hide="phone" width="15%">Inventory Category</th>   
                                            <th data-hide="phone,tablet" width="8%">Form</th>      
                                            <th data-hide="phone,tablet" width="8%">Packing Size</th>  
                                            <th data-hide="phone,tablet" width="8%">Price</th>   
                                            <th data-hide="phone" width="8%">Balance</th>   
                                            <th data-hide="phone,tablet" width="8%">Min Level</th>    
                                            <th style="width: 50px; max-width: 50px">Status</th>
                                            <th style="width: 54px; max-width: 54px">&nbsp;</th>
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
    include 'view/modal/modal_inv.php';
    include 'view/modal/modal_inv_transaction.php';
?>