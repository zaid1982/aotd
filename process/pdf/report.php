<?php
require_once('../../process/pdf/funct.php');

if (isset($_POST["certificate"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetFont('times', '', 12);
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th width="100" align="center"><img src="../../img/mpob.PNG" alt="MPOB"  width="50"></th>
                    <th width="400" align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        ANALYTICAL TESTING SERVICES LABORATORY
                    </th>
                </tr>
            </table><hr>';
            $this->writeHTML($html);
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
    $pdf->SetTitle('Certificate');

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

    $content = '
            <br/><br/>
            <h3 align="center">CERTIFICATE OF ANALYSIS<br/><br/><br/><br/></h3>
            
            Certificate No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ' . $_POST["lmism_atsCert_no"] . '
            <br/>
            Date of Certificate Issue : 18/7/2013
                <br/><br/>
            ' . $_POST["lmism_client_organisation"] . '
            <br/>
            ' . $_POST["lmism_client_address"] . '
            <br/>
            ' . $_POST["lmism_client_postcode"] . ' ' . $_POST["lmism_client_city"] . ',
            <br/>
            ' . $_POST["lmism_client_state"] . '
            <br/>
            (Attention : ' . $_POST["lmism_client_pic"] . ')
            <br/><br/>
            We have analysed the samples sent in by your company, ' . $_POST["client_organisation1"] . ' and our findings
            <br/>
            are as follows:
            <br/><br/>
            Date of analysis completed : ' . $_POST["lmism_atsCert_timeReported"] . '
            <br/><br/>
            <table border="0" cellpadding="4">
            <thead>
                <tr>
                    <th width="170" align="center"><u>Test</u></th>
                    <th width="170" align="center"><u>Test Method</u></th>
                    <th width="170" align="center"><u>Results</u></th>
                </tr>
            </thead>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            Report issued by,
            <br/><br/><br/><br/><br/>
            ..........................................
            <br/>
            Puan Hajar Musa
            <br/>
            Senior Research Officer
            <br/>
            AOTD MPOB
            <br/>
            IKM Member No: A/1045/4352/02
            <br><br><br>
           (This is a computer generated certificate. No signature is required.)
            ';
//    $sql = "SELECT
//                    ats_cert_test.atsCertTest_id AS atsCertTest_id,
//                    ats_cert_test.atsCert_id AS atsCert_id,
//                    ats_test.atsTest_name AS atsTest_name,
//                    ats_test.atsTest_cat AS atsTest_cat
//                FROM ats_cert_test 
//                LEFT JOIN ats_test ON ats_test.atsTest_id = ats_cert_test.atsTest_id
//                LEFT JOIN ats_sample_log ON ats_sample_log.atsCert_id = ats_cert_test.atsCert_id";
//    $result = mysqli_query(mysqli_connect('addeen-legacy.com.my', 'addeenle_aotd', '', 'addeenle_aotd'), $sql); 
//    $bil = 1;
//    while($row = mysqli_fetch_assoc($result))  
//    { 
//        $content .= '
//            <tr>
//                <td align="center">'.$row["atsTest_name"].'</td>
//                <td align="center">'.$row["atsTest_cat"].'</td>
//                <td align="center"></td>
//            </tr> ';
//    }
//        $content.= '                
//            </tbody>
//            </table>';
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->AddPage();
    $pdf->SetFont('times', '', 10);

    $content = '
            <br/><br/>
            <h3 align="center">CERTIFICATE OF ANALYSIS<br/><br/><br/></h3>
            <table border="0" cellpadding="4">
                <tr>
                    <th>CERTIFICATE NO : ' . $_POST["atsCert_no1"] . '</th>
                </tr><br/>
                <tr>
                    <th><b>Date Of Certificate Issued</b> : 18/07/2013<br/></th>
                </tr>
            </table>
            <table border="1" cellpadding="4">
                <thead>
                    <tr>
                        <th align="center">Lab Sample Code</th>
                        <th align="center">Customer Sample Code</th>
                        <th align="center">Result</th>
                    </tr>
                </thead>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            Report issued by,
            <br/><br/><br/><br/><br/>
            ..........................................
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

    $pdf->Output('certificate.pdf', 'I');
} 

else if (isset($_POST["cover"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetFont('times', '', 12);
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th width="100" align="center"><img src="../../img/mpob.PNG" alt="MPOB"  width="50"></th>
                    <th width="400" align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        ANALYTICAL TESTING SERVICES LABORATORY
                    </th>
                </tr>
            </table><hr>';
            $this->writeHTML($html);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->SetFont('times', '', 9);
            //$html = 'PAGE '.$this->getAliasNumPage().' OF '.$this->getAliasNbPages().'<hr><br/><br/>';
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
    $pdf->SetTitle('cover');

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

    $content = <<<EOD
        <br/><br/><br/><br/><br/><br/><br/>
        18 July 2013
        <br/><br/><br/>
        Sime Darby Research Sdn. Bhd.
        <br/>
        R&D Centre Carey Island � Downstream,
        <br/>
        Lot 2664, Jalan Pulau Carey,
        <br/>
        42960 Kuala Langat,
        <br/>
        Selangor.
            <br/><br/>
            (Attention	: Cik Nurdiyana Binti Muhamad Johari)
            <br/>
            Dear Sir,
            <br/><br/>
            RESULTS OF ANALYSIS
            <br/><br/>
            With reference to your mail dated 3 July 2013, we enclosed here with the certificate of analysis (Cert. No.
            <br/>
            QEA/ATS/EXT/NAC/102-13) of the samples sent in by you.
            <br/><br/>
            Our Accounts Department will send the invoice for the services provided under separate cover.
            <br/><br/>
            Thank you.
            <br/><br/><br/><br/><br/>
            Your sincerely,
            <br/><br/><br/><br/><br/>
            ����������������
            <br/>
            DR. HAZIMAH ABU HASSAN
            <br/>
            Director
            <br/>
            Advance Oleochemical Technology Division
            <br/>
            Malaysian Palm Oil Board
EOD;
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('cover.pdf', 'I');
} 

else if (isset($_POST["memorandum"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetFont('times', '', 12);
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th width="100" align="center"><img src="../../img/mpob.PNG" alt="MPOB"  width="50"></th>
                    <th width="400" align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        ANALYTICAL TESTING SERVICES LABORATORY
                    </th>
                </tr>
            </table><hr>';
            $this->writeHTML($html);
        }

        public function Footer() {
            $this->SetY(-25);
            $this->SetFont('times', '', 9);
            //$html = 'PAGE '.$this->getAliasNumPage().' OF '.$this->getAliasNbPages().'<hr><br/><br/>';
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
    $pdf->SetTitle('memorendum');

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

    $content = <<<EOD
            <br><br><br>
        <table border="1" cellpadding="4">
                <tr>
                    <th width="130" align="left">Kepada(To)</th>
                    <th  align="left" colspan="3">:</th>
                </tr>
                <tr>
                    <th width="130" align="left">Daripada(From)</th>
                    <th  align="left" colspan="3">:</th>
                </tr>
                <tr>
                    <th width="130" align="left">Perkara(Subject)</th>
                    <th  align="left" colspan="3">:</th>
                </tr>
                <tr>
                    <th  align="center">Rujukan Kami (Our Ref.)<br>QEA/ATS/EXT/NAC/102-13</th>
                    <th  align="center">Haribulan (Date)<br>18/07/2013</th>
                    <th  align="center">Rujukan Tuan (Your Ref.)<br></th>
                    <th  align="center">Haribulan (Date)<br></th>
                </tr>
            </table>
            <br><br>
            <table border="0" cellpadding="4">
                <tr>
                    <th width="190" align="left">Sila Bil. Syarikat</th>
                    <th width="230" align="left">: Sime Darby Research Sdn. Bhd.<br>  R&amp;D Centre Carey Island � Downstream,<br>  Lot 2664, Jalan Pulau Carey,<br>  42960 Kuala Langat,<br>  Selangor<br>  (Attention: Cik Nurdiyana Binti Muhamad Johari)</th>
                </tr>
                <tr>
                    <th width="190" align="left">Sampel</th>
                    <th width="190" align="left">: Trans RBDPS (25ml MeOH)-1<br>  Trans RBDPS (25ml MeOH)-2<br>  Trans RBDPS (25ml MeOH)-3<br>  Trans RBDPS (25ml MeOH)-4<br>  Trans RBDPS (25ml MeOH)-5<br>  Trans RBDPS (25ml MeOH)-6<br>  Trans RBDPS (25ml MeOH)-7<br>  Trans RBDPS (25ml MeOH)-8
                        <br>  Trans RBDPS (25ml MeOH)-9<br>  Trans RBDPS (25ml MeOH)-10<br>  Trans RBDPS (25ml MeOH)-11<br>  Trans RBDPS (25ml MeOH)-12</th>
                </tr>
            </table><br><br><br>
            <table border="0" cellpadding="4">
                <tr>
                    <th  align="center"><u>Analisis</u></th>
                    <th  align="center"><u>Kos/Sample</u></th>
                    <th  align="center"><u>Bil/Sample</u></th>
                    <th  align="center"><u>Ujian</u></th>
                    <th  align="center"><u>Jumlah Kos</u></th>
                </tr>
                <tr>
                    <th align="center">Fatty Acid Composition</th>
                    <th align="center">150</th>
                    <th align="center">12</th>
                    <th align="center">1</th>
                    <th align="center">1800</th>
                </tr>
            </table><br><br>
            <table border="0" cellpadding="4">
                <tr>
                    <th width="430" align="right">JUMLAH</th>
                    <th align="left">RM1800</th>
                </tr>
                <tr>
                    <th width="430" align="right">JUMLAH TERMASUK GST</th>
                    <th align="left">RM1908</th>
                </tr>
            </table>
            <table border="0" cellpadding="4">
                <tr>
                    <th width="190" align="left">Catatan</th>
                    <th width="230" align="left">: </th>
                </tr>
            </table>
EOD;
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('memorendum.pdf', 'I');
}

else if(isset($_POST["inventory"]))  {      
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr style="border-top: 3px double #8c8b8b;"/>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../../img/mpob.PNG" alt="MPOB"  width="28"></td>
                    <td width="60%" align="center">
                        <font size="18">Inventory Transaction Report</font>
                    </td>
                    <td width="20%" align="right"><font size="6">&nbsp;</font><br/><font size="9"><i>'.date("d M Y g:i a").'</i></font></td>
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
    
    $pdf->SetFont('times', '', 6);
    
    $content = '
    <table cellpadding="2">
        <thead>
            <tr>
                <th width="5%" align="center"><strong><i>No.</i></strong></th>
                <th width="12%"><strong><i>Inventory Category</i></strong></th>
                <th width="10%"><strong><i>Item Name</i></strong></th>
                <th width="10%"><strong><i>Username</i></strong></th>
                <th width="8%"><strong><i>Date</i></strong></th>
                <th width="10%"><strong><i>Stock Received</i></strong></th>
                <th width="5%"><strong><i>Total</i></strong></th>
                <th width="10%"><strong><i>Quantity Taken</i></strong></th>
                <th width="6%"><strong><i>Balance</i></strong></th>
                <th width="24%"><strong><i>Notes</i></strong></th>
            </tr>
        </thead>
        <tbody>
    ';
    for( $i = 1; $i<=45; $i++ ) { 
        if ($i % 2 == 0) {
            $col="";
        }
        else {
            $col="#cccccc";
        }
        $content .= ' 
            <tr bgcolor="'.$col.'" nobr="true">
                <td width="5%" align="center">'.$i.'</td>
                <td width="12%">solvent & acid-E</td>
                <td width="10%">Denatured Ethyl Alcohol (Ethanol)</td>
                <td width="10%">rosilah</td>
                <td width="8%">6th Feb 2015</td>
                <td width="10%"></td>
                <td width="5%">10</td>
                <td width="10%">5</td>
                <td width="6%">5</td>
                <td width="24%">taken by sapiah 5/2/15 absolute 2 taken by md noor</td>
            </tr> ';
    }
    $content .= '</tbody></table>';
    
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('customer.pdf', 'I');  
}

else if (isset($_POST["userReport"]))  {      
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
                        <font size="16">User Information Report</font><br/><font size="8">'.get_status($_POST["urp_srch_status"]).'</font>
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
    $pdf->SetTitle('User Information Report');

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
    <table cellpadding="2">
        <thead>
            <tr>
                <th width="5%" align="center"><strong><i>No.</i></strong></th>
                <th width="10%"><strong><i>Username</i></strong></th>
                <th width="12%"><strong><i>Full Name</i></strong></th>
                <th width="10%"><strong><i>Designation</i></strong></th>
                <th width="15%"><strong><i>Organisation</i></strong></th>
                <th width="10%"><strong><i>Telephone</i></strong></th>
                <th width="18%"><strong><i>E-mail</i></strong></th>
                <th width="10%"><strong><i>User Status</i></strong></th>
                <th width="10%"><strong><i>Date created</i></strong></th>
            </tr>
        </thead>
        <tbody>
    ';
    $content .= get_user($_POST["urp_srch_status"], $_POST["urp_srch_order1"], $_POST["urp_srch_order2"], $_POST["urp_srch_order3"]);
    $content .= '</tbody></table>';
    
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('User Report '.date("d-M-Y").'.pdf', 'I');  
}

else if(isset($_POST["custReport"]))  {   
    
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
                        <font size="16">Customer Information Report</font><br/><font size="8">'.get_category($_POST["crp_srch_group"]).'</font>
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
    $pdf->SetTitle('Customer Information Report');

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
    <table cellpadding="2">
        <thead>
            <tr>
                <th width="5%" align="center"><strong><i>No.</i></strong></th>
                <th width="20%"><strong><i>Customer</i></strong></th>
                <th width="20%"><strong><i>Person in charge</i></strong></th>
                <th width="25%"><strong><i>Address</i></strong></th>
                <th width="20%"><strong><i>Telephone/Fax/E-mail</i></strong></th>
                <th width="10%"><strong><i>Date created</i></strong></th>
            </tr>
        </thead>
        <tbody>
    ';
    $content .= get_customer($_POST["crp_srch_group"], $_POST["crp_srch_status"], $_POST["crp_srch_order1"], $_POST["crp_srch_order2"], $_POST["crp_srch_order3"]);
    $content .= '</tbody></table>';
    
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Customer Report '.date("d-M-Y").'.pdf', 'I');  
}

else if(isset($_POST["certStats"]))  {   
    
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

else if(isset($_POST["sampleStats"]))  {   
    
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

else if(isset($_POST["testStats"]))  {   
    
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

else if(isset($_POST["incSampleStats"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../../img/mpob.PNG" alt="MPOB"  width="28"></td>
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

elseif(isset($_POST["invReport"]))  {   
    
    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetY(10);
            $this->SetFont('times', '');
            $html = '
            <hr>
            <table cellpadding="4" >
                <tr>
                    <td width="20%"><img src="../../img/mpob.PNG" alt="MPOB"  width="28"></td>
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
    <table cellpadding="1">
        <thead>
            <tr>
                <th width="5%" align="center"><strong><i>No.</i></strong></th>
                <th width="14%"><strong><i>Inventory Category</i></strong></th>
                <th width="11%"><strong><i>Item Name</i></strong></th>
                <th width="8%"><strong><i>Username</i></strong></th>
                <th width="13%"><strong><i>Date</i></strong></th>
                <th width="10%" align="center"><strong><i>Stock Received</i></strong></th>
                <th width="5%" align="center"><strong><i>Total</i></strong></th>
                <th width="10%" align="center"><strong><i>Quantity Taken</i></strong></th>
                <th width="6%" align="center"><strong><i>Balance</i></strong></th>
                <th width="18%"><strong><i>Notes</i></strong></th>
            </tr>
        </thead>
        <tbody>
    ';
    $content .= get_invReport($_POST["itr_srch_month1"], $_POST["itr_srch_day1"], $_POST["itr_srch_year1"], $_POST["itr_srch_month2"], $_POST["itr_srch_day2"], $_POST["itr_srch_year2"], $_POST["itr_srch_order1"], $_POST["itr_srch_order2"], $_POST["itr_srch_order3"], $_POST["itr_srch_usrnme"], $_POST["itr_srch_category"], $_POST["itr_srch_item"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Inventory Transaction Report '.date("d-M-Y").'.pdf', 'I');  
}

else if(isset($_POST["phyRepStats"]))  {   
    
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

else if(isset($_POST["phyTestStats"]))  {   
    
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

else if(isset($_POST["effTestStats"]))  {   
    
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
                        <font size="16">Test Statistic Report</font><br/><font size="8">'.get_sources($_POST["ets_srch_sample"]).'</font>
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
    
    $content = '<span align="center"><font size="9"><strong>Total number of samples received by Efficacy Testing Service Lab, AOTD<br/>From '.$_POST["ets_srch_day1"].' '.get_month($_POST["ets_srch_month1"]).' '.$_POST["ets_srch_year1"].' To '.$_POST["ets_srch_day2"].' '.get_month($_POST["ets_srch_month2"]).' '.$_POST["ets_srch_year2"].'</strong></font></span>
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
    $content .= get_effTestStats($_POST["ets_srch_month1"], $_POST["ets_srch_day1"], $_POST["ets_srch_year1"], $_POST["ets_srch_month2"], $_POST["ets_srch_day2"], $_POST["ets_srch_year2"], $_POST["ets_srch_test"], $_POST["ets_srch_sample"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('EFF-TestStatisticReport'.date("d-M-Y").'.pdf', 'I');  
}

else if(isset($_POST["effRepStats"]))  {   
    
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
                        <font size="16">Report Statistic</font><br/><font size="8">'.get_sources($_POST["ers_srch_sample"]).'</font>
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
    
    $content = '<span align="center"><font size="9"><strong>Reports received by Efficacy Testing Service Lab, AOTD <br/>From '.get_month($_POST["ers_srch_month1"]).' '.$_POST["ers_srch_year1"].' To '.get_month($_POST["ers_srch_month2"]).' '.$_POST["ers_srch_year2"].'</strong></font></span>
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
    $content .= get_effRepStats($_POST["ers_srch_month1"], $_POST["ers_srch_year1"], $_POST["ers_srch_month2"], $_POST["ers_srch_year2"], $_POST["ers_srch_sample"]);
    $content .= '</tbody></table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('EFF-ReportStatistic'.date("d-M-Y").'.pdf', 'I');  
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
            </table>
';
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
            </table>
';
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
            </table>
';
    $pdf->SetX(25);
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('Memorandum'.$_POST['mpr_phyRep_no'].''.date("dmY").'.pdf', 'I');
}

else if (isset($_POST["effReport"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetY(15);
            $this->SetFont('times', '', 8);
            $html = '<table border="0" cellpadding="2">
                <tr>
                    <th>Confidential</th>
                    <th><span style="text-align: center;">Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().'</span></th>
                    <th><span style="text-align: right;">'.$_POST['mer_effRep_no'].'</span></th>
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
    $pdf->SetTitle('Efficacy Testing Services Report');

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
            <table border="0" cellpadding="4">
                <tr>
                    <th width="100" align="center"><img src="../../img/mpob.PNG" alt="MPOB"  width="60"></th>
                    <th width="400" align="center"><font size="14">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        '.strtoupper($_POST['mer_lab_name']).'</font>
                    </th>
                </tr>
            </table>
            <br/><br/>
            <table border="0" cellpadding="2">
                <tr>
                    <th style="background-color: black;" align="center"><font style="color: white; font-weight: bold;">'.$_POST['mer_effTest_name'].'</font></th>
                </tr>
            </table>
            <br/><br/>
            <table border="0" cellpadding="5">
                <tr>
                    <td width="100">STUDY :</td>
                    <td>'.$_POST['mer_effRep_no'].'</td>
                </tr>
                <tr>
                    <td width="100">APPLICANT :</td>
                    <td>'.$_POST['mer_client_pic'].'<br/>'.$_POST['mer_client_organisation'].'<br/>'.nl2br($_POST['mer_client_address']).'<br/>'.$_POST['mer_client_postcode'].' '.$_POST['mer_client_city'].'<br/>'.$_POST['mer_client_state'].'<br/>Tel: '.$_POST['mer_client_phoneNo'].'<br/>Fax: '.$_POST['mer_client_faxNo'].'</td>
                </tr>
                <tr>
                    <td width="100">PRODUCT :</td>
                    <td>'.get_productName($_POST['mer_effRep_no']).'</td>
                </tr>
                <tr>
                    <td width="200">STARTING DATE :</td>
                    <td>'.$_POST['mer_timeStarted'].'</td>
                </tr>
                <tr>
                    <td width="200">DATE COMPLETED :</td>
                    <td>'.$_POST['mer_timeCompleted'].'</td>
                </tr>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <span style="font-style: italic;">"The data given in this report are exclusively referred to the samples tested. This report can only be reproduced in full."</span>
            <br/><br/><br/><br/>
            .............................................
            <br/><font style="font-weight: bold;">'.strtoupper($_POST['mer_name_head_unit']).'</font>
            <br/><font style="font-weight: bold;">HEAD OF UNIT</font>
            <br/><font style="font-weight: bold;">ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</font>
            <br/><font style="font-weight: bold;">MPOB</font>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);    
    $pdf->AddPage();
    $content = '
            <span align="center">SAMPLE DATASHEET</span><br/><br/>
            <table border="0" cellpadding="7">
                <tr>
                    <td width="150">SAMPLE REFERENCE :</td>
                    <td>'.get_sampleRef($_POST['mer_effRep_no']).'</td>
                </tr>
                <tr>
                    <td width="200">SAMPLE NUMBER :</td>
                    <td>'.$_POST['mer_effRep_totalSample'].'</td>
                </tr>
                <tr>
                    <td width="200">SAMPLE ARRIVAL DATE :</td>
                    <td>'.$_POST['mer_timeReceived'].'</td>
                </tr>
                <tr>
                    <td width="200">STARTING DATE :</td>
                    <td>'.$_POST['mer_timeStarted'].'</td>
                </tr>
                <tr>
                    <td width="200">DATE COMPLETED :</td>
                    <td>'.$_POST['mer_timeCompleted'].'</td>
                </tr>
                <tr>
                    <td width="200">PRODUCT :<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EFFSICAL FORM :<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QUANTITY :<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;COLOUR :</td><td><span> </span><br/>'.$_POST['mer_effRep_physical'].'<br/>'.$_POST['mer_effRep_quantity'].'<br/>'.$_POST['mer_effRep_color'].'</td>
                </tr>
                <tr>
                    <td width="285">OTHER INFORMATION RELATED TO THE PRODUCT :</td>
                    <td>'.get_othersInformation($_POST['mer_effRep_other']).'</td>
                </tr>
            </table>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);    
    $pdf->AddPage();
    $content = '
            <span align="center">'.$_POST['mer_effTest_name'].'</span><br/><br/>
            <br/><br/><br/><br/><font align="center" size="12">REPORT ISSUED BY</font>
            <br/><br/><br/><br/><font align="center" size="12">...........................</font>
            <br/><font align="center" size="12">'.strtoupper($_POST['mer_name_head_unit']).'</font>
            <br/><font align="center" size="12">SENIOR RESEARCH OFFICER</font>
            <br/><font align="center" size="12">AOTD,MPOB</font>';
    $pdf->writeHTML($content, true, false, true, false, '');
    $pdf->Output('EfficacyReport'.date("d-M-Y").'.pdf', 'I');
}

else if (isset($_POST["effCover"])) {

    class MYPDF extends TCPDF {

        public function Header() {
            $this->SetY(15);
            $this->SetFont('times', '', 12);
            $html = '<table border="0" cellpadding="4">
                <tr>
                    <th width="80" align="center"><img src="../../img/mpob.PNG" alt="MPOB"  width="50"></th>
                    <th width="380" align="center">
                        <strong>MALAYSIAN PALM OIL BOARD</strong><br/>
                        <strong>ADVANCED OLEOCHEMICAL TECHNOLOGY DIVISION</strong><br/>
                        <font align="center" size="12">'.strtoupper($_POST['mer_lab_name']).' LABORATORY</font>
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
    $pdf->SetTitle('Efficacy Testing Services Cover Letter');

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
        <strong>'.$_POST['mer_client_organisation'].'</strong><br/>'.nl2br($_POST['mer_client_address']).'<br/>'.$_POST['mer_client_postcode'].' '.$_POST['mer_client_city'].'<br/>'.$_POST['mer_client_state'].'<br/>
        <br/><br/>(Attention : '.$_POST['mer_client_pic'].')<br/><br/><br/>
        Dear Sir/Madam,<br/><br/>
        <strong>RESULTS OF ANALYSIS</strong><br/><br/>
        With reference to your mail dated '.$_POST['mer_timeReceived'].', we enclosed herewith the efficacy test report (Report. No. '.$_POST['mer_effRep_no'].') of the samples sent in by you.<br/><br/>
        Our Accounts Department will send the invoice for the services provided under separate cover .<br/><br/>
        Thank you.<br/><br/><br/><br/>
        Yours sincerely,<br/><br/><br/>
        ..............................<br/>
        <strong>DR. ZAINAB IDRIS</strong><br/>
        Director<br/>
        Advanced Oleochemical Technology Division<br/>
        Malaysian Palm Oil Board
        <br/><br/><br/>
        cc:<ol type="i"><li>Head Of Consumer Product Development Unit, MPOB</li><li>Accounts Unit, MPOB</li></ol>
        ';
    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('EfficacyCoverLetter'.date("d-M-Y").'.pdf', 'I');
} 