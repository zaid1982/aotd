<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your fields." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>    
    <ol class="breadcrumb">
        <li>Testing</li>
    </ol>
</div>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-5">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-home fa-fw "></i> 
                Testing
            </h1>
        </div>
    </div>
    <section id="widget-grid" class="">  
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">                
                    <header>
                        <span class="widget-icon"> <i class="fa fa-tasks"></i> </span>
                        <h2>Testing</h2>
                    </header>
                    <div>
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" target="_blank" action="process/pdf/report.php">
                                        <button type="submit" class="btn btn-primary" name="certificate1">
                                            <i class=""></i> Certificate
                                        </button>  
                                        <button type="submit" class="btn btn-default" name="cover">
                                            <i class=""></i> Cover Letter
                                        </button>
                                        <button type="submit" class="btn btn-danger" name="memorandum">
                                            <i class=""></i> Memorandum
                                        </button>
                                        <button type="submit" class="btn btn-success" name="user_info">
                                            <i class=""></i> User Information Report
                                        </button>   
                                        <button type="submit" class="btn btn-info" name="customer_info">
                                            <i class=""></i> Customer Information Report
                                        </button>              
                                        <button type="submit" class="btn btn-warning" name="inventory">
                                            <i class=""></i> Inventory Transaction Report
                                        </button>
                                    </form>
                                </div>                                    
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" id="btn_printCode" onClick="getBarCode('QEA/ATS/INT/NAC/114-17')">
                                        <i class=""></i> Get Barcode
                                    </button>
                                    <button type="button" class="btn btn-primary" id="btn_printCode" onClick="printBarCode('printcode')">
                                        <i class=""></i> Print Barcode
                                    </button>  
                                </div>                                    
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-3">
                                    <div id="printcode"><svg id="barcode" style="width: 110%; height: 120%;"></svg></div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>