<?php 
require_once '../library/db.php';

Class_db::getInstance()->db_connect();
Class_db::getInstance()->db_beginTransaction();

if (isset($_POST["phyRepStats"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../../img/mpob.PNG" alt="MPOB"  width="32"></td>
                    <td width="60%" align="center">
                        <font size="16">Report Statistic</font><br/><font size="8">'.get_sources($_POST["prs_srch_sample"]).'</font>
                    </td>
                    <td width="20%" align="right"><font size="16">&nbsp;</font><br/><font size="9"><i>'.date("d M Y g:i a").'</i></font></td>
                </tr>
            </table>
            <hr>';
            $this->writeHTML($html);
        }

        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('times', '', 6);
            $html = '<hr><table border="0" cellspacing="0">
                        <tr>
                            <td><i>Advanced Oleochemical Technology Division</i></td>
                            <td align="right"><i>Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().'</i></td>
                        </tr>
                    </table>                                
                    ';
            $this->writeHTML($html);
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Report Statistic');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    $pdf->AddPage();    
    
    $pdf->SetFont('times', '', 8);
    
    $content = '<span align="center"><font size="9"><strong>Reports received by Physical Testing Service Lab, AOTD <br/>From '.get_month($_POST["prs_srch_month1"]).' '.$_POST["prs_srch_year1"].' To '.get_month($_POST["prs_srch_month2"]).' '.$_POST["prs_srch_year2"].'</strong></font></span>
    <br/><br/>
    <table style="border-collapse:collapse; border: 1px solid black;" cellpadding="5">
        <thead>
            <tr>
                <th border="1" width="20%" align="center"><strong><i>No.</i></strong></th>
                <th border="1" width="40%"><strong><i>Report No.</i></strong></th>
                <th border="1" width="40%"><strong><i>Date Received</i></strong></th>
            </tr>
        </thead>
        <tbody border="0.5">
    ';
    $content .= get_phyRepStats($_POST["prs_srch_month1"], $_POST["prs_srch_year1"], $_POST["prs_srch_month2"], $_POST["prs_srch_year2"], $_POST["prs_srch_sample"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('PHY-ReportStatistic'.date("d-M-Y").'.pdf', 'I');  
}

else if (isset($_POST["phyTestStats"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../../img/mpob.PNG" alt="MPOB"  width="32"></td>
                    <td width="60%" align="center">
                        <font size="16">Test Statistic Report</font><br/><font size="8">'.get_sources($_POST["pts_srch_sample"]).'</font>
                    </td>
                    <td width="20%" align="right"><font size="16">&nbsp;</font><br/><font size="9"><i>'.date("d M Y g:i a").'</i></font></td>
                </tr>
            </table>
            <hr>';
            $this->writeHTML($html);
        }

        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('times', '', 6);
            $html = '<hr><table border="0" cellspacing="0">
                        <tr>
                            <td><i>Advanced Oleochemical Technology Division</i></td>
                            <td align="right"><i>Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().'</i></td>
                        </tr>
                    </table>                                
                    ';
            $this->writeHTML($html);
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Test Statistic Report');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    $pdf->AddPage();    
    
    $pdf->SetFont('times', '', 8);
    
    $content = '<span align="center"><font size="9"><strong>Total number of samples received by Physical Testing Service Lab, AOTD<br/>From '.$_POST["pts_srch_day1"].' '.get_month($_POST["pts_srch_month1"]).' '.$_POST["pts_srch_year1"].' To '.$_POST["pts_srch_day2"].' '.get_month($_POST["pts_srch_month2"]).' '.$_POST["pts_srch_year2"].'</strong></font></span>
    <br/><br/>
    <table style="border-collapse:collapse; border: 1px solid black;" cellpadding="3">
        <thead>
            <tr>
                <th border="1" width="10%" align="center"><strong><i>No.</i></strong></th>
                <th border="1" width="40%"><strong><i>Test Name</i></strong></th>
                <th border="1" width="20%" align="center"><strong><i>Total</i></strong></th>
                <th border="1" width="30%" align="right"><strong><i>Cost (RM)</i></strong></th>
            </tr>
        </thead>
        <tbody border="0.5">
    ';
    $content .= get_phyTestStats($_POST["pts_srch_month1"], $_POST["pts_srch_day1"], $_POST["pts_srch_year1"], $_POST["pts_srch_month2"], $_POST["pts_srch_day2"], $_POST["pts_srch_year2"], $_POST["pts_srch_test"], $_POST["pts_srch_sample"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('PHY-TestStatisticReport'.date("d-M-Y").'.pdf', 'I');  
}

else if (isset($_POST["phyReport"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetY(15);
            $this->SetFont('times', '', 8);
            $html = '<table border="0" cellpadding="2">
                <tr>
                    <th>Confidential</th>
                    <th><span style="text-align: center;">Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().'</span></th>
                    <th><span style="text-align: right;">'.$_POST['mpr_phyRep_no'].'</span></th>
                </tr>
            </table>';
            $this->writeHTML($html);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->SetFont('times', '', 8);
            $html = '
            <hr>
            <table border="0" cellpadding="4">
                <tr>
                    <th align="center">MPOB - Advanced Oleochemical Technology Division<br/>No.6, Persiaran Institusi, Bandar Baru Bangi, 43000 Kajang, Selangor, Malaysia Tel: +603-87694280 Fax: +603-89222012<br/>E-mail: farizal@mpob.gov.my or farizal@mpob.gov.my Website: http://portal.mpob.gov.my/aotd/index.htm</th>
                </tr>
            </table>';
            $this->writeHTML($html);
        }

    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Physical Testing Services Report');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 009', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->AddPage();

    $pdf->SetFont('times', '', 11);
    
    $content = '
            <div align="center">
                <font size="14">
                    <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                    <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                    '.strtoupper($_POST['mpr_lab_name']).' LABORATORY
                </font>
            </div>
            <br/><br/>
            <table border="0" cellpadding="2">
                <tr>
                    <th style="background-color: black;" align="center"><font style="color: white; font-weight: bold;">'.$_POST['mpr_phyTest_name'].'</font></th>
                </tr>
            </table>
            <br/><br/>
            <table border="0" cellpadding="5">
                <tr>
                    <td width="100">STUDY :</td>
                    <td>'.$_POST['mpr_phyRep_no'].'</td>
                </tr>
                <tr>
                    <td width="100">ATTENTION :</td>
                    <td>'.$_POST['mpr_client_pic'].'<br>'.$_POST['mpr_client_organisation'].'<br/>'.nl2br($_POST['mpr_client_address']).'<br/>'.$_POST['mpr_client_postcode'].' '.$_POST['mpr_client_city'].'<br/>'.$_POST['mpr_client_state'].'</td>
                </tr>
            </table>
            <br/><br/>
            <table border="0" cellpadding="5">
                <tr>
                    <td width="200">SAMPLE NUMBER :</td>
                    <td>'.$_POST['mpr_phyRep_totalSample'].'</td>
                </tr>
                <tr>
                    <td width="200">SAMPLE ARRIVAL DATE :</td>
                    <td>'.$_POST['mpr_timeReceived'].'</td>
                </tr>
                <tr>
                    <td width="200">STARTING DATE :</td>
                    <td>'.$_POST['mpr_timeStarted'].'</td>
                </tr>
                <tr>
                    <td width="200">DATE COMPLETED :</td>
                    <td>'.$_POST['mpr_timeCompleted'].' '.get_reason($_POST['mpr_phyRep_no']).'</td>
                </tr>
                <tr>
                    <td width="200">PRODUCT :<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PHYSICAL FORM :<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QUANTITY :<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COLOUR :</td>
                    <td><span> </span><br/>'.$_POST['mpr_phyRep_physical'].'<br/>'.$_POST['mpr_phyRep_quantity'].'<br/>'.$_POST['mpr_phyRep_color'].'</td>
                </tr>
                <tr>
                    <td width="285">OTHER INFORMATION RELATED TO THE PRODUCT :</td>
                    <td>'.get_othersInformation($_POST['mpr_phyRep_other']).'</td>
                </tr>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/>
            <span style="font-style: italic;">"The data given in this report are exclusively referred to the samples tested. This report can only be reproduced in full."</span>
            <br/><br/><br/><br/>
            .............................................
            <br/><font style="font-weight: bold;">'.strtoupper($_POST['mpr_name_head_unit']).'</font>
            <br/><font style="font-weight: bold;">HEAD OF CONSUMER AND PRODUCT DEVELOPMENT UNIT</font>
            <br/><font style="font-weight: bold;">ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</font>
            <br/><font style="font-weight: bold;">MPOB</font>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->SetXY(15, 28);
    $pdf->Image('../../img/mpob.PNG', '', '', 20, 15, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);    
    $pdf->AddPage();
    $content = '
            <span>RESULT (Refer to Appendix 1-1)</span><br/><br/>
            '.get_resultPhy($_POST['mpr_phyRep_no']).'
            <br/><br/><div style="page-break-inside:avoid;"><span>Comment:</span>
            <br/><br/><br/><br/><font align="center" size="12">CONDUCTED BY</font>
            <br/><br/><br/><br/><font align="center" size="12">...........................</font>
            <br/><font align="center" size="12">'.strtoupper($_POST['mpr_name_technical_manager']).'</font>
            <br/><font align="center" size="12">SENIOR RESEARCH OFFICER</font>
            <br/><font align="center" size="12">AOTD,MPOB</font>
            <br/><br/><br/><br/><font align="center" size="12">REPORT ISSUED BY</font>
            <br/><br/><br/><br/><font align="center" size="12">...........................</font>
            <br/><font align="center" size="12">'.strtoupper($_POST['mpr_name_technical_manager2']).'</font>
            <br/><font align="center" size="12">SENIOR RESEARCH OFFICER</font>
            <br/><font align="center" size="12">AOTD,MPOB</font></div>';
    $pdf->writeHTML($content, true, false, true, false, '');    
    header('Content-Type: text/html; charset=utf-8');
    $pdf->Output('Report'.$_POST['mpr_phyRep_no'].''.date("dmY").'.pdf', 'I');
}

else if (isset($_POST["phyCover"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetY(15);
            $this->SetFont('times', '', 12);
            $html = '<div align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        '.strtoupper($_POST['mpr_lab_name']).' LABORATORY
                    </div>
            ';            
            $this->writeHTML($html);
            $this->SetXY(25, 15);
            $this->Image('../../img/mpob.PNG', '', '', 20, 15, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
            $this->Line(5, 33, $this->w - 5, 33);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->Line(5, $this->y, $this->w - 5, $this->y);
            $this->SetFont('times', '', 8);
            $html = '
            <table border="0" cellpadding="4">
                <tr>
                    <th align="center">MPOB - Advanced Oleochemical Technology Division<br/>No.6, Persiaran Institusi, Bandar Baru Bangi, 43000 Kajang, Selangor, Malaysia Tel: +603-87694280 Fax: +603-89222012<br/>E-mail: farizal@mpob.gov.my or farizal@mpob.gov.my Website: http://portal.mpob.gov.my/aotd/index.htm</th>
                </tr>
                <tr>
                    <th align="center">Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().'</th>
                </tr>
            </table>';
            $this->writeHTML($html);
        }

    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Physical Testing Services Cover Letter');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 009', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(25, 35, 25);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->AddPage();

    $pdf->SetFont('times', '', 11);
    
    $pdf->SetY(60);
    
    $content = '        
        '.date("j F Y").'<br/><br/>
        <strong>'.$_POST['mpr_client_organisation'].'</strong><br/>'.nl2br($_POST['mpr_client_address']).'<br/>'.$_POST['mpr_client_postcode'].' '.$_POST['mpr_client_city'].'<br/>'.$_POST['mpr_client_state'].'<br/>
        <br/><br/>(Attention : '.$_POST['mpr_client_pic'].')<br/><br/><br/>
        Dear Sir/Madam,<br/><br/>
        <strong>RESULTS OF ANALYSIS</strong><br/><br/>
        With reference to your mail dated '.$_POST['mpr_timeReceived'].', we enclosed herewith the phyicacy test report (Report. No. '.$_POST['mpr_phyRep_no'].') of the samples sent in by you.<br/><br/>
        Our Accounts Department will send the invoice for the services provided under a separate cover.<br/><br/>
        Thank you.<br/><br/><br/><br/>
        Yours sincerely,<br/><br/><br/>
        ..............................<br/>
        <strong>'.strtoupper($_POST['mpr_name_quality_manager']).'</strong><br/>
        '.get_designation($_POST['mpr_lab_quality_manager']).'<br/>
        Advanced Oleochemical Technology Division<br/>
        Malaysian Palm Oil Board
        ';
    
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('CoverLetter'.$_POST['mpr_phyRep_no'].''.date("dmY").'.pdf', 'I');
}

else if (isset($_POST["phyMemo"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetY(15);
            $this->SetFont('times', '', 12);            
            $html = '<div align="center">
                        <font size="18">Lembaga Minyak Sawit Malaysia</font><br/>
                        MALAYSIAN PALM OIL BOARD (MPOB)<br/><br/>
                        <font size="18"><strong>Memorandum</strong></font>
                    </div>';
            $this->writeHTML($html);
            $this->SetXY(40, 15);
            $this->Image('../../img/mpob.PNG', '', '', 20, 15, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->SetFont('times', '', 9);
            $html = '';
            $this->writeHTML($html);
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Physical Testing Services Memorandum');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 009', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 43, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->AddPage();

    $pdf->SetFont('times', '', 10);
    //$pdf->SetMargins(20, 40, PDF_MARGIN_RIGHT, true);
    $content = '
            <table style="border-collapse: collapse;" cellpadding="5">
                <tr>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black;" width="25%">Kepada <i>(To)</i></th>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black;" width="4%" align="right">:</th>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black;" width="71%">Akauntan</th>
                </tr>
                <tr>
                    <th style="border-bottom: 1px solid black;" width="25%">Daripada <i>(From)</i></th>
                    <th style="border-bottom: 1px solid black;" width="4%" align="right">:</th>
                    <th style="border-bottom: 1px solid black;" width="71%">'.$_POST['mpr_name_technical_manager2'].'</th>
                </tr>
                <tr>
                    <th style="border-bottom: 1px solid black;" width="25%">Perkara <i>(Subject)</i></th>
                    <th style="border-bottom: 1px solid black;" width="4%" align="right">:</th>
                    <th style="border-bottom: 1px solid black;" width="71%">Bil Untuk Perkhidmatan Analisis</th>
                </tr>
            </table>
            <table style="border-collapse: collapse;" cellpadding="5">
                <tr>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;" width="30%">Rujukan kami <i>(Our Ref.)</i><br/>'.$_POST['mpr_phyRep_no'].'</th>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;" width="20%">Haribulan <i>(Date)</i><br/>'.date("d/m/Y").'</th>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;" width="30%">Rujukan tuan <i>(Your Ref.)</i><br/></th>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black;" width="20%">Haribulan <i>(Date)</i><br/></th>
                </tr>
            </table>';
    $pdf->SetX(15);
    $pdf->writeHTML($content, true, false, true, false, '');
    $content = '            
            <table border="0" cellpadding="2">
                <tr>
                    <th width="30%"><strong>Sila Bil. Syarikat</strong></th>
                    <th width="2%"><strong>:</strong></th>
                    <th width="68%"><strong>'.$_POST['mpr_client_organisation'].'<br/>'.nl2br($_POST['mpr_client_address']).'<br/>'.$_POST['mpr_client_postcode'].' '.$_POST['mpr_client_city'].'<br/>'.$_POST['mpr_client_state'].'<br/>Tel: '.$_POST['mpr_client_phoneNo'].'<br/>(Attention : '.$_POST['mpr_client_pic'].')</strong></th>
                </tr>
                <tr>
                    <th width="30%"><strong>Sampel</strong></th>
                    <th width="2%"><strong>:</strong></th>
                    <th width="68%">'.get_samplePhy($_POST['mpr_phyRep_no']).'</th>
                </tr>
            </table>';
    $pdf->SetX(25);
    $pdf->writeHTML($content, true, false, true, false, '');
    $content = '
            <table border="0" cellpadding="2">
                <tr>
                    <th width="40%"><u>Analisis</u></th>
                    <th width="20%" align="right"><u>Kos/Sample</u></th>
                    <th width="20%" align="right"><u>Bil/Sample</u></th>
                    <th width="20%" align="right"><u>Jumlah Kos</u></th>
                </tr>
                <tr>
                    <th width="40%">'.$_POST['mpr_phyTest_name'].'</th>
                    <th width="20%" align="right">'.floatval($_POST['mpr_phyTest_cost']).'</th>
                    <th width="20%" align="right">'.intval($_POST['mpr_phyRep_totalSample']).'</th>
                    <th width="20%" align="right">'.floatval($_POST['mpr_phyTest_cost'])*intval($_POST['mpr_phyRep_totalSample']).'</th>
                </tr>
                <tr>
                    <th width="80%" align="right">JUMLAH</th>
                    <th width="20%" align="right">RM '.floatval($_POST['mpr_phyTest_cost'])*intval($_POST['mpr_phyRep_totalSample']).'</th>
                </tr>
                <tr>
                    <th width="80%" align="right">GST (6%)</th>
                    <th width="20%" align="right">RM '.(floatval($_POST['mpr_phyTest_cost'])*intval($_POST['mpr_phyRep_totalSample']))*0.06.'</th>
                </tr>
                <tr>
                    <th width="80%" align="right">JUMLAH TERMASUK GST</th>
                    <th width="20%" align="right">RM '.totalAfterGST($_POST['mpr_phyTest_cost'], $_POST['mpr_phyRep_totalSample']).'</th>
                </tr>
            </table>';
    $pdf->SetX(25);
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Memorandum'.$_POST['mpr_phyRep_no'].''.date("dmY").'.pdf', 'I');
}

Class_db::getInstance()->db_close();