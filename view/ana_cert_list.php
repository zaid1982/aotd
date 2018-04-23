<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>Home</li><li>AOTD</li><li>Analytical Testing Services</li><li>Certificate List</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-flask fa-fw "></i> 
                Analytical Testing Services
                <span>> 
                    Certificate List
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-afv" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-collapsed="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Completed Certificate</h2>
                    </header>
                    <div>             
                        <div class="widget-body no-padding">  
                            <div class="">  
                                <table id="datatable_acl" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><input type="text" class="form-control" maxlength="30" id="acl_certificate_no" /></th>
                                            <th><input type="text" class="form-control" maxlength="30" id="acl_sample_no" /></th>
                                            <th><input type="text" class="form-control" maxlength="30" id="acl_cust_name" /></th>
                                            <th><input type="text" class="form-control" maxlength="30" id="acl_attention" /></th>
                                            <th><input type="text" class="form-control" maxlength="30" id="acl_date" /></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th width="30px" class="text-align-center">No.</th>
                                            <th class="text-align-center">Certificate No</th>
                                            <th class="text-align-center">Number of Sample</th>
                                            <th class="text-align-center">Customer Name</th>
                                            <th class="text-align-center">Attention</th>
                                            <th class="text-align-center">Date Received</th>
                                            <th width="50px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>									
                                </table>  
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
<?
include 'view/modal/modal_icert_list.php';
?>
