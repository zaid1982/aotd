<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>System Management</li><li>Email Management</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-cogs fa-fw "></i> 
                System Management
                <span>> 
                    Email Management
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-smc" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Email Notification List</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_smc" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th><input type="text" class="form-control" maxlength="100" /></th>
                                            <th>
                                                <select class="form-control">
                                                    <option value=""></option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th width="30px">No.</th>                   
                                            <th>Email Type</th> 
                                            <th data-hide="phone" width="25%">Email Title</th>  
                                            <th data-hide="phone" width="45%">Email Text</th>   
                                            <th style="width: 58px; max-width: 58px">Status</th> 
                                            <th style="width: 28px; min-width: 28px">&nbsp;</th>  
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
    include 'view/modal/modal_email_noti.php';
?>