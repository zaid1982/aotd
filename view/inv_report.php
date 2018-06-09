<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>Inventory Management</li><li>Inventory Report</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-suitcase fa-fw "></i> 
                Inventory Management
                <span>> 
                    Inventory Report
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-itr1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>Inventory Transaction Report</h2>
                    </header>
                    <div>
                        <div class="widget-body">
                            <form class="form-horizontal" id="form_itr_search" method="post" target="_blank" action="pdf/report.php">
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Username</label>
                                    <div class="col-md-4">   
                                        <select class="form-control input-sm" name="itr_srch_usrnme" id="itr_srch_usrnme"></select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Inventory Category</label>
                                    <div class="col-md-4">   
                                        <select class="form-control input-sm" name="itr_srch_category" id="itr_srch_category"></select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Item Name</label>
                                    <div class="col-md-7">   
                                        <select class="form-control input-sm" name="itr_srch_item" id="itr_srch_item"></select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">From</label>
                                    <div class="col-md-3">   
                                        <select class="form-control input-sm" name="itr_srch_month1" id="itr_srch_month1">
                                            <option value="" selected></option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control input-sm" name="itr_srch_day1" id="itr_srch_day1">
                                            <option value="" selected></option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>                                                  
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control input-sm" name="itr_srch_year1" id="itr_srch_year1">
                                            <option value="" selected></option>
                                            <script>
                                                var date = new Date();
                                                var year = date.getFullYear();
                                                for (var i = year; i >= 2000; i--) {
                                                    document.write('<option value="' + i + '">' + i + '</option>');
                                                }
                                            </script>
                                        </select>                                                  
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">To</label>
                                    <div class="col-md-3">   
                                        <select class="form-control input-sm" name="itr_srch_month2" id="itr_srch_month2">
                                            <option value="" selected></option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control input-sm" name="itr_srch_day2" id="itr_srch_day2">
                                            <option value="" selected></option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>                                                  
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control input-sm" name="itr_srch_year2" id="itr_srch_year2">
                                            <option value="" selected></option>
                                            <script>
                                                var date = new Date();
                                                var year = date.getFullYear();
                                                for (var i = year; i >= 2000; i--) {
                                                    document.write('<option value="' + i + '">' + i + '</option>');
                                                }
                                            </script>
                                        </select>                                                  
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Order By</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm" name="itr_srch_order1" id="itr_srch_order1">
                                            <option value="" selected></option>
                                            <option value="date_trans">Date</option>
                                            <option value="inventory_type_id">Inventory Category</option>
                                            <option value="item_name">Item Name</option>
                                            <option value="user_name">Username</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">&nbsp;</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm no-gray" name="itr_srch_order2" id="itr_srch_order2">
                                            <option value="" selected></option>
                                            <option value="date_trans">Date</option>
                                            <option value="inventory_type_id">Inventory Category</option>
                                            <option value="item_name">Item Name</option>
                                            <option value="user_name">Username</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">&nbsp;</label>
                                    <div class="col-md-6">   
                                        <select class="form-control input-sm no-gray" name="itr_srch_order3" id="itr_srch_order3">
                                            <option value="" selected></option>
                                            <option value="date_trans">Date</option>
                                            <option value="inventory_type_id">Inventory Category</option>
                                            <option value="item_name">Item Name</option>
                                            <option value="user_name">Username</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="widget-footer">  
                                    <button type="submit" class="btn btn-labeled btn-primary" id="invReport" name="invReport">
                                        <span class="btn-label"><i class="fa fa-file-pdf-o"></i></span>Generate Report
                                    </button>
                                    <button type="reset" class="btn btn-labeled btn-warning" id="btn_itr_reset">
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