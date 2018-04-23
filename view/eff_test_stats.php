<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>Efficacy Testing Services</li><li>Test Statistic</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-suitcase fa-fw "></i> 
                Efficacy Testing Services
                <span>> 
                    Test Statistic
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-pts1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>Test Statistic Report</h2>
                    </header>
                    <div>
                        <div class="widget-body">
                            <form class="form-horizontal" id="form_ets_search" method="post" target="_blank" action="process/pdf/report.php">
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Evaluation Group</label>
                                    <div class="col-md-7">   
                                        <select class="form-control input-sm" name="ets_srch_test" id="ets_srch_test">
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Sample Source</label>
                                    <div class="col-md-5">   
                                        <select class="form-control input-sm" name="ets_srch_sample" id="ets_srch_sample">
                                            <option value="" selected>All Sources</option>
                                            <option value="INT">Internal</option>
                                            <option value="EXT">External</option>
                                        </select>
                                    </div>
                                </div> 
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">From</label>
                                    <div class="col-md-3">   
                                        <select class="form-control input-sm" name="ets_srch_month1" id="ets_srch_month1">
                                            <option value="" selected>Month</option>
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
                                        <select class="form-control input-sm" name="ets_srch_day1" id="ets_srch_day1">
                                            <option value="" selected>Day</option>
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
                                        <select class="form-control input-sm" name="ets_srch_year1" id="ets_srch_year1">
                                            <option value="" selected>Year</option>
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
                                        <select class="form-control input-sm" name="ets_srch_month2" id="ets_srch_month2">
                                            <option value="" selected>Month</option>
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
                                        <select class="form-control input-sm" name="ets_srch_day2" id="ets_srch_day2">
                                            <option value="" selected>Day</option>
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
                                        <select class="form-control input-sm" name="ets_srch_year2" id="ets_srch_year2">
                                            <option value="" selected>Year</option>
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
                                <div class="widget-footer">  
                                    <button type="submit" class="btn btn-labeled btn-primary" id="effTestStats" name="effTestStats" >
                                        <span class="btn-label"><i class="fa fa-file-pdf-o"></i></span>Generate Report
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
            </article>
        </div>
    </section>
</div>