<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>Customer Management</li><li>Customer Report</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-suitcase fa-fw "></i> 
                Customer Management
                <span>> 
                    Customer Report
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-crp1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>Customer Information Report</h2>
                    </header>
                    <div>
                        <div class="widget-body">
                            <form class="form-horizontal" id="form_crp_search" method="post" target="_blank" action="pdf/report.php">
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Category Name</label>
                                    <div class="col-md-7">   
                                        <select class="form-control input-sm" name="crp_srch_group" id="crp_srch_group"></select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Status</label>
                                    <div class="col-md-4">   
                                        <select class="form-control input-sm" name="crp_srch_status" id="crp_srch_status">
                                            <option value="" selected>All Status</option>
                                            <option value="1">Blacklisted</option>
                                            <option value="0">Not Blacklisted</option>
                                        </select>
                                    </div>
                                </div> 
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Order By</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm" name="crp_srch_order1" id="crp_srch_order1">
                                            <option value="" selected></option>
                                            <option value="client_black">Blacklisted</option>
                                            <option value="clientCategory">Category Name</option>
                                            <option value="client_organisation">Customer</option>
                                            <option value="client_timeCreated">Date Created</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">&nbsp;</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm no-gray" name="crp_srch_order2" id="crp_srch_order2">
                                            <option value="" selected></option>
                                            <option value="client_black">Blacklisted</option>
                                            <option value="clientCategory">Category Name</option>
                                            <option value="client_organisation">Customer</option>
                                            <option value="client_timeCreated">Date Created</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">&nbsp;</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm no-gray" name="crp_srch_order3" id="crp_srch_order3">
                                            <option value="" selected></option>
                                            <option value="client_black">Blacklisted</option>
                                            <option value="clientCategory">Category Name</option>
                                            <option value="client_organisation">Customer</option>
                                            <option value="client_timeCreated">Date Created</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="widget-footer">  
                                    <button type="submit" class="btn btn-labeled btn-primary" id="custReport" name="custReport" >
                                        <span class="btn-label"><i class="fa fa-file-pdf-o"></i></span>Generate Report
                                    </button>
                                     <button type="reset" class="btn btn-labeled btn-warning">
                                        <span class="btn-label"><i class="fa fa-refresh"></i></span>Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
            </article>
        </div>
    </section>
</div>