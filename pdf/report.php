<?php
require_once('../pdf/funct.php');

if (isset($_POST["userReport"]))  {      
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
                    <td width="20%"><img src="../img/mpob.PNG" alt="MPOB"  width="32"></td>
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

else if(isset($_POST["invReport"]))  {   
    
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


