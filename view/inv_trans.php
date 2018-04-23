<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>Inventory</li><li>Inventory Transaction</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-barcode fa-fw "></i> 
                Inventory
                <span>> 
                    Inventory Transaction
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
                                    <h5 class="padding-5 vtr_lbl_summary vtr_lbl_summary_ text-bold"> All Transaction <span class="txt-color-blue"><i class="fa fa-random" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvtr_summary" id="lvtr_summary_" onclick="f_vtr_summary_click('', 'All Transaction');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 vtr_lbl_summary vtr_lbl_summary_1"> Items Purchased <span class="txt-color-green"><i class="fa fa-dollar" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvtr_summary" id="lvtr_summary_1" onclick="f_vtr_summary_click('1', 'Items Purchased');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 vtr_lbl_summary vtr_lbl_summary_2"> Items Consumed <span class="txt-color-red"><i class="fa fa-shopping-cart" style="width:24px"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lvtr_summary" id="lvtr_summary_2" onclick="f_vtr_summary_click('2', 'Items Consumed');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="well padding-10">
                    <form id="form_vtr_search">
                        <h5 class="margin-top-0"><i class="fa fa-search"></i> Search...</h5>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="vtr_srch_no" id="vtr_srch_no" placeholder="Transaction No"></div>
                        <div class="padding-bottom-10"><input type="text" class="form-control" name="vtr_srch_item" id="vtr_srch_item" placeholder="Item Name"></div>
                        <div class="padding-bottom-10">
                            <select class="form-control select2" name="vtr_srch_cate" id="vtr_srch_cate" style="width:100%"></select>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-labeled btn-default" id="vtr_btn_search">
                                <span class="btn-label"><i class="fa fa-search"></i></span>Search
                            </button>
                        </div>
                    </form>
                </div>
            </article>
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-vtr1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Inventory Transaction List : <span class="text-italic" id="vtr_table_header"></span> &nbsp;<span class="font-xs text-danger" id="vtr_table_title"></span></h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_mvt_load_inventory_trans(1,'','','vtr');" rel="tooltip" data-placement="left" data-original-title="Perform Inventory Transaction"><i class="fa fa-plus"></i> Perform Inventory Transaction</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_vtr" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><select class="form-control" id="vtr_srchdt_cate" style="width:100%"></select></th>
                                            <th>
                                                <select class="form-control" style="width:100%">
                                                    <option value=""></option>
                                                    <option value="Purchased">Purchased</option>
                                                    <option value="Consumed">Consumed</option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control" id="vtr_dateReceived" readonly /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th width="30px">No.</th>                   
                                            <th width="10%" data-class="expand">Transaction No.</th>             
                                            <th>Item Name</th>   
                                            <th data-hide="phone,tablet" width="15%">Inventory Category</th>   
                                            <th width="10%">Type</th>      
                                            <th style="width: 88px; min-width: 88px">Transaction Time</th>  
                                            <th data-hide="phone" width="8%">Stock</th>   
                                            <th width="8%">Purchased / Taken</th>   
                                            <th data-hide="phone,tablet" width="8%">Balance</th>    
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
    include 'view/modal/modal_inv.php';
    include 'view/modal/modal_inv_transaction.php';
?>