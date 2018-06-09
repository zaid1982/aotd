<?php
date_default_timezone_set("Asia/Kuala_Lumpur"); 
require_once('../tcpdf/tcpdf.php');

$config = parse_ini_file('../library/config.ini');
$log_dir = $config['log_dir'];

function log_debug($line, $msg, $log_dir) {
    $debugMsg = date("Y/m/d h:i:sa")." [".__FILE__.":".$line."] - ".$msg."\r\n";
    error_log($debugMsg, 3, $log_dir.'/debug/debug_'.date("Ymd").'.log');
}

function get_connect() {
    $config = parse_ini_file('../library/config.ini');
    $dbname = $config['dbname'];    
    $dbhost = $config['dbhost'];
    $connect = mysqli_connect($dbhost, $config['username'], $config['password'], $dbname);
    return $connect;
}

function get_month($month) {
    switch ($month) {
        case '01':
            $month = 'January';
            break;
        case '02':
            $month = 'February';
            break;
        case '03':
            $month = 'March';
            break;
        case '04':
            $month = 'April';
            break;
        case '05':
            $month = 'May';
            break;
        case '06':
            $month = 'June';
            break;
        case '07':
            $month = 'July';
            break;
        case '08':
            $month = 'August';
            break;
        case '09':
            $month = 'September';
            break;
        case '10':
            $month = 'October';
            break;
        case '11':
            $month = 'November';
            break;
        case '12':
            $month = 'December';
            break;
        default:
            $month = '';
            break;
    }
        return $month;
}

function get_category($group) {
    if ($group == '') { $category = 'All Categories'; }
    else {
        $sql = "SELECT
            aa.clientGrp_name AS category
    FROM aotd_client_info
    LEFT JOIN aotd_client_group aa ON aa.clientGrp_id = aotd_client_info.clientGrp_id
    WHERE aotd_client_info.clientGrp_id = '".$group."'
        ";
        $result = mysqli_query(get_connect(), $sql);
        $row = mysqli_fetch_assoc($result);
        $category = $row["category"];
    }
    return $category;
}

function get_othersInformation($a) {
    if ($a == '') { $other = 'None'; }
    else {
        $other = $a;
    }
    return $other;
}

function get_sources($source) {    
    if ($source == 'INT') { $category = 'Internal'; }
    else if ($source == 'EXT') { $category = 'External'; }
    else { $category = 'All Sources'; }
    return $category;
}

function get_customer($group, $status, $order1, $order2, $order3)  {
    $whereSearch = '';
    $orderSearch = '';
    $bil = 1;
    $output = '';
    if ($group == '' && $status == '') { $whereSearch = ''; }
    else if ($group != '' && $status == '') { $whereSearch = 'WHERE aotd_client_info.clientGrp_id = '.$group; }
    else if ($group == '' && $status != '') { $whereSearch = 'WHERE aotd_client_info.client_black = '.$status; }
    else { $whereSearch = 'WHERE aotd_client_info.clientGrp_id = '.$group.' AND aotd_client_info.client_black = '.$status; }
    if ($order1 != '') { $orderSearch = 'ORDER BY '.$order1; }
    else if ($order2 != '') { $orderSearch = 'ORDER BY '.$order1.','.$order2; }
    else if ($order3 != '') { $orderSearch = 'ORDER BY '.$order1.','.$order2.','.$order3; }
    else { $orderSearch = ''; }
    $sql = "SELECT
            aa.clientGrp_name AS clientCategory,
            CONCAT(client_phoneNo,'<br/>',client_faxNo,'<br/>',client_email) AS clientContact,
            CONCAT(client_address,'<br/>',client_city,' ',client_state,'<br/>',client_postcode,' ',cc.country_desc) AS clientAddress, 
            DATE_FORMAT(client_timeCreated, '%D %b %Y') AS dateCreated,
            aotd_client_info.*
    FROM aotd_client_info
    LEFT JOIN aotd_client_group aa ON aa.clientGrp_id = aotd_client_info.clientGrp_id
    LEFT JOIN ref_country cc ON cc.country_id = aotd_client_info.country_id ".$whereSearch." ".$orderSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        if ($bil % 2 == 0) { $bgcolor=""; }
        else { $bgcolor="#cccccc"; }
        $output .= '
            <tr bgcolor="'.$bgcolor.'" nobr="true">
                <td width="5%" align="center">'.$bil++.'</td>
                <td width="20%">'.$row["client_organisation"].'</td>
                <td width="20%">'.$row["client_pic"].'</td>
                <td width="25%">'.$row["clientAddress"].'</td>
                <td width="20%">'.$row["clientContact"].'</td>
                <td width="10%">'.$row["dateCreated"].'</td>
            </tr> ';
    }  
    return $output;
}

function get_status($group) {
    if ($group == '') { $category = 'All Status'; }
    else {
        $sql = "SELECT
	ss.status_desc AS statusUser
    FROM aotd_user_profile
    LEFT JOIN aotd_status_type ss ON ss.`status` = aotd_user_profile.`status` 
    WHERE aotd_user_profile.`status` = '".$group."'
        ";
        log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
        $result = mysqli_query(get_connect(), $sql);
        $row = mysqli_fetch_assoc($result);
        $category = $row["statusUser"];
    }
    return $category;
}

function get_designation($id) {
    $sql = "SELECT * FROM profile WHERE profile_id = '".$id."'
    ";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);
    $row = mysqli_fetch_assoc($result);
    $profile_designation = $row["profile_designation"];
    return $profile_designation;
}

function get_user($status, $order1, $order2, $order3)  {
    $whereSearch = '';
    $orderSearch = '';
    $bil = 1;
    $output = '';
    if ($status == '') { $whereSearch = ''; }
    else  { $whereSearch = 'WHERE aotd_user_profile.`status` = "'.$status.'"'; }
    if ($order3 != '') { $orderSearch = 'ORDER BY `'.$order1.'`,`'.$order2.'`,`'.$order3.'`'; }
    else if ($order2 != '') { $orderSearch = 'ORDER BY `'.$order1.'`,`'.$order2.'`'; }
    else if ($order1 != '') { $orderSearch = 'ORDER BY `'.$order1.'`'; }
    else { $orderSearch = ''; }
    $sql = "SELECT
	ss.status_desc AS statusUser,
        DATE_FORMAT(FROM_UNIXTIME(`date_created`), '%D %b %Y') AS dateCreated,
	aotd_user_profile.*
    FROM aotd_user_profile
    LEFT JOIN aotd_status_type ss ON ss.`status` = aotd_user_profile.`status` ".$whereSearch." ".$orderSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);  
    while($row = mysqli_fetch_assoc($result))  
    {   
        if ($bil % 2 == 0) { $bgcolor=""; }
        else { $bgcolor="#cccccc"; }
        $output .= '
            <tr bgcolor="'.$bgcolor.'" nobr="true">
                <td width="5%" align="center">'.$bil++.'</td>
                <td width="10%">'.$row["username"].'</td>
                <td width="12%">'.$row["firstname"].' '.$row["lastname"].'</td>
                <td width="10%">'.$row["designation"].'</td>
                <td width="15%">'.$row["organisation"].'</td>
                <td width="10%">'.$row["telephone"].'</td>
                <td width="18%">'.$row["email"].'</td>
                <td width="10%">'.$row["statusUser"].'</td>
                <td width="10%">'.$row["dateCreated"].'</td>
            </tr> ';
    }  
    return $output;
}

function get_certStats($month1, $year1, $month2, $year2, $sample)  {
    $whereSource = '';
    if ($sample == '') { $whereSource = ''; }
    else { $whereSource = "AND clientType_id = '".$sample."'"; }
    $whereSearch = "WHERE (DATE(atsCert_timeReceived) BETWEEN '".$year1."-".$month1."-01' AND '".$year2."-".$month2."-31') ".$whereSource;
    $bil = 1;
    $output = '';
    $sql = "SELECT atsCert_no, DATE_FORMAT(atsCert_timeReceived, '%D %M %Y') AS timeReceived, atsCert_timeReceived FROM ats_sample_log ".$whereSearch." ORDER BY atsCert_timeReceived";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= '
            <tr nobr="true">
                <td style="border-right: 1px solid black;" width="20%" align="center">'.$bil++.'</td>
                <td style="border-right: 1px solid black;" width="40%">'.$row["atsCert_no"].'</td>
                <td width="40%">'.$row["timeReceived"].'</td>
            </tr> ';
    }  
    return $output;
}

function get_resultPhy($phyRep_no)  {
    $whereSearch = "WHERE phyRep_no = '".$phyRep_no."'";
    $output = '';
    $sql = "SELECT * FROM phy_sample_info ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= '<table border="0"><tr><td>Client Sample Code: '.$row['phyLab_sampleCode'].'</td><td>Lab Code: '.$row['phyLab_code'].'</td></tr></table><br/><br/>';
        $output .= '<table border="1" cellpadding="4"> 
                        <tr>
                            <td colspan="2" align="center">Test Result</td>
                        </tr>
                        <tr>
                            <td align="center">Field</td>
                            <td align="center">Result</td>
                        </tr>';
        $sql1 = "SELECT
                phy_sample_info.phyLab_sampleCode AS phyLab_sampleCode,
                phy_test_res.*,
                phy_field.phyField_name AS phyField_name,
                phy_field.phyField_status AS phyField_status
                FROM phy_test_res 
                LEFT JOIN phy_field ON phy_field.phyField_id = phy_test_res.phyField_id
                LEFT JOIN phy_sample_info ON phy_sample_info.phyLab_code = phy_test_res.phyLab_code
                WHERE phy_test_res.phyLab_code = '".$row["phyLab_code"]."'";
        log_debug(__LINE__, $sql1, $GLOBALS['log_dir']);
        $result1 = mysqli_query(get_connect(), $sql1);    
        while($row1 = mysqli_fetch_assoc($result1))  
        { 
            $output .= '<tr>
                            <td>'.$row1['phyField_name'].'</td>
                            <td>'.$row1['phyRes_res'].'</td>
                        </tr>';
        }
        $output .= '</table><br/><br/>';
    }  
    
    return $output;
}

function get_resultEff($effRep_no)  {
    $whereSearch = "WHERE effRep_no = '".$effRep_no."'";
    $output = '';
    $sql = "SELECT * FROM eff_sample_info ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= '<table border="0"><tr><td>Client Sample Code: '.$row['effLab_sampleCode'].'</td><td>Lab Code: '.$row['effLab_code'].'</td></tr></table><br/><br/>';
        $output .= '<table border="1" cellpadding="4"> 
                        <tr>
                            <td colspan="2" align="center">Test Result</td>
                        </tr>
                        <tr>
                            <td align="center">Field</td>
                            <td align="center">Result</td>
                        </tr>';
        $sql1 = "SELECT
                eff_sample_info.effLab_sampleCode AS effLab_sampleCode,
                eff_test_res.*,
                eff_field.effField_name AS effField_name,
                eff_field.effField_status AS effField_status
                FROM eff_test_res 
                LEFT JOIN eff_field ON eff_field.effField_id = eff_test_res.effField_id
                LEFT JOIN eff_sample_info ON eff_sample_info.effLab_code = eff_test_res.effLab_code
                WHERE eff_test_res.effLab_code = '".$row["effLab_code"]."'";
        log_debug(__LINE__, $sql1, $GLOBALS['log_dir']);
        $result1 = mysqli_query(get_connect(), $sql1);    
        while($row1 = mysqli_fetch_assoc($result1))  
        { 
            $output .= '<tr>
                            <td>'.$row1['effField_name'].'</td>
                            <td>'.$row1['effRes_res'].'</td>
                        </tr>';
        }
        $output .= '</table><br/><br/>';
    }  
    
    return $output;
}

function get_productName($no)  {
    $whereSearch = "WHERE effRep_no = '".$no."'";
    $output = '';
    $sql = "SELECT GROUP_CONCAT(DISTINCT effLab_sampleCode SEPARATOR '<br/>') AS effLab_sampleCode FROM eff_sample_info ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= $row["effLab_sampleCode"];
    }  
    return $output;
}

function get_reason($no)  {
    $whereSearch = "WHERE phyRep_no = '".$no."'";
    $output = '';
    $sql = "SELECT phyRep_reason FROM phy_sample_log ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        if($row["phyRep_reason"] == "") {
            $output .= "";
        } else {
            $output .= "<br/>(Note: ".$row["phyRep_reason"].")";
        }
            
    }  
    return $output;
}

function get_samplePhy($no)  {
    $whereSearch = "WHERE phyRep_no = '".$no."'";
    $output = '';
    $sql = "SELECT * FROM phy_sample_info ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= $row["phyLab_sampleCode"]."<br/>";
    }  
    return $output;
}

function get_sampleAna($no)  {
    $whereSearch = "WHERE atsCert_id = '".$no."'";
    $output = '';
    $sql = "SELECT * FROM ats_sample_info ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= $row["atsLab_sampleCode"]."<br/>";
    }  
    return $output;
}

function get_testAna($no)  {
    $whereSearch = "WHERE ats_sample_log.atsCert_id = '".$no."'";
    $output = '';
    $jumlah = 0;
    $sql = "SELECT
    ats_sample_log.atsCert_id AS atsCert_id,
    ats_test.atsTest_name AS atsTest_name,
    ats_test.atsTest_cost AS atsTest_cost,
    ats_sample_log.atsCert_totalSample AS atsCert_totalSample,
    1 AS atsCount_test
FROM ats_sample_log
LEFT JOIN ats_cert_test ON ats_cert_test.atsCert_id = ats_sample_log.atsCert_id
LEFT JOIN ats_test ON ats_test.atsTest_id = ats_cert_test.atsTest_id ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $jumlah = floatval($row['atsTest_cost'])*intval($row['atsCert_totalSample']) + $jumlah;
        $output .= '<tr>
                    <th width="40%">'.$row['atsTest_name'].'</th>
                    <th width="15%" align="right">'.floatval($row['atsTest_cost']).'</th>
                    <th width="15%" align="right">'.intval($row['atsCert_totalSample']).'</th>
                    <th width="15%" align="right">'.intval($row['atsCount_test']).'</th>
                    <th width="15%" align="right">'.floatval($row['atsTest_cost'])*intval($row['atsCert_totalSample']).'</th>
                </tr>';
    }  
    $jumlahs = floatval($jumlah);
    $gst = (floatval($jumlah))*0.06;
    $aftergst = $jumlahs + $gst;
    $output .= '<tr>
                    <th width="85%" align="right">JUMLAH</th>
                    <th width="15%" align="right">RM '.floatval($jumlah).'</th>
                </tr>
                <tr>
                    <th width="85%" align="right">GST (6%)</th>
                    <th width="15%" align="right">RM '.(floatval($jumlah))*0.06.'</th>
                </tr>
                <tr>
                    <th width="85%" align="right">JUMLAH TERMASUK GST</th>
                    <th width="15%" align="right">RM '.floatval($aftergst).'</th>
                </tr>';
    return $output;
}

function get_sampleEff($no)  {
    $whereSearch = "WHERE effRep_no = '".$no."'";
    $output = '';
    $sql = "SELECT * FROM eff_sample_info ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= $row["effLab_sampleCode"]."<br/>";
    }  
    return $output;
}

function totalAfterGST($jumlah, $sample)  {
    $output = $jumlah + (($jumlah * $sample) * 0.06);
    return $output;
}

function get_sampleRef($no)  {
    $whereSearch = "WHERE effRep_no = '".$no."'";
    $output = '';
    $sql = "SELECT GROUP_CONCAT(DISTINCT CONCAT(effLab_sampleCode,' (',effLab_code,')') SEPARATOR '<br/>') AS effLab_sampleCode FROM eff_sample_info ".$whereSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= $row["effLab_sampleCode"];
    }  
    return $output;
}

function get_sampleStats($month1, $year1, $month2, $year2, $sample)  {
    $whereSource = '';
    if ($sample == '') { $whereSource = ''; }
    else { $whereSource = "AND ats_sample_log.clientType_id = '".$sample."'"; }
    $whereSearch = "WHERE (DATE(atsCert_timeReported) BETWEEN '".$year1."-".$month1."-01' AND '".$year2."-".$month2."-31') ".$whereSource;
    $bil = 1;
    $output = '';
    $sql = "SELECT
	gg.clientGrp_name AS clientGrp_name,
	cc.clientGrp_id,
	SUM(ats_sample_log.atsCert_totalSample) AS totalSample
    FROM ats_sample_log
    LEFT JOIN aotd_client_info cc ON cc.client_id =  ats_sample_log.client_id
    LEFT JOIN aotd_client_group gg ON gg.clientGrp_id = cc.clientGrp_id ".$whereSearch." GROUP BY clientGrp_id ORDER BY clientGrp_name";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))   {   
        $output .= '
            <tr nobr="true">
                <td style="border-right: 1px solid black;" width="25%" align="center">'.$bil++.'</td>
                <td style="border-right: 1px solid black;" width="50%">'.$row["clientGrp_name"].'</td>
                <td width="25%" align="center">'.$row["totalSample"].'</td>
            </tr> ';        
    }  
    $output .= '</tbody></table>';
    $sql2 = "SELECT
	gg.clientGrp_name AS clientGrp_name,
	cc.clientGrp_id,
	SUM(ats_sample_log.atsCert_totalSample) AS totalSample
    FROM ats_sample_log
    LEFT JOIN aotd_client_info cc ON cc.client_id =  ats_sample_log.client_id
    LEFT JOIN aotd_client_group gg ON gg.clientGrp_id = cc.clientGrp_id ".$whereSearch." GROUP BY clientGrp_id ORDER BY clientGrp_name";
    log_debug(__LINE__, $sql2, $GLOBALS['log_dir']);
    $result2 = mysqli_query(get_connect(), $sql2);
    while($row2 = mysqli_fetch_assoc($result2))   {               
        $output .= '<br/><br/><br/><span align="center"><font size="10"><strong>Time taken to analyse samples from '.$row2["clientGrp_name"].'</strong></font></span><br/><br/>
        <table style="border-collapse:collapse; border: 1px solid black;" cellpadding="3">
            <thead>
                <tr>
                    <th border="1" width="20%" align="center"><strong><i>No. of Sample</i></strong></th>
                    <th border="1" width="14%" align="center"><strong><i>1 day</i></strong></th>
                    <th border="1" width="14%" align="center"><strong><i>7 days</i></strong></th>
                    <th border="1" width="14%" align="center"><strong><i>2 weeks</i></strong></th>
                    <th border="1" width="14%" align="center"><strong><i>2-4 weeks</i></strong></th>
                    <th border="1" width="14%" align="center"><strong><i>> 4 weeks</i></strong></th>
                    <th border="1" width="10%" align="center"><strong><i>Total</i></strong></th>
                </tr>
            </thead>
            <tbody>';
        $sql3 = "SELECT
            DATE_FORMAT(atsCert_timeReported,'%M %Y') as dateSample,
            gg.clientGrp_name AS clientGrp_name,
            cc.clientGrp_id AS clientGrp_id,
            SUM(ats_sample_log.atsCert_totalSample) AS atsCert_totalSample,
            SUM(IF(ats_sample_log.atsCert_days <= 1, ats_sample_log.atsCert_totalSample, 0)) AS oneDay,
            SUM(IF(ats_sample_log.atsCert_days > 1 AND ats_sample_log.atsCert_days <= 7, ats_sample_log.atsCert_totalSample, 0)) AS sevenDays,
            SUM(IF(ats_sample_log.atsCert_days > 7 AND ats_sample_log.atsCert_days <= 10, ats_sample_log.atsCert_totalSample, 0)) AS twoWeeks,
            SUM(IF(ats_sample_log.atsCert_days <= 20 AND ats_sample_log.atsCert_days > 10, ats_sample_log.atsCert_totalSample, 0)) AS fourWeeks,
            SUM(IF(ats_sample_log.atsCert_days > 20, ats_sample_log.atsCert_totalSample, 0)) AS moreFourWeeks
        FROM ats_sample_log
        LEFT JOIN aotd_client_info cc ON cc.client_id =  ats_sample_log.client_id 
        LEFT JOIN aotd_client_group gg ON gg.clientGrp_id = cc.clientGrp_id 
        ".$whereSearch." AND cc.clientGrp_id = '".$row2["clientGrp_id"]."'
        GROUP BY clientGrp_id, dateSample
        ORDER BY clientGrp_name, DATE_FORMAT(atsCert_timeReported,'%m')";
        log_debug(__LINE__, $sql3, $GLOBALS['log_dir']);
        $result3 = mysqli_query(get_connect(), $sql3); 
        while($row3 = mysqli_fetch_assoc($result3))   {
            $output .= '
                <tr>
                    <td style="border-right: 1px solid black;" width="20%">'.$row3["dateSample"].'</td>
                    <td style="border-right: 1px solid black;" width="14%" align="center">'.$row3["oneDay"].'</td>
                    <td style="border-right: 1px solid black;" width="14%" align="center">'.$row3["sevenDays"].'</td>
                    <td style="border-right: 1px solid black;" width="14%" align="center">'.$row3["twoWeeks"].'</td>
                    <td style="border-right: 1px solid black;" width="14%" align="center">'.$row3["fourWeeks"].'</td>
                    <td style="border-right: 1px solid black;" width="14%" align="center">'.$row3["moreFourWeeks"].'</td>
                    <td style="border-right: 1px solid black;" width="10%" align="center">'.$row3["atsCert_totalSample"].'</td>
                </tr>';
        }
        $sql4 = "SELECT
            gg.clientGrp_name AS clientGrp_name,
            cc.clientGrp_id AS clientGrp_id,
            SUM(ats_sample_log.atsCert_totalSample) AS atsCert_totalSample,
            SUM(IF(ats_sample_log.atsCert_days <= 1, ats_sample_log.atsCert_totalSample, 0)) AS oneDay,
            SUM(IF(ats_sample_log.atsCert_days > 1 AND ats_sample_log.atsCert_days <= 7, ats_sample_log.atsCert_totalSample, 0)) AS sevenDays,
            SUM(IF(ats_sample_log.atsCert_days > 7 AND ats_sample_log.atsCert_days <= 10, ats_sample_log.atsCert_totalSample, 0)) AS twoWeeks,
            SUM(IF(ats_sample_log.atsCert_days <= 20 AND ats_sample_log.atsCert_days > 10, ats_sample_log.atsCert_totalSample, 0)) AS fourWeeks,
            SUM(IF(ats_sample_log.atsCert_days > 20, ats_sample_log.atsCert_totalSample, 0)) AS moreFourWeeks
        FROM ats_sample_log
        LEFT JOIN aotd_client_info cc ON cc.client_id =  ats_sample_log.client_id 
        LEFT JOIN aotd_client_group gg ON gg.clientGrp_id = cc.clientGrp_id 
        ".$whereSearch." AND cc.clientGrp_id = '".$row2["clientGrp_id"]."'
        GROUP BY clientGrp_id
        ORDER BY clientGrp_name";
        log_debug(__LINE__, $sql4, $GLOBALS['log_dir']);
        $result4 = mysqli_query(get_connect(), $sql4);
        while($row4 = mysqli_fetch_assoc($result4))   {
        $output .= '
            <tr>
                <td style="border-right: 1px solid black;" width="20%">Total</td>
                <td style="border-right: 1px solid black;" width="14%" align="center">'.$row4["oneDay"].' ('.number_format((float)$row4['oneDay']/(float)$row4['atsCert_totalSample']*100, 2, '.', '').'%)</td>
                <td style="border-right: 1px solid black;" width="14%" align="center">'.$row4["sevenDays"].' ('.number_format((float)$row4['sevenDays']/(float)$row4['atsCert_totalSample']*100, 2, '.', '').'%)</td>
                <td style="border-right: 1px solid black;" width="14%" align="center">'.$row4["twoWeeks"].' ('.number_format((float)$row4['twoWeeks']/(float)$row4['atsCert_totalSample']*100, 2, '.', '').'%)</td>
                <td style="border-right: 1px solid black;" width="14%" align="center">'.$row4["fourWeeks"].' ('.number_format((float)$row4['fourWeeks']/(float)$row4['atsCert_totalSample']*100, 2, '.', '').'%)</td>
                <td style="border-right: 1px solid black;" width="14%" align="center">'.$row4["moreFourWeeks"].' ('.number_format((float)$row4['moreFourWeeks']/(float)$row4['atsCert_totalSample']*100, 2, '.', '').'%)</td>
                <td style="border-right: 1px solid black;" width="10%" align="center">'.$row4["atsCert_totalSample"].'</td>
            </tr>';
        }
        $output .= '
            </tbody></table>';
    }
    return $output;
}

function get_testStats($month1, $day1, $year1, $month2, $day2, $year2, $test, $sample)  {
    $whereSource = '';
    $whereTest = '';
    if ($sample == '') { $whereSource = ''; }
    else { $whereSource = "AND clientType_id = '".$sample."'"; }
    if ($test == '') { $whereTest = ''; }
    else { $whereTest = "tt.atsTest_id = '".$test."' AND"; }
    $whereSearch = "WHERE (DATE(atsCert_timeReported) BETWEEN '".$year1."-".$month1."-".$day1."' AND '".$year2."-".$month2."-".$day2."') AND bb.atsTest_name IS NOT NULL ".$whereSource;
    $bil = 1;
    $output = '';
    $sql = "SELECT 
        bb.atsTest_name AS testName,
        SUM(ats_sample_log.atsCert_totalSample) AS totalTest,
        SUM(ats_sample_log.atsCert_totalSample) * bb.atsTest_cost AS cost
    FROM ats_sample_log
    LEFT JOIN ats_cert_test tt ON ".$whereTest." tt.atsCert_id = ats_sample_log.atsCert_id
    LEFT JOIN ats_test bb ON bb.atsTest_id = tt.atsTest_id ".$whereSearch." GROUP BY testName";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql); 
    $sum = 0;
    while($row = mysqli_fetch_assoc($result))  
    {   
        $sum += (float)$row['cost'];
        $output .= '
            <tr nobr="true">
                <td style="border-right: 1px solid black;" align="center" width="10%">'.$bil++.'</td>
                <td style="border-right: 1px solid black;" width="40%">'.$row["testName"].'</td>
                <td style="border-right: 1px solid black;" width="20%" align="center">'.$row["totalTest"].'</td>
                <td align="right" width="30%">'.$row["cost"].'</td>
            </tr>';        
    }
    $total = number_format($sum, 2, '.', '');
    $output .= '
            <tr nobr="true">
                <td align="right" width="100%" colspan="3" border="1"><font size="9"><strong>Total: RM '.$total.'</strong></font></td>
            </tr>';
    return $output;
}

function get_incomingSample($month1, $year1, $month2, $year2)  {
    $whereSearch = "WHERE DATE(atsCert_timeReceived) BETWEEN '".$year1."-".$month1."-01' AND '".$year2."-".$month2."-31'";
    $bil = 1;
    $output = '';
    $sql ="SELECT
	ats_sample_log.atsCert_no AS certNo, 
	CONCAT(cc.client_organisation, ' (Attention: ', cc.client_pic, ')') AS customerName,
	atsCert_totalSample AS totalSample,
	GROUP_CONCAT(bb.atsTest_name SEPARATOR ', ') AS testName,
	DATE_FORMAT(atsCert_timeReceived, '%D %M %Y') AS dateReceived,
	DATE_FORMAT(atsCert_timeReported, '%D %M %Y') AS dateReported,
	ats_sample_log.atsCert_days AS daysTaken
    FROM ats_sample_log
    LEFT JOIN aotd_client_info cc ON cc.client_id =  ats_sample_log.client_id
    LEFT JOIN ats_cert_test tt ON tt.atsCert_id = ats_sample_log.atsCert_id
    LEFT JOIN ats_test bb ON bb.atsTest_id = tt.atsTest_id
    ".$whereSearch."
    GROUP BY certNo
    ORDER BY atsCert_timeReceived";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        if ($bil % 2 == 0) { $bgcolor=""; }
        else { $bgcolor="#cccccc"; }
        $output .= '
            <tr bgcolor="'.$bgcolor.'" nobr="true">
                <td width="17%">'.$row["certNo"].'</td>
                <td width="23%">'.$row["customerName"].'</td>
                <td width="15%" align="center">'.$row["totalSample"].'</td>
                <td width="25%">'.$row["testName"].'</td>
                <td width="12%">'.$row["dateReceived"].'</td>
                <td width="8%" align="center">'.$row["daysTaken"].'</td>
            </tr> ';
        $bil++;
    }  
    return $output;
}

function get_invReport($month1, $day1, $year1, $month2, $day2, $year2, $order1, $order2, $order3, $username, $category, $item)  {
    $orderSearch = '';
    $whereUsername = '';
    $whereCategory = '';
    $whereItem = '';
    if ($order3 != '') { $orderSearch = 'ORDER BY `'.$order1.'`,`'.$order2.'`,`'.$order3.'`'; }
    else if ($order2 != '') { $orderSearch = 'ORDER BY `'.$order1.'`,`'.$order2.'`'; }
    else if ($order1 != '') { $orderSearch = 'ORDER BY `'.$order1.'`'; }
    else { $orderSearch = ''; }
    $whereSearch = "WHERE (DATE_FORMAT(FROM_UNIXTIME(`date_trans`),'%Y-%m-%d') BETWEEN '".$year1."-".$month1."-".$day1."' AND '".$year2."-".$month2."-".$day2."')";
    if ($username != '') { $whereUsername = "AND aa.user_id = '".$username."'"; }
    if ($category != '') { $whereCategory = "AND cc.inventory_type_id = '".$category."'"; }
    if ($item != '') { $whereItem = "AND bb.inventory_id = '".$item."'"; }
    $bil = 1;
    $output = '';
    $sql ="SELECT
	aa.transaction_id AS transaction_id,
	cc.inventory_type AS inventory_type,
	cc.inventory_type_id AS inventory_type_id,
	bb.item_name AS item_name,
	dd.user_name AS user_name,
	DATE_FORMAT(FROM_UNIXTIME(`date_trans`),'%D %M %Y') AS date_transaction,
	stock_purchased,
	total_stock,
	quantity_taken,
	aa.balance AS balance,
	notes
    FROM aotd_inventory_transaction aa
    LEFT JOIN aotd_inventory bb ON bb.inventory_id = aa.inventory_id
    LEFT JOIN aotd_inventory_type cc ON cc.inventory_type_id = bb.inventory_type_id
    LEFT JOIN user dd ON dd.user_id = aa.user_id
    ".$whereSearch." ".$whereUsername." ".$whereCategory." ".$whereItem." ".$orderSearch;
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        if ($bil % 2 == 0) { $bgcolor=""; }
        else { $bgcolor="#cccccc"; }
        $output .= '
            <tr bgcolor="'.$bgcolor.'" nobr="true">
                <td width="5%" align="center">'.$bil++.'</td>
                <td width="14%">'.$row["inventory_type"].'</td>
                <td width="11%">'.$row["item_name"].'</td>
                <td width="8%">'.$row["user_name"].'</td>
                <td width="13%">'.$row["date_transaction"].'</td>
                <td width="10%" align="center">'.$row["stock_purchased"].'</td>
                <td width="5%" align="center">'.$row["total_stock"].'</td>
                <td width="10%" align="center">'.$row["quantity_taken"].'</td>
                <td width="6%" align="center">'.$row["balance"].'</td>
                <td width="18%">'.$row["notes"].'</td>
            </tr> ';
    }  
    return $output;
}

function get_phyRepStats($month1, $year1, $month2, $year2, $sample)  {
    $whereSource = '';
    if ($sample == '') { $whereSource = ''; }
    else { $whereSource = "AND clientType_id = '".$sample."'"; }
    $whereSearch = "WHERE (DATE(phyRep_timeReceived) BETWEEN '".$year1."-".$month1."-01' AND '".$year2."-".$month2."-31') ".$whereSource;
    $bil = 1;
    $output = '';
    $sql = "SELECT phyRep_no, DATE_FORMAT(phyRep_timeReceived, '%D %M %Y') AS timeReceived, phyRep_timeReceived FROM phy_sample_log ".$whereSearch." ORDER BY phyRep_timeReceived";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= '
            <tr nobr="true">
                <td style="border-right: 1px solid black;" width="20%" align="center">'.$bil++.'</td>
                <td style="border-right: 1px solid black;" width="40%">'.$row["phyRep_no"].'</td>
                <td width="40%">'.$row["timeReceived"].'</td>
            </tr> ';
    }  
    return $output;
}

function get_phyTestStats($month1, $day1, $year1, $month2, $day2, $year2, $test, $sample)  {
    $whereSource = '';
    $whereTest = '';
    if ($sample == '') { $whereSource = ''; }
    else { $whereSource = "AND clientType_id = '".$sample."'"; }
    if ($test == '') { $whereTest = ''; }
    else { $whereTest = "bb.phyTest_id = '".$test."' AND"; }
    $whereSearch = "WHERE (DATE(phyRep_timeCompleted) BETWEEN '".$year1."-".$month1."-".$day1."' AND '".$year2."-".$month2."-".$day2."') AND bb.phyTest_name IS NOT NULL  ".$whereSource;
    $bil = 1;
    $output = '';
    $sql = "SELECT 
	bb.phyTest_name AS testName,
	SUM(phy_sample_log.phyRep_totalSample) AS totalTest,
	SUM(phy_sample_log.phyRep_totalSample) * bb.phyTest_cost AS cost
    FROM phy_sample_log
    LEFT JOIN phy_test bb ON ".$whereTest." bb.phyTest_id = phy_sample_log.phyTest_id ".$whereSearch." GROUP BY testName";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql); 
    $sum = 0;
    while($row = mysqli_fetch_assoc($result))  
    {   
        $sum += (float)$row['cost'];
        $output .= '
            <tr nobr="true">
                <td style="border-right: 1px solid black;" align="center" width="10%">'.$bil++.'</td>
                <td style="border-right: 1px solid black;" width="40%">'.$row["testName"].'</td>
                <td style="border-right: 1px solid black;" width="20%" align="center">'.$row["totalTest"].'</td>
                <td align="right" width="30%">'.$row["cost"].'</td>
            </tr>';        
    }
    $total = number_format($sum, 2, '.', '');
    $output .= '
            <tr nobr="true">
                <td align="right" width="100%" colspan="3" border="1"><font size="9"><strong>Total: RM '.$total.'</strong></font></td>
            </tr>';
    return $output;
}

function get_effTestStats($month1, $day1, $year1, $month2, $day2, $year2, $test, $sample)  {
    $whereSource = '';
    $whereTest = '';
    if ($sample == '') { $whereSource = ''; }
    else { $whereSource = "AND clientType_id = '".$sample."'"; }
    if ($test == '') { $whereTest = ''; }
    else { $whereTest = "bb.effCat_id = '".$test."' AND"; }
    $whereSearch = "WHERE (DATE(effRep_timeCompleted) BETWEEN '".$year1."-".$month1."-".$day1."' AND '".$year2."-".$month2."-".$day2."') AND bb.effTest_name IS NOT NULL ".$whereSource;
    $bil = 1;
    $output = '';
    $sql = "SELECT 
	bb.effTest_name AS testName,
	SUM(eff_sample_log.effRep_totalSample) AS totalTest,
	SUM(eff_sample_log.effRep_totalSample) * bb.effTest_cost AS cost
    FROM eff_sample_log    
    LEFT JOIN eff_test bb ON ".$whereTest." bb.effTest_id = eff_sample_log.effTest_id  ".$whereSearch." GROUP BY testName";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql); 
    $sum = 0;
    while($row = mysqli_fetch_assoc($result))  
    {   
        $sum += (float)$row['cost'];
        $output .= '
            <tr nobr="true">
                <td style="border-right: 1px solid black;" align="center" width="10%">'.$bil++.'</td>
                <td style="border-right: 1px solid black;" width="40%">'.$row["testName"].'</td>
                <td style="border-right: 1px solid black;" width="20%" align="center">'.$row["totalTest"].'</td>
                <td align="right" width="30%">'.$row["cost"].'</td>
            </tr>';        
    }
    $total = number_format($sum, 2, '.', '');
    $output .= '
            <tr nobr="true">
                <td align="right" width="100%" colspan="3" border="1"><font size="9"><strong>Total: RM '.$total.'</strong></font></td>
            </tr>';
    return $output;
}

function get_effRepStats($month1, $year1, $month2, $year2, $sample)  {
    $whereSource = '';
    if ($sample == '') { $whereSource = ''; }
    else { $whereSource = "AND clientType_id = '".$sample."'"; }
    $whereSearch = "WHERE (DATE(effRep_timeReceived) BETWEEN '".$year1."-".$month1."-01' AND '".$year2."-".$month2."-31') ".$whereSource;
    $bil = 1;
    $output = '';
    $sql = "SELECT effRep_no, DATE_FORMAT(effRep_timeReceived, '%D %M %Y') AS timeReceived, effRep_timeReceived  FROM eff_sample_log ".$whereSearch." ORDER BY effRep_timeReceived";
    log_debug(__LINE__, $sql, $GLOBALS['log_dir']);
    $result = mysqli_query(get_connect(), $sql);    
    while($row = mysqli_fetch_assoc($result))  
    {   
        $output .= '
            <tr nobr="true">
                <td style="border-right: 1px solid black;" width="20%" align="center">'.$bil++.'</td>
                <td style="border-right: 1px solid black;" width="40%">'.$row["effRep_no"].'</td>
                <td width="40%">'.$row["timeReceived"].'</td>
            </tr> ';
    }  
    return $output;
}
