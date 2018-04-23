<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Home</li><li>User Management</li><li>User Management</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-users fa-fw "></i> 
                User Management
                <span>> 
                    User Management
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
                                    <h5 class="padding-5 umg_lbl_summary umg_lbl_summary_ text-bold"> All Users <span class="txt-color-blue"><i class="fa fa-user"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lumg_summary" id="lumg_summary_" onclick="f_umg_summary_click('', 'Semua Pengguna');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 umg_lbl_summary umg_lbl_summary_1"> Active User <span class="txt-color-green"><i class="fa fa-user"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lumg_summary" id="lumg_summary_1" onclick="f_umg_summary_click('1', 'Pengguna Aktif');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12">
                            <ul id="sparks" class="pull-left">
                                <li class="sparks-info">
                                    <h5 class="padding-5 umg_lbl_summary umg_lbl_summary_0"> Inactive User <span class="txt-color-red"><i class="fa fa-user"></i>&nbsp;&nbsp;<a href="javascript:void(0)" class="lumg_summary" id="lumg_summary_0" onclick="f_umg_summary_click('0', 'Pengguna Tidak Aktif');" rel="tooltip" data-placement="right" data-original-title="Click to view report">0</a></span></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="well padding-10">
                    <h5 class="margin-top-0"><i class="fa fa-search"></i> Search Name</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Name" id="umg_srch_name" rel="tooltip" data-placement="bottom" data-original-title="Search for Name">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" rel="tooltip" data-placement="right" data-original-title="Click to search..." id="umg_btn_search">
                                <i class="fa fa-search"></i>
                            </button> 
                        </span>
                    </div>
                </div>
<!--                <div class="well padding-10">
                    <h5 class="margin-top-0"><i class="fa fa-search"></i> Search...</h5>
                    <div class="padding-bottom-10"><input type="text" class="form-control" placeholder="Name"></div>
                    <div class="text-right">
                        <button type="button" class="btn btn-labeled btn-default" id="">
                            <span class="btn-label"><i class="fa fa-search"></i></span>Search
                        </button>
                    </div>
                </div>-->
            </article>
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-umg1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>User List : <span class="text-italic" id="umg_table_header"></span> &nbsp;<span class="font-xs text-danger" id="umg_table_title"></span></h2>
                        <div class="widget-toolbar">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="f_mus_load_user(1,'','umg');" rel="tooltip" data-placement="left" data-original-title="Create new Internal User"><i class="fa fa-user-plus"></i> Add Internal User</a>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">                                
                                <table id="datatable_umg" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th><input type="text" class="form-control" maxlength="50" /></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th width="30px">No.</th>         
                                            <th data-class="expand" width="12%">Username</th>               
                                            <th >Full Name</th>   
                                            <th data-hide="phone,tablet" width="14%">Designation</th>
                                            <th data-hide="phone,tablet" width="18%">Department</th>
                                            <th data-hide="phone" width="14%">Role</th>
                                            <th style="width: 50px; max-width: 50px">Status</th>
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