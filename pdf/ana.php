<?php 
require_once('../pdf/funct.php');

if (isset($_POST["anaCertStats"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../img/mpob.PNG" alt="MPOB"  width="32"></td>
                    <td width="60%" align="center">
                        <font size="16">Certificate Statistic Report</font><br/><font size="8">'.get_sources($_POST["csr_srch_sample"]).'</font>
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
    $pdf->SetTitle('Certificate Statistic Report');

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
    
//    // Define the path to the image that you want to use as watermark.
//    $img_file = '../img/mpob.PNG';
//
//    // Render the image
//    $this->Image($img_file, 0, 0, 223, 280, '', '', '', false, 300, '', false, false, 0);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    $pdf->AddPage();    
    
    $pdf->SetFont('times', '', 8);
    
    $content = '<span align="center"><font size="9"><strong>Certificates received by Analytical Testing Service Lab, AOTD <br/>From '.get_month($_POST["csr_srch_month1"]).' '.$_POST["csr_srch_year1"].' To '.get_month($_POST["csr_srch_month2"]).' '.$_POST["csr_srch_year2"].'</strong></font></span>
    <br/><br/>
    <table style="border-collapse:collapse; border: 1px solid black;" cellpadding="5">
        <thead>
            <tr>
                <th border="1" width="20%" align="center"><strong><i>No.</i></strong></th>
                <th border="1" width="40%"><strong><i>Certificate No.</i></strong></th>
                <th border="1" width="40%"><strong><i>Date Received</i></strong></th>
            </tr>
        </thead>
        <tbody border="0.5">
    ';
    $content .= get_certStats($_POST["csr_srch_month1"], $_POST["csr_srch_year1"], $_POST["csr_srch_month2"], $_POST["csr_srch_year2"], $_POST["csr_srch_sample"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Certificate Statistic Report '.date("d-M-Y").'.pdf', 'I');  
}

else if (isset($_POST["anaSampleStats"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../img/mpob.PNG" alt="MPOB"  width="32"></td>
                    <td width="60%" align="center">
                        <font size="16">Sample Statistic Report</font><br/><font size="8">'.get_sources($_POST["ssr_srch_sample"]).'</font>
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
    $pdf->SetTitle('Sample Statistic Report');

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
    
    $content = '<span align="center"><font size="10"><strong>Total number of samples received by Analytical Testing Service Lab, AOTD<br/>From '.get_month($_POST["ssr_srch_month1"]).' '.$_POST["ssr_srch_year1"].' To '.get_month($_POST["ssr_srch_month2"]).' '.$_POST["ssr_srch_year2"].'</strong></font></span>
    <br/><br/>
    <table style="border-collapse:collapse; border: 1px solid black;" cellpadding="3">
        <thead>
            <tr>
                <th border="1" width="25%" align="center"><strong><i>No. of Sample</i></strong></th>
                <th border="1" width="50%"><strong><i>Sample Source</i></strong></th>
                <th border="1" width="25%" align="center"><strong><i>Total</i></strong></th>
            </tr>
        </thead>
        <tbody>
    ';
    $content .= get_sampleStats($_POST["ssr_srch_month1"], $_POST["ssr_srch_year1"], $_POST["ssr_srch_month2"], $_POST["ssr_srch_year2"], $_POST["ssr_srch_sample"]);
    $content .= '';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Sample Statistic Report '.date("d-M-Y").'.pdf', 'I');  
}

else if (isset($_POST["anaTestStats"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../img/mpob.PNG" alt="MPOB"  width="32"></td>
                    <td width="60%" align="center">
                        <font size="16">Test Statistic Report</font><br/><font size="8">'.get_sources($_POST["tsr_srch_sample"]).'</font>
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
    
    $content = '<span align="center"><font size="9"><strong>Total number of samples received by Analytical Testing Service Lab, AOTD<br/>From '.$_POST["tsr_srch_day1"].' '.get_month($_POST["tsr_srch_month1"]).' '.$_POST["tsr_srch_year1"].' To '.$_POST["tsr_srch_day2"].' '.get_month($_POST["tsr_srch_month2"]).' '.$_POST["tsr_srch_year2"].'</strong></font></span>
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
    $content .= get_testStats($_POST["tsr_srch_month1"], $_POST["tsr_srch_day1"], $_POST["tsr_srch_year1"], $_POST["tsr_srch_month2"], $_POST["tsr_srch_day2"], $_POST["tsr_srch_year2"], $_POST["tsr_srch_test"], $_POST["tsr_srch_sample"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Test Statistic Report '.date("d-M-Y").'.pdf', 'I');  
}

else if (isset($_POST["anaIncSampleStats"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../img/mpob.PNG" alt="MPOB"  width="28"></td>
                    <td width="60%" align="center">
                        <font size="18">Inventory Transaction Report</font>
                    </td>
                    <td width="20%" align="right"><font size="8">&nbsp;</font><br/><font size="9"><i>'.date("d M Y g:i a").'</i></font></td>
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
    $pdf->SetTitle('Inventory Transaction Report');

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
    
    $pdf->SetFont('times', '', 7);
    
    $content = '
    <span align="center"><font size="9"><strong>Certificates received by Analytical Testing Service Lab, AOTD <br/>From '.get_month($_POST["issr_srch_month1"]).' '.$_POST["issr_srch_year1"].' To '.get_month($_POST["issr_srch_month2"]).' '.$_POST["issr_srch_year2"].'</strong></font></span>
    <br/><br/>
    <table cellpadding="2">
        <thead>
            <tr>
                <th width="17%"><strong><i>Certificate No.</i></strong></th>
                <th width="23%"><strong><i>Customer Name</i></strong></th>
                <th width="15%" align="center"><strong><i>Number Of Sample</i></strong></th>
                <th width="25%"><strong><i>Test Name</i></strong></th>
                <th width="12%"><strong><i>Date Received</i></strong></th>
                <th width="8%" align="center"><strong><i>Days Taken</i></strong></th>
            </tr>
        </thead>
        <tbody>
    ';
    $content .= get_incomingSample($_POST["issr_srch_month1"], $_POST["issr_srch_year1"], $_POST["issr_srch_month2"], $_POST["issr_srch_year2"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Inventory Transaction Report '.date("d-M-Y").'.pdf', 'I');  
}

else if (isset($_POST["anaCert"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetFont('times', '', 12);
            if ($_POST["macl_atsCert_accredited"] == 1) {
                $logo = ' <img src="../img/logo_standards.PNG" alt="MPOB"  width="50">';
            }else{
                $logo = '';
            }
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th width="100" align="center"><img src="../img/mpob.PNG" alt="MPOB"  width="50"></th>
                    <th width="300" align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        ANALYTICAL TESTING SERVICES LABORATORY
                    </th>
                    <th width="100" align="center">
                    '.$logo.'
                    </th>
                </tr>
            </table><hr>';
            $this->writeHTML($html);
            $img_file = '../img/watermark.png';
            $this->Image($img_file, 0, 70, 120, 120, '', '', '', false, 300, 'C', false, false, 0);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->SetFont('times', '', 9);
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PAGE ' . $this->getAliasNumPage() . ' OF ' . $this->getAliasNbPages() . '</th>
                </tr>
            </table>
            <hr>
            <table border="0" cellpadding="4">
                <tr>
                    <th align="center">No.6, Persiaran Institusi, Bandar Baru Bangi, 43000 Kajang, Selangor, Malaysia Tel: +603-87694280 Fax: +603-89222012<br/>E-mail: razmah@mpob.gov.my or hajar@mpob.gov.my  Website: http://portal.mpob.gov.my/aotd/index.htm</th>
                </tr>
            </table>';
            $this->writeHTML($html);
        }

    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Analytical Testing Services Certificate');

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

    $pdf->SetFont('times', '', 10);
        
    $sql = "SELECT
            ats_test.atsTest_id AS atsTest_id,
            ats_test.atsTest_name AS atsTest_name,
            ats_field.atsField_id AS atsField_id,
            ats_field.atsField_name AS atsField_name
        FROM ats_cert_field 
        LEFT JOIN ats_field ON ats_field.atsField_id = ats_cert_field.atsField_id
        LEFT JOIN ats_test ON ats_test.atsTest_id = ats_field.atsTest_id
        WHERE atsCert_id = ".$_POST["macl_atsCert_id"]; 
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $arr_ats_cert_test = mysqli_query(get_connect(), $sql); 
        
    $content = '
            <br/><br/>
            <h3 align="center">CERTIFICATE OF ANALYSIS<br/><br/></h3>
            <table border="0" cellpadding="4">
                <tr>
                    <th width="40%">CERTIFICATE NO</th>
                    <th width="60%">: ' . $_POST["macl_atsCert_no"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Submitted By</th>
                    <th width="60%">: ' . $_POST["macl_client_organisation"] . ' <br> &nbsp;' . $_POST["macl_client_address"] . ' <br> &nbsp;' . $_POST["macl_client_postcode"] . ' <br> &nbsp;' . $_POST["macl_client_city"] . ', <br> &nbsp;' . $_POST["macl_client_state"] . ' <br> &nbsp;(Attention : ' . $_POST["macl_client_pic"] . ')</th>
                </tr>
                <tr>
                    <th width="40%">Date Issue</th>
                    <th width="60%">: ' . $_POST["macl_timeprint"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Date of Sample(s) Received</th>
                    <th width="60%">: ' . $_POST["macl_timeReceived"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Date of Analysis</th>
                    <th width="60%">: ' . $_POST["macl_timeReported"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Date of Analysis Completed</th>
                    <th width="60%">: ' . $_POST["macl_timeReported2"] . '</th>
                </tr>
                <tr>
                    <th width="100%"><u>Sample Description</u></th>
                </tr>
                <tr>
                    <th width="40%">No of sample(s)</th>
                    <th width="60%">: ' . $_POST["macl_atsCert_totalSample"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Type of sample</th>
                    <th width="60%">: </th>
                </tr>
                <tr>
                    <th width="40%">Condition of sample </th>
                    <th width="60%">: ' . $_POST["macl_atsCert_condition"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Remarks </th>
                    <th width="60%">: ' . $_POST["macl_atsCert_remark"] . '</th>
                </tr>
                <tr>
                    <th width="100%"><u>Result of Analysis</u></th>
                </tr>
            </table>
           
            
            <br/><br/>
            <table border="0" cellpadding="4">
            <thead>
                <tr>
                    <th width="40%" align="left"><u>Test</u></th>
                    <th width="40%" align="left"><u>Test Method</u></th>
                    <th width="20%" align="left"><u>Page of Results</u></th>
                </tr>
            </thead>';
            foreach($arr_ats_cert_test as $ats_cert_test) {
                $content .= '
                <tr>
                    <td width="40%" align="left">'.$ats_cert_test["atsTest_name"].'</td>
                    <td width="40%" align="left">'.$ats_cert_test["atsField_name"].'</td>
                    <td width="20%" align="left">Page 2 of 2</td>
                </tr> ';
            }  
            $content .= '</table>
            <br/><br/><br/><br/><br/><br/>
            Report issued by,
            <br/><br/><br/><br/><br/>
            ..........................................
            <br/>
            ' . $_POST["macl_name_quality_manager"] . '
            <br/>
            ' . $_POST["macl_quality_manager_designation"] . '
            <br/>
            AOTD MPOB
            <br/>
            IKM Member No: A/1045/4352/02
            <br><br><br>
           (This is a computer generated certificate. No signature is required.)
            ';
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->AddPage();
    $pdf->SetFont('times', '', 10);

    $content = '
            <br/><br/>
            <h3 align="center">CERTIFICATE OF ANALYSIS<br/><br/><br/></h3>
            <table border="0" cellpadding="4">
                <tr>
                    <th>CERTIFICATE NO : ' . $_POST["macl_atsCert_no"] . '</th>
                </tr><br/>
                <tr>
                    <th><b>Date Of Certificate Issued</b> :  ' . $_POST["macl_timeprint"] . '<br/></th>
                </tr>
            </table>
            <table border="1" cellpadding="4">
                <thead>
                    <tr style="background-color: black; color: white;">
                        <th align="center" width="30%"><strong>Lab Sample Code</strong></th>
                        <th align="center" width="55%"><strong>Customer Sample Code</strong></th>
                        <th align="center" width="15%"><strong>Result</strong></th>
                    </tr>
                </thead>
                <tbody>';
        foreach($arr_ats_cert_test as $ats_cert_test) {         
            $content .= '
                <tr>
                    <td align="left" colspan="3">'.$ats_cert_test["atsTest_name"].' : '.$ats_cert_test["atsField_name"].'</td>
                </tr> ';
            $sql = "SELECT
                    ats_sample_info.atsLab_code AS atsLab_code,
                    ats_sample_info.atsLab_sampleCode AS atsLab_sampleCode,
                    ats_field.atsField_name AS atsField_name,
                    ats_res.atsRes_res AS atsRes_res
                FROM ats_sample_info 
                LEFT JOIN ats_cert_test ON ats_cert_test.atsCert_id = ats_sample_info.atsCert_id
                LEFT JOIN ats_field ON ats_field.atsTest_id = ats_cert_test.atsTest_id
				LEFT JOIN ats_res ON ats_res.atsLab_id = ats_sample_info.atsLab_id AND ats_res.atsField_id = ats_field.atsField_id
                WHERE ats_sample_info.atsCert_id = ".$_POST["macl_atsCert_id"]." AND ats_field.atsField_id = ".$ats_cert_test['atsField_id'];
            log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
            $result = mysqli_query(get_connect(), $sql); 
            while($row = mysqli_fetch_assoc($result))  
            { 
                $content .= '
                <tr>
                    <td align="center" width="30%">'.$row["atsLab_code"].'</td>
                    <td width="55%">'.$row["atsLab_sampleCode"].'</td>
                    <td align="center" width="15%">'.$row["atsRes_res"].'</td>
                </tr> ';
            }
        }
    $content .= '</tbody>
            </table>
            <br/><br/><br/><br/>
            <br/><br/><br/><br/>
            Report issued by,
            <br/><br/><br/><br/><br/>
            ..........................................
            <br/>
            ' . $_POST["macl_name_quality_manager"] . '
            <br/>
            ' . $_POST["macl_quality_manager_designation"] . '
            <br/>
            AOTD MPOB
            <br/>
            IKM Member No: A/1045/4352/02
            <br><br><br>
            NOTE: 1. The above results are based solety on the samples submitted by company.<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  2. Interpretation of results shall not be provided by our laboratory.<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  3. The certificate of analysis should not be used for any advertising purpose. It should not be reproduced<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                     (except in full) without the written approval of the Director of AOTD, MPOB.
            ';
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('AnalyticalCertificate'.date("d-M-Y").'.pdf', 'I');
}

else if (isset($_POST["anaCover"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetY(15);
            $this->SetFont('times', '', 12);
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th width="80" align="center"><img src="../img/mpob.PNG" alt="MPOB"  width="50"></th>
                    <th width="380" align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        <font align="center" size="12">'.strtoupper($_POST['macl_lab_name']).' LABORATORY</font>
                    </th>
                </tr>
            </table>
            ';            
            $this->writeHTML($html);
            $this->Line(5, 33, $this->w - 5, 33);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->Line(5, $this->y, $this->w - 5, $this->y);
            $this->SetFont('times', '', 8);
            $html = '
            <table border="0" cellpadding="4">
                <tr>
                    <th align="center">No.6, Persiaran Institusi, Bandar Baru Bangi, 43000 Kajang, Selangor, Malaysia Tel: +603-87694280 Fax: +603-89222012<br/>E-mail: razmah@mpob.gov.my or hajar@mpob.gov.my Website: http://portal.mpob.gov.my/aotd/index.htm</th>
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
    $pdf->SetTitle('Analytical Testing Services Cover Letter');

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
        <strong>'.$_POST['macl_client_organisation'].'</strong><br/>'.nl2br($_POST['macl_client_address']).'<br/>'.$_POST['macl_client_postcode'].' '.$_POST['macl_client_city'].'<br/>'.$_POST['macl_client_state'].'<br/>
        <br/><br/>(Attention : '.$_POST['macl_client_pic'].')<br/><br/><br/>
        Dear Sir/Madam,<br/><br/>
        <strong>RESULTS OF ANALYSIS</strong><br/><br/>
        With reference to your mail dated '.$_POST['macl_timeReceived'].', we enclosed herewith the certificate of analysis (Cert. No. '.$_POST['macl_atsCert_no'].') of the samples sent in by you.<br/><br/>
        Our Accounts Department will send the invoice for the services provided under separate cover.<br/><br/>
        Thank you.<br/><br/><br/><br/>
        Yours sincerely,<br/><br/><br/>
        ..............................<br/>
        <strong>DR. HAZIMAH ABU HASSAN</strong><br/>
        Director<br/>
        Advanced Oleochemical Technology Division<br/>
        Malaysian Palm Oil Board
        <br/><br/><br/>
        cc:<ol type="i"><li>Head Of QEA Unit, MPOB</li><li>Accounts Unit, MPOB</li></ol>
        ';
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('AnalyticalCoverLetter'.date("d-M-Y").'.pdf', 'I');
} 

else if (isset($_POST["anaMemo"])) {

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
            $this->Image('../img/mpob.PNG', '', '', 20, 15, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
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
    $pdf->SetTitle('Analytical Testing Services Memorandum');

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
                    <th style="border-bottom: 1px solid black;" width="71%">'.$_POST['macl_name_research_officer'].'</th>
                </tr>
                <tr>
                    <th style="border-bottom: 1px solid black;" width="25%">Perkara <i>(Subject)</i></th>
                    <th style="border-bottom: 1px solid black;" width="4%" align="right">:</th>
                    <th style="border-bottom: 1px solid black;" width="71%">Bil Untuk Perkhidmatan Analisis</th>
                </tr>
            </table>
            <table style="border-collapse: collapse;" cellpadding="5">
                <tr>
                    <th style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;" width="30%">Rujukan kami <i>(Our Ref.)</i><br/>'.$_POST['macl_atsCert_no'].'</th>
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
                    <th width="68%"><strong>'.$_POST['macl_client_organisation'].'<br/>'.nl2br($_POST['macl_client_address']).'<br/>'.$_POST['macl_client_postcode'].' '.$_POST['macl_client_city'].'<br/>'.$_POST['macl_client_state'].'<br/>Tel: '.$_POST['macl_client_phoneNo'].'<br/>Fax: '.$_POST['macl_client_faxNo'].'<br/>(Attention : '.$_POST['macl_client_pic'].')</strong></th>
                </tr>
                <tr>
                    <th width="30%"><strong>Sampel</strong></th>
                    <th width="2%"><strong>:</strong></th>
                    <th width="68%">'.get_sampleAna($_POST['macl_atsCert_id']).'</th>
                </tr>
            </table>';
    $pdf->SetX(25);
    $pdf->writeHTML($content, true, false, true, false, '');
    $content = '
            <table border="0" cellpadding="2">
                <tr>
                    <th width="40%"><u>Analisis</u></th>
                    <th width="15%" align="right"><u>Kos/Sample</u></th>
                    <th width="15%" align="right"><u>Bil. Sample</u></th>
                    <th width="15%" align="right"><u>Ujian</u></th>
                    <th width="15%" align="right"><u>Jumlah Kos</u></th>
                </tr>
                '.get_testAna($_POST['macl_atsCert_id']).'
            </table>';      
    $pdf->SetX(25);
    $pdf->writeHTML($content, true, false, true, false, '');
    $content = 'Catatan : '.$_POST['macl_atsCert_remark'];      
    $pdf->SetX(25);
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('Memorandum'.$_POST['macl_atsCert_no'].''.date("dmY").'.pdf', 'I');
}

else if (isset($_POST["anaDigital"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetFont('times', '', 12);
            if ($_POST["macl_atsCert_accredited"] == 1) {
                $logo = ' <img src="../img/logo_standards.PNG" alt="MPOB"  width="50">';
            }else{
                $logo = '';
            }
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th width="100" align="center"><img src="../img/mpob.PNG" alt="MPOB"  width="50"></th>
                    <th width="300" align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        ANALYTICAL TESTING SERVICES LABORATORY
                    </th width="100" align="center">
                    <th>'.$logo.'</th>
                </tr>
            </table><hr>';
            $this->writeHTML($html);
            $img_file = '../img/watermark.png';
            $this->Image($img_file, 0, 70, 120, 120, '', '', '', false, 300, 'C', false, false, 0);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->SetFont('times', '', 9);
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th align="center">PAGE ' . $this->getAliasNumPage() . ' OF ' . $this->getAliasNbPages() . '</th>
                </tr>
            </table>
            <hr>
            <table border="0" cellpadding="4">
                <tr>
                    <th align="center">No.6, Persiaran Institusi, Bandar Baru Bangi, 43000 Kajang, Selangor, Malaysia Tel: +603-87694280 Fax: +603-89222012<br/>E-mail: razmah@mpob.gov.my or hajar@mpob.gov.my  Website: http://portal.mpob.gov.my/aotd/index.htm</th>
                </tr>
            </table>';
            $this->writeHTML($html);
        }

    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Analytical Testing Services Digital Copy');

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

    $pdf->SetFont('times', '', 10);
        
    $sql = "SELECT
            ats_test.atsTest_id AS atsTest_id,
            ats_test.atsTest_name AS atsTest_name,
            ats_field.atsField_id AS atsField_id,
            ats_field.atsField_name AS atsField_name
        FROM ats_cert_field 
        LEFT JOIN ats_field ON ats_field.atsField_id = ats_cert_field.atsField_id
        LEFT JOIN ats_test ON ats_test.atsTest_id = ats_field.atsTest_id
        WHERE atsCert_id = ".$_POST["macl_atsCert_id"]; 
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $arr_ats_cert_test = mysqli_query(get_connect(), $sql); 
        
    $content = '
            <br/><br/>
            <h3 align="center">CERTIFICATE OF ANALYSIS<br/><br/></h3>
            <table border="0" cellpadding="4">
                <tr>
                    <th width="40%">CERTIFICATE NO</th>
                    <th width="60%">: ' . $_POST["macl_atsCert_no"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Submitted By</th>
                    <th width="60%">: ' . $_POST["macl_client_organisation"] . ' <br> &nbsp;' . $_POST["macl_client_address"] . ' <br> &nbsp;' . $_POST["macl_client_postcode"] . ' <br> &nbsp;' . $_POST["macl_client_city"] . ', <br> &nbsp;' . $_POST["macl_client_state"] . ' <br> &nbsp;(Attention : ' . $_POST["macl_client_pic"] . ')</th>
                </tr>
                <tr>
                    <th width="40%">Date Issue</th>
                    <th width="60%">: ' . $_POST["macl_timeprint"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Date of Sample(s) Received</th>
                    <th width="60%">: ' . $_POST["macl_timeReceived"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Date of Analysis</th>
                    <th width="60%">: ' . $_POST["macl_timeReported"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Date of Analysis Completed</th>
                    <th width="60%">: ' . $_POST["macl_timeReported2"] . '</th>
                </tr>
                <tr>
                    <th width="100%"><u>Sample Description</u></th>
                </tr>
                <tr>
                    <th width="40%">No of sample(s)</th>
                    <th width="60%">: ' . $_POST["macl_atsCert_totalSample"] . '</th>
                </tr>
                <tr>
                    <th width="40%">Type of sample</th>
                    <th width="60%">: </th>
                </tr>
                <tr>
                    <th width="40%">Condition of sample </th>
                    <th width="60%">: ' . $_POST["macl_atsCert_condition"] . '</th>
                </tr>
                <tr>
                    <th width="100%"><u>Result of Analysis</u></th>
                </tr>
            </table>
           
            
            <br/><br/>
            <table border="0" cellpadding="4">
            <thead>
                <tr>
                    <th width="40%" align="left"><u>Test</u></th>
                    <th width="40%" align="left"><u>Test Method</u></th>
                    <th width="20%" align="left"><u>Page of Results</u></th>
                </tr>
            </thead>';
            foreach($arr_ats_cert_test as $ats_cert_test) {
                $content .= '
                <tr>
                    <td width="40%" align="left">'.$ats_cert_test["atsTest_name"].'</td>
                    <td width="40%" align="left">'.$ats_cert_test["atsField_name"].'</td>
                    <td width="20%" align="left">Page 2 of 2</td>
                </tr> ';
            }  
            $content .= '</table>
            <br/><br/><br/><br/><br/><br/><br/><br/>
            Report issued by,
            <br/>
            ' . $_POST["macl_name_quality_manager"] . '
            <br/>
            ' . $_POST["macl_quality_manager_designation"] . '
            <br/>
            AOTD MPOB
            <br/>
            IKM Member No: A/1045/4352/02
            <br><br><br>
           (This is a computer generated certificate. No signature is required.)
            ';
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->AddPage();
    $pdf->SetFont('times', '', 10);

    $content = '
            <br/><br/>
            <h3 align="center">CERTIFICATE OF ANALYSIS<br/><br/><br/></h3>
            <table border="0" cellpadding="4">
                <tr>
                    <th>CERTIFICATE NO : ' . $_POST["macl_atsCert_no"] . '</th>
                </tr><br/>
                <tr>
                    <th><b>Date Of Certificate Issued</b> :  ' . $_POST["macl_timeprint"] . '<br/></th>
                </tr>
            </table>
            <table border="1" cellpadding="4">
                <thead>
                    <tr style="background-color: black; color: white;">
                        <th align="center" width="30%"><strong>Lab Sample Code</strong></th>
                        <th align="center" width="55%"><strong>Customer Sample Code</strong></th>
                        <th align="center" width="15%"><strong>Result</strong></th>
                    </tr>
                </thead>
                <tbody>';
        foreach($arr_ats_cert_test as $ats_cert_test) {         
            $content .= '
                <tr>
                    <td align="left" colspan="3">'.$ats_cert_test["atsTest_name"].' : '.$ats_cert_test["atsField_name"].'</td>
                </tr> ';
            $sql = "SELECT
                    ats_sample_info.atsLab_code AS atsLab_code,
                    ats_sample_info.atsLab_sampleCode AS atsLab_sampleCode,
                    ats_field.atsField_name AS atsField_name,
                    ats_res.atsRes_res AS atsRes_res
                FROM ats_sample_info 
                LEFT JOIN ats_cert_test ON ats_cert_test.atsCert_id = ats_sample_info.atsCert_id
                LEFT JOIN ats_field ON ats_field.atsTest_id = ats_cert_test.atsTest_id
                LEFT JOIN ats_res ON ats_res.atsLab_id = ats_sample_info.atsLab_id AND ats_res.atsField_id = ats_field.atsField_id
                WHERE ats_sample_info.atsCert_id = ".$_POST["macl_atsCert_id"]." AND ats_field.atsField_id = ".$ats_cert_test['atsField_id'];
            log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
            $result = mysqli_query(get_connect(), $sql); 
            while($row = mysqli_fetch_assoc($result))  
            { 
                $content .= '
                <tr>
                    <td align="center" width="30%">'.$row["atsLab_code"].'</td>
                    <td width="55%">'.$row["atsLab_sampleCode"].'</td>
                    <td align="center" width="15%">'.$row["atsRes_res"].'</td>
                </tr> ';
            }
        }
    $content .= '</tbody>
            </table>
            <br/><br/><br/><br/>
            <br/><br/><br/><br/>
            Report issued by,
            <br/>
            Puan Hajar Musa
            <br/>
            Senior Research Officer
            <br/>
            AOTD MPOB
            <br/>
            IKM Member No: A/1045/4352/02
            <br><br><br>
            NOTE: 1. The above results are based solety on the samples submitted by company.<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  2. Interpretation of results shall not be provided by our laboratory.<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  3. The certificate of analysis should not be used for any advertising purpose. It should not be reproduced<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                     (except in full) without the written approval of the Director of AOTD, MPOB.
            ';
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('AnalyticalDigitalCopy'.date("d-M-Y").'.pdf', 'I');
}