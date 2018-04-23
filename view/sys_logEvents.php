<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>System Management</li><li>Log Events Report</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-cogs fa-fw "></i> 
                System Management
                <span>> 
                    Log Events Report
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-slg1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Log Events Report</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_slg" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" id="slg_dateReceived" readonly /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><select class="form-control" id="slg_srchdt_module" style="width:100%"></select></th>
                                            <th><select class="form-control" id="slg_srchdt_action" style="width:100%"></select></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                        </tr>
                                        <tr>
                                            <th width="30px">No.</th>                   
                                            <th style="width: 160px; min-width: 160px" data-class="expand">Action Time</th> 
                                            <th>Action By</th>  
                                            <th data-hide="phone" width="13%">Module</th>   
                                            <th width="15%">Action</th>      
                                            <th data-hide="phone" width="8%">IP Address</th>   
                                            <th data-hide="phone" width="10%">Location</th>   
                                            <th data-hide="phone,tablet" width="18%">Remarks</th>    
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
