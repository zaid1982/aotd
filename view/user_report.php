<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>User Management</li><li>User Information Report</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-users fa-fw "></i> 
                User Management
                <span>> 
                    User Information Report
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-urp1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>User Information Report</h2>
                    </header>
                    <div>
                        <div class="widget-body">
                            <form class="form-horizontal" id="form_urp_search" method="post" target="_blank" action="pdf/report.php">
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">User Status</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm" name="urp_srch_status" id="urp_srch_status">
                                            <option value="" selected>All Status</option>
                                            <option value="P">Approved</option>
                                            <option value="K">Keep In View</option>
                                            <option value="S">Suspended</option>
                                            <option value="R">Registered</option>
                                        </select>
                                    </div>
                                </div> 
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Order By</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm" name="urp_srch_order1" id="urp_srch_order1">
                                            <option value="" selected></option>
                                            <option value="username">Username</option>
                                            <option value="status">User Status</option>
                                            <option value="organisation">Organisation</option>
                                            <option value="specialisation">Specialisation</option>
                                            <option value="designation">Designation</option>
                                            <option value="dateSort">Date Created</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">&nbsp;</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm no-gray" name="urp_srch_order2" id="urp_srch_order2">
                                            <option value="" selected></option>
                                            <option value="username">Username</option>
                                            <option value="status">User Status</option>
                                            <option value="organisation">Organisation</option>
                                            <option value="specialisation">Specialisation</option>
                                            <option value="designation">Designation</option>
                                            <option value="dateSort">Date Created</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">&nbsp;</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm no-gray" name="urp_srch_order3" id="urp_srch_order3">
                                            <option value="" selected></option>
                                            <option value="username">Username</option>
                                            <option value="status">User Status</option>
                                            <option value="organisation">Organisation</option>
                                            <option value="specialisation">Specialisation</option>
                                            <option value="designation">Designation</option>
                                            <option value="dateSort">Date Created</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="widget-footer">  
                                    <button type="submit" class="btn btn-labeled btn-primary" id="userReport" name="userReport" >
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