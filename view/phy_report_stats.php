<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>
    <ol class="breadcrumb">
        <li>Physical Testing Services</li><li>Report Statistic</li>
    </ol>
</div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-suitcase fa-fw "></i> 
                Physical Testing Services
                <span>> 
                    Report Statistic
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid"> 
        <div class="row">
            <article class="col-md-9">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-prs1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>Report Statistic Report</h2>
                    </header>
                    <div>
                        <div class="widget-body">
                            <form class="form-horizontal" id="form_prs_search" method="post" target="_blank" action="pdf/phy.php">
                                <div class="form-group">
                                    <label class="col-md-3 control-label font-xs">Sample Source</label>
                                    <div class="col-md-5">   
                                        <select class="form-control input-sm" name="prs_srch_sample" id="prs_srch_sample">
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
                                        <select class="form-control input-sm" name="prs_srch_month1" id="prs_srch_month1">
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
                                        <select class="form-control input-sm" name="prs_srch_year1" id="prs_srch_year1">
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
                                        <select class="form-control input-sm" name="prs_srch_month2" id="prs_srch_month2">
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
                                        <select class="form-control input-sm" name="prs_srch_year2" id="prs_srch_year2">
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
                                    <button type="submit" class="btn btn-labeled btn-primary" id="phyRepStats" name="phyRepStats" >
                                        <span class="btn-label"><i class="fa fa-file-pdf-o"></i></span>Generate Report
                                    </button>
                                    <button type="reset" class="btn btn-labeled btn-warning" id="btn_prs_reset">
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