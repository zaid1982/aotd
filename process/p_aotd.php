<?php

session_start();
require_once '../library/db.php';
require_once '../function/f_task.php';

$config = parse_ini_file('../library/config.ini');
$log_dir = $config['log_dir'];

function log_debug($line, $msg, $log_dir) {
    $debugMsg = date("Y/m/d h:i:sa")." [".__FILE__.":".$line."] - ".$msg."\r\n";
    error_log($debugMsg, 3, $log_dir.'/debug/debug_'.date("Ymd").'.log');
}

$form_data = array(); // Pass back the data to form

try {
    /* Validate the form on the server side - 6835 */
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('(ErrCode:0001) [' . __LINE__ . '] - Session expired. Please logout and login back.', 32);
    } else if (empty($_POST['funct'])) { // Function empty
        throw new Exception('(ErrCode:5000) [' . __LINE__ . '] - Post[funct] empty.');
    } else {
        Class_db::getInstance()->db_connect();        
        Class_db::getInstance()->db_beginTransaction();
        $fn_task = new Class_task();          
        if ($_POST['funct'] == 'save_lab') {       
            if (empty($_POST['mle_lab_id']))       throw new Exception('(ErrCode:6802) [' . __LINE__ . '] - Parameter lab_id empty.');
            if (empty($_POST['mle_lab_name']))     throw new Exception('(ErrCode:6803) [' . __LINE__ . '] - Field Laboratory Name empty.', 32);
            $result = Class_db::getInstance()->db_update('aotd_lab', array('lab_name'=>$_POST['mle_lab_name'], 'lab_desc'=>$_POST['mle_lab_desc'], 'lab_head_unit'=>$_POST['mle_lab_head_unit'], 'lab_quality_manager'=>$_POST['mle_lab_quality_manager'],
                'lab_technical_manager'=>$_POST['mle_lab_technical_manager'], 'lab_technical_manager2'=>$_POST['mle_lab_technical_manager2'], 'lab_research_officer'=>$_POST['mle_lab_research_officer'], 'lab_supervisor'=>$_POST['mle_lab_supervisor']), array('lab_id'=>$_POST['mle_lab_id']));
            $audit_code = Class_db::getInstance()->db_select_col ('aotd_lab', array('lab_id'=>$_POST['mle_lab_id']), 'lab_auditCode', NULL, 1);
            $fn_task->save_audit ($audit_code.'00');
        } else if ($_POST['funct'] == 'save_lab2') {               
            if (empty($_POST['mle2_lab_id']))       throw new Exception('(ErrCode:6802) [' . __LINE__ . '] - Parameter lab_id empty.');
            if (empty($_POST['mle2_lab_name']))     throw new Exception('(ErrCode:6803) [' . __LINE__ . '] - Field Laboratory Name empty.', 32);
            if (empty($_POST['mle2_lab_cost']))     throw new Exception('(ErrCode:6815) [' . __LINE__ . '] - Field Cost empty.', 32);
            if ($_POST['mle2_lab_id'] == 'BDT')
                Class_db::getInstance()->db_update('bdt_test', array('bdtTest_price'=>$_POST['mle2_lab_cost']), array('bdtTest_id'=>'>0'));
            else if ($_POST['mle2_lab_id'] == 'ECT')
                Class_db::getInstance()->db_update('ect_test', array('ectTest_price'=>$_POST['mle2_lab_cost']), array('ectTest_id'=>'>0'));
            $result = Class_db::getInstance()->db_update('aotd_lab', array('lab_name'=>$_POST['mle2_lab_name'], 'lab_desc'=>$_POST['mle2_lab_desc'], 'lab_head_unit'=>$_POST['mle2_lab_head_unit'], 'lab_quality_manager'=>$_POST['mle2_lab_quality_manager'],
                'lab_research_officer'=>$_POST['mle2_lab_research_officer']), array('lab_id'=>$_POST['mle2_lab_id']));
            $audit_code = Class_db::getInstance()->db_select_col ('aotd_lab', array('lab_id'=>$_POST['mle2_lab_id']), 'lab_auditCode', NULL, 1);
            $fn_task->save_audit ($audit_code.'00');
        } else if ($_POST['funct'] == 'create_ats_test') {
            $result = Class_db::getInstance()->db_insert('ats_test', array('atsTest_status'=>'2'));
            $fn_task->save_audit (101, 'Test ID = '.$result);
        } else if ($_POST['funct'] == 'save_ats_test') {
            if (empty($_POST['malt_atsTest_id']))      throw new Exception('(ErrCode:6804) [' . __LINE__ . '] - Parameter atsTest_id empty.');
            if (empty($_POST['malt_atsTest_status']))  throw new Exception('(ErrCode:6805) [' . __LINE__ . '] - Field Status empty.', 32);
            if ($_POST['malt_atsTest_status'] != '1' && $_POST['malt_atsTest_status'] != '41')
                throw new Exception('(ErrCode:6805) [' . __LINE__ . '] - Field Status empty.', 32);    
            $ats_test = Class_db::getInstance()->db_select_single('ats_test', array('atsTest_id'=>$_POST['malt_atsTest_id']), NULL, 1);
            $result = Class_db::getInstance()->db_update('ats_test', array('atsTest_name'=>$_POST['malt_atsTest_name'], 'atsTest_desc'=>$_POST['malt_atsTest_desc'], 'atsTest_cat'=>$_POST['malt_atsTest_cat'], 'atsTest_equipment'=>$_POST['malt_atsTest_equipment'],
                'atsTest_cost'=>$_POST['malt_atsTest_cost'], 'atsTest_status'=>$_POST['malt_atsTest_status']), array('atsTest_id'=>$_POST['malt_atsTest_id']));
            if ($ats_test['atsTest_status'] == '2') {
                $fn_task->save_audit (102, $_POST['malt_atsTest_name']);
            } else {
                $fn_task->save_audit (103, $_POST['malt_atsTest_name']);
                if ($_POST['malt_atsTest_status'] != $ats_test['atsTest_status']) {
                    $fn_task->save_audit(($_POST['malt_atsTest_status']=='1'?104:105), $_POST['malt_atsTest_name']);
                }  
            }
        } else if ($_POST['funct'] == 'add_ats_field') {
            if (empty($_POST['malc_atsTest_id']))       throw new Exception('(ErrCode:6804) [' . __LINE__ . '] - Parameter atsTest_id empty.');
            if (empty($_POST['malc_atsField_name']))    throw new Exception('(ErrCode:6807) [' . __LINE__ . '] - Field atsField_name empty.', 32);
            if (empty($_POST['malc_atsFormula_id']))    throw new Exception('(ErrCode:6808) [' . __LINE__ . '] - Field Formula empty.', 32);
            $atsField_id = Class_db::getInstance()->db_insert('ats_field', array('atsTest_id'=>$_POST['malc_atsTest_id'], 'atsField_name'=>$_POST['malc_atsField_name']));
            foreach ($_POST['malc_atsFormula_id'] as $formula_id) {
                Class_db::getInstance()->db_insert('ats_field_formula', array('atsField_id'=>$atsField_id, 'atsFormula_id'=>$formula_id, 'atsFf_notes'=>$_POST['malc_atsFf_notes_'.$formula_id]));
            }            
            $result = '1';
            $fn_task->save_audit (106, 'Test ID = '.$_POST['malc_atsTest_id'].' - '.$_POST['malc_atsField_name']);
        } else if ($_POST['funct'] == 'save_ats_field') {
            if (empty($_POST['malc_atsTest_id']))       throw new Exception('(ErrCode:6804) [' . __LINE__ . '] - Parameter atsTest_id empty.');
            if (empty($_POST['malc_atsField_id']))      throw new Exception('(ErrCode:6806) [' . __LINE__ . '] - Parameter atsField_id empty.');
            if (empty($_POST['malc_atsField_name']))    throw new Exception('(ErrCode:6807) [' . __LINE__ . '] - Field Component Name empty.', 32);
            if (empty($_POST['malc_atsFormula_id']))    throw new Exception('(ErrCode:6808) [' . __LINE__ . '] - Field Formula empty.', 32);
            $arr_formula = Class_db::getInstance()->db_select_colm ('ats_field_formula', array('atsField_id'=>$_POST['malc_atsField_id']), 'atsFormula_id');
            $arrPost_formula = $_POST['malc_atsFormula_id'];
            if ($arr_formula != $arrPost_formula) {
                $arrDiff_formula1 = array_diff($arrPost_formula, $arr_formula);
                foreach($arrDiff_formula1 as $value) {
                    Class_db::getInstance()->db_insert('ats_field_formula', array('atsField_id'=>$_POST['malc_atsField_id'], 'atsFormula_id'=>$value, 'atsFf_notes'=>$_POST['malc_atsFf_notes_'.$value]));
                }
                $arrDiff_formula2 = array_diff($arr_formula, $arrPost_formula);
                if (count($arrDiff_formula2) > 0) {
                    Class_db::getInstance()->db_delete('ats_field_formula', array('atsField_id'=>$_POST['malc_atsField_id'], 'atsFormula_id'=>'('.  implode(',', $arrDiff_formula2).')'));
                }
            }    
            $result = Class_db::getInstance()->db_update('ats_field', array('atsField_name'=>$_POST['malc_atsField_name']), array('atsField_id'=>$_POST['malc_atsField_id']));
            $atsTest_name = Class_db::getInstance()->db_select_col('ats_test', array('atsTest_id'=>$_POST['malc_atsTest_id']), 'atsTest_name', NULL, 1);
            $fn_task->save_audit (107, 'Test ID = '.$_POST['malc_atsTest_id'].' - '.$_POST['malc_atsField_name']);
        } else if ($_POST['funct'] == 'delete_ats_field') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            $ats_field = Class_db::getInstance()->db_select_single('ats_field', array('atsField_id'=>$arrayParam['atsField_id']), NULL, 1);
            Class_db::getInstance()->db_delete('ats_field_formula', array('atsField_id'=>$arrayParam['atsField_id']));
            $result = Class_db::getInstance()->db_delete('ats_field', array('atsField_id'=>$arrayParam['atsField_id']));
            $fn_task->save_audit (108, 'Test ID = '.$ats_field['atsTest_id'].' - '.$ats_field['atsField_name']);
        } else if ($_POST['funct'] == 'save_ats_cert_info') {
            if (empty($_POST['masl_atsCert_id']))   throw new Exception('(ErrCode:6810) [' . __LINE__ . '] - Parameter atsCert_id empty.');
            $atsCert_equipment = (!empty($_POST['masl_atsCert_equipment'])) ? $_POST['masl_atsCert_equipment'] : '0';
            $atsCert_chemical = (!empty($_POST['masl_atsCert_chemical'])) ? $_POST['masl_atsCert_chemical'] : '0';
            $result = Class_db::getInstance()->db_update('ats_sample_log', array('atsCert_equipment'=>$atsCert_equipment, 'atsCert_chemical'=>$atsCert_chemical, 'atsCert_remark'=>$_POST['masl_atsCert_remark'], 'atsCert_condition'=>$_POST['masl_atsCert_condition']), array('atsCert_id'=>$_POST['masl_atsCert_id']));
            $atsCert_no = Class_db::getInstance()->db_select_col('ats_sample_log', array('atsCert_id'=>$_POST['masl_atsCert_id']), 'atsCert_no', NULL, 1);
            $fn_task->save_audit (110, $atsCert_no);
        } else if ($_POST['funct'] == 'create_ats_cert') {
            if (empty($_POST['masl_client_id']))            throw new Exception('(ErrCode:6809) [' . __LINE__ . '] - Field Customer Name empty.', 32);
            $wfTask_id = $fn_task->task_create($_SESSION['user_id'], '1', '2', '1', $_POST['masl_client_id']);
            $wfTrans_id = Class_db::getInstance()->db_select_col ('wf_task', array('wfTask_id'=>$wfTask_id), 'wfTrans_id', NULL, 1);
            $year = date('y');
            $source = Class_db::getInstance()->db_select_col ('vw_client_info', array('client_id'=>$_POST['masl_client_id']), 'clientType_id', NULL, 1);
            $inx = Class_db::getInstance()->db_select_col ('aotd_seq', array('seq_type'=>'cert', 'lab_id'=>'ATS', 'seq_year'=>$year), 'seq_inx');
            $ac = $_POST['masl_atsCert_accredited'] == '1' ? 'AC' : 'NAC';
            $cert_no = "QEA/ATS/".$source."/".$ac."/".$inx."-".$year;
            Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_regNo'=>$cert_no), array('wfTrans_id'=>$wfTrans_id));
            if ($inx == '') {
                $inx = '1';
                Class_db::getInstance()->db_insert('aotd_seq', array('seq_type'=>'cert', 'lab_id'=>'ATS', 'seq_year'=>$year, 'seq_inx'=>$inx));
            }
            Class_db::getInstance()->db_update('aotd_seq', array('seq_inx'=>intVal($inx)+1), array('seq_type'=>'cert', 'lab_id'=>'ATS', 'seq_year'=>$year));
            $atsCert_accredited = (!empty($_POST['masl_atsCert_accredited'])) ? $_POST['masl_atsCert_accredited'] : '0';
            $atsCert_equipment = (!empty($_POST['masl_atsCert_equipment'])) ? $_POST['masl_atsCert_equipment'] : '0';
            $atsCert_chemical = (!empty($_POST['masl_atsCert_chemical'])) ? $_POST['masl_atsCert_chemical'] : '0';
            $cert_id = Class_db::getInstance()->db_insert('ats_sample_log', array('wfTrans_id'=>$wfTrans_id, 'atsCert_no'=>$cert_no, 'client_id'=>$_POST['masl_client_id'], 'atsCert_totalSample'=>$_POST['masl_atsCert_totalSample'],
                'atsCert_accredited'=>$atsCert_accredited, 'clientType_id'=>$source, 'atsCert_equipment'=>$atsCert_equipment, 'atsCert_chemical'=>$atsCert_chemical, 'atsCert_condition'=>$_POST['masl_atsCert_condition'], 'atsCert_remark'=>$_POST['masl_atsCert_remark']));
            for ($i=1;$i<=intVal($_POST['masl_atsCert_totalSample']);$i++) {
                $barcode_no = $inx.$year.$i.'A';
                Class_db::getInstance()->db_insert('ats_sample_info', array('atsCert_no'=>$cert_no, 'atsCert_id'=>$cert_id, 'atsLab_code'=>$cert_no.'/'.$i, 'atsLab_barCode'=>$barcode_no));
            }
            foreach ($_POST['masl_atsTest_id'] as $atsTest_id) {                
                Class_db::getInstance()->db_insert('ats_cert_test', array('atsCert_no'=>$cert_no, 'atsCert_id'=>$cert_id, 'atsTest_id'=>$atsTest_id));
            }
            $result = array('atsCert_id'=>$cert_id, 'wfTask_id'=>$wfTask_id);
            $fn_task->save_audit (109, $cert_no);
        } else if ($_POST['funct'] == 'save_ats_sample_info') {
            if (empty($_POST['macr_atsCert_id']))   throw new Exception('(ErrCode:6810) [' . __LINE__ . '] - Parameter atsCert_id empty.');
            $arr_sample_info = Class_db::getInstance()->db_select('ats_sample_info', array('atsCert_id'=>$_POST['macr_atsCert_id']), NULL, NULL, 1);
            foreach ($arr_sample_info as $sample_info) {
                Class_db::getInstance()->db_update('ats_sample_info', array('atsLab_sampleCode'=>$_POST['macr_atsLab_sampleCode_'.$sample_info['atsLab_id']]), array('atsLab_id'=>$sample_info['atsLab_id']));
            }
            $result = '1'; 
            $atsCert_no = Class_db::getInstance()->db_select_col('ats_sample_log', array('atsCert_id'=>$_POST['macr_atsCert_id']), 'atsCert_no', NULL, 1);
            $fn_task->save_audit (113, $atsCert_no);
        } else if ($_POST['funct'] == 'get_formula_id') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            if (empty($arrayParam['atsField_id']))  throw new Exception('(ErrCode:6806) [' . __LINE__ . '] - Parameter atsField_id empty.');
            $result = '-';
            $ats_cert_field = Class_db::getInstance()->db_select_single('ats_cert_field', array('atsField_id'=>$arrayParam['atsField_id']));
            if ($ats_cert_field != '') {
                $ats_formula = Class_db::getInstance()->db_select_single('ats_formula', array('atsFormula_id'=>$ats_cert_field['atsFormula_id']), NULL, 1);
                $atsUnits_unit = Class_db::getInstance()->db_select_col('ats_units', array('atsUnits_id'=>$ats_formula['atsFormula_unit']), 'atsUnits_unit', NULL, 1);
                $result = array('atsFormula_id'=>$ats_formula['atsFormula_id'], 'atsFormula_img'=>$ats_formula['atsFormula_img'], 'atsUnits_unit'=>$atsUnits_unit);
            }            
        } else if ($_POST['funct'] == 'set_ats_field_formula') {
            if (empty($_POST['masf_atsCert_id']))       throw new Exception('(ErrCode:6810) [' . __LINE__ . '] - Parameter atsCert_id empty.');
            if (empty($_POST['masf_atsField_id']))      throw new Exception('(ErrCode:6806) [' . __LINE__ . '] - Parameter atsField_id empty.');
            if (empty($_POST['masf_atsFormula_id']))    throw new Exception('(ErrCode:6811) [' . __LINE__ . '] - Field atsField_id empty.', 32);
            $atsCert_no = Class_db::getInstance()->db_select_col ('ats_sample_log', array('atsCert_id'=>$_POST['masf_atsCert_id']), 'atsCert_no', NULL, 1);
            $result = Class_db::getInstance()->db_insert('ats_cert_field', array('atsCert_id'=>$_POST['masf_atsCert_id'], 'atsCert_no'=>$atsCert_no, 'atsField_id'=>$_POST['masf_atsField_id'], 'atsFormula_id'=>$_POST['masf_atsFormula_id']));
            $atsTest_id = Class_db::getInstance()->db_select_col ('ats_field', array('atsField_id'=>$_POST['masf_atsField_id']), 'atsTest_id', NULL, 1);
            $atsTest_name = Class_db::getInstance()->db_select_col ('ats_test', array('atsTest_id'=>$atsTest_id), 'atsTest_name', NULL, 1);
            $atsFormula_name = Class_db::getInstance()->db_select_col ('ats_formula', array('atsFormula_id'=>$_POST['masf_atsFormula_id']), 'atsFormula_name', NULL, 1);
            $fn_task->save_audit (114, $atsCert_no.' - Test: '.$atsTest_name.', Formula: '.$atsFormula_name);
        } else if ($_POST['funct'] == 'set_ats_res') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            if (empty($arrayParam['atsLab_id']))        throw new Exception('(ErrCode:6812) [' . __LINE__ . '] - Parameter atsLab_id empty.');
            if (empty($arrayParam['atsField_id']))      throw new Exception('(ErrCode:6806) [' . __LINE__ . '] - Parameter atsField_id empty.');
            if (empty($arrayParam['atsFormula_id']))    throw new Exception('(ErrCode:6811) [' . __LINE__ . '] - Parameter atsFormula_id empty.');
            $result = Class_db::getInstance()->db_insert('ats_res', array('atsLab_id'=>$arrayParam['atsLab_id'], 'atsLab_code'=>$arrayParam['atsLab_code'], 'atsField_id'=>$arrayParam['atsField_id']));   
            $arr_formula_vars = Class_db::getInstance()->db_select('ats_formula_vars', array('atsFormula_id'=>$arrayParam['atsFormula_id']), NULL, NULL, 1);
            Class_db::getInstance()->db_delete('ats_raw', array('atsLab_id'=>$arrayParam['atsLab_id'], 'atsField_id'=>$arrayParam['atsField_id']));
            foreach ($arr_formula_vars as $formula_vars) {
                Class_db::getInstance()->db_insert('ats_raw', array('atsLab_id'=>$arrayParam['atsLab_id'], 'atsLab_code'=>$arrayParam['atsLab_code'], 'atsField_id'=>$arrayParam['atsField_id'], 'atsVar_id'=>$formula_vars['atsVar_id']));
            }
        } else if ($_POST['funct'] == 'save_ats_result') {
            if (empty($_POST['marw_atsLab_id']))        throw new Exception('(ErrCode:6812) [' . __LINE__ . '] - Parameter atsLab_id empty.');
            if (empty($_POST['marw_atsRes_id']))        throw new Exception('(ErrCode:6813) [' . __LINE__ . '] - Parameter atsRes_id empty.');
            if (empty($_POST['marw_atsField_id']))      throw new Exception('(ErrCode:6806) [' . __LINE__ . '] - Parameter atsField_id empty.');
            if (empty($_POST['marw_atsFormula_id']))    throw new Exception('(ErrCode:6811) [' . __LINE__ . '] - Parameter atsFormula_id empty.');
            for($var=0; $var<10; $var++) {
                if (isset($_POST['marw_atsRaw_value_'.$var]) && !empty($_POST['marw_atsRaw_id_'.$var])) {
                    Class_db::getInstance()->db_update('ats_raw', array('atsRaw_value'=>$_POST['marw_atsRaw_value_'.$var]), array('atsRaw_id'=>$_POST['marw_atsRaw_id_'.$var]));
                }
            }
            $res = '';
            if ($_POST['marw_atsFormula_id'] == '31') {
                $res = $_POST['marw_atsRaw_value_0'];
            } else {
                $ats_formula = Class_db::getInstance()->db_select_single('ats_formula', array('atsFormula_id'=>$_POST['marw_atsFormula_id']), NULL, 1);
                $deca = $ats_formula['atsFormula_deca'];
                $equation = $ats_formula['atsFormula_equation'];
                $str_replace = array();
                $arr_ats_raw = Class_db::getInstance()->db_select('vw_ats_raw', array(), NULL, NULL, 1, array('atsField_id'=>$_POST['marw_atsField_id'], 'atsLab_id'=>$_POST['marw_atsLab_id']));
                foreach ($arr_ats_raw as $ats_raw) {
                    $value = htmlentities(trim($ats_raw['atsRaw_value']));
                    $str_replace[$ats_raw['atsVar_tag']] = $value;
                }
                $str_equ = strtr($equation, $str_replace);
                log_debug(__LINE__, '$str_equ = '.$str_equ, $log_dir);
                @eval("\$res_result = $str_equ;");
                $res_result = sprintf("%.".$deca."f", $res_result);
                log_debug(__LINE__, '$res_result = '.$res_result, $log_dir);
                $res_unit = Class_db::getInstance()->db_select_col ('ats_units', array('atsUnits_id'=>$ats_formula['atsFormula_unit']), 'atsUnits_unit', NULL, 1);
                $res = $res_result.' '.$res_unit;
                log_debug(__LINE__, '$res = '.$res, $log_dir);
            }
            Class_db::getInstance()->db_update('ats_res', array('atsRes_res'=>$res), array('atsRes_id'=>$_POST['marw_atsRes_id']));
            $result = '1';
            $atsTest_id = Class_db::getInstance()->db_select_col ('ats_field', array('atsField_id'=>$_POST['marw_atsField_id']), 'atsTest_id', NULL, 1);
            $atsTest_name = Class_db::getInstance()->db_select_col ('ats_test', array('atsTest_id'=>$atsTest_id), 'atsTest_name', NULL, 1);
            $atsLab_code = Class_db::getInstance()->db_select_col ('ats_sample_info', array('atsLab_id'=>$_POST['marw_atsLab_id']), 'atsLab_code', NULL, 1);
            $fn_task->save_audit (118, $atsLab_code.' - Test: '.$atsTest_name);
        } else if ($_POST['funct'] == 'save_ats_overrid') {
            if (empty($_POST['param']))                     throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            if (empty($arrayParam['atsCertTest_id']))       throw new Exception('(ErrCode:6838) [' . __LINE__ . '] - Parameter atsCertTest_id empty.');
            if (empty($arrayParam['atsCertTest_overrid']))  throw new Exception('(ErrCode:6839) [' . __LINE__ . '] - Field atsCertTest_overrid empty.', 32);
            $result = Class_db::getInstance()->db_update('ats_cert_test', array('atsCertTest_overrid'=>$arrayParam['atsCertTest_overrid']), array('atsCertTest_id'=>$arrayParam['atsCertTest_id']));
            $atsCert_test = Class_db::getInstance()->db_select_single ('ats_cert_test', array('atsCertTest_id'=>$arrayParam['atsCertTest_id']), NULL, 1);
            $atsTest_name = Class_db::getInstance()->db_select_col ('ats_test', array('atsTest_id'=>$atsCert_test['atsTest_id']), 'atsTest_name', NULL, 1);
            $fn_task->save_audit (119, $atsCert_test['atsCert_no'].' - Test: '.$atsTest_name);
        } else if ($_POST['funct'] == 'save_ats_action') {
            if (empty($_POST['macr_wfTask_id']))        throw new Exception('(ErrCode:6814) [' . __LINE__ . '] - Parameter wfTask_id empty.');
            $wfTask_statusSave = (!empty($_POST['macr_action'])) ? $_POST['macr_action'] : '';
            $result = Class_db::getInstance()->db_update('wf_task', array('wfTask_statusSave'=>$wfTask_statusSave, 'wfTask_remark'=>$_POST['macr_wfTask_remark']), array('wfTask_id'=>$_POST['macr_wfTask_id']));
            $atsCert_no = Class_db::getInstance()->db_select_col('ats_sample_log', array('atsCert_id'=>$_POST['macr_atsCert_id']), 'atsCert_no', NULL, 1);
            $fn_task->save_audit (122, $atsCert_no);
        } else if ($_POST['funct'] == 'add_eff_cat') {
            if (empty($_POST['mfc_effCat_name']))       throw new Exception('(ErrCode:6816) [' . __LINE__ . '] - Field Evaluation Group Name empty.', 32);
            if (empty($_POST['mfc_effCat_filter']))     throw new Exception('(ErrCode:6817) [' . __LINE__ . '] - Field Filtered Name empty.', 32);
            if (Class_db::getInstance()->db_count('eff_cat', array('effCat_name'=>$_POST['mfc_effCat_name'])) > 0) 
                throw new Exception('(ErrCode:6818) [' . __LINE__ . '] - Evaluation Group Name already exist.', 32);
            $result = Class_db::getInstance()->db_insert('eff_cat', array('effCat_name'=>$_POST['mfc_effCat_name'], 'effCat_filter'=>$_POST['mfc_effCat_filter']));   
            $fn_task->save_audit (314, $_POST['mfc_effCat_name']);
        } else if ($_POST['funct'] == 'create_eff_test') { 
            $result = Class_db::getInstance()->db_insert('eff_test', array('effTest_status'=>'2'));
            $fn_task->save_audit (301, 'Test ID = '.$result);
        } else if ($_POST['funct'] == 'save_eff_test') {
            if (empty($_POST['mflt_effTest_id']))       throw new Exception('(ErrCode:6818) [' . __LINE__ . '] - Parameter effTest_id empty.');
            if (empty($_POST['mflt_effTest_name']))     throw new Exception('(ErrCode:6819) [' . __LINE__ . '] - Field Test Name empty.', 32);
            if (empty($_POST['mflt_effTest_status']))   throw new Exception('(ErrCode:6820) [' . __LINE__ . '] - Field Status empty.', 32);
            if ($_POST['mflt_effTest_status'] != '1' && $_POST['mflt_effTest_status'] != '41')
                throw new Exception('(ErrCode:6820) [' . __LINE__ . '] - Field Status empty.', 32);
            if (Class_db::getInstance()->db_count('eff_test', array('effTest_name'=>$_POST['mflt_effTest_name'], 'effTest_id'=>'<>'.$_POST['mflt_effTest_id'])) > 0) 
                throw new Exception('(ErrCode:6821) [' . __LINE__ . '] - Test Name already exist.', 32);
            $eff_test = Class_db::getInstance()->db_select_single('eff_test', array('effTest_id'=>$_POST['mflt_effTest_id']), NULL, 1);
            $result = Class_db::getInstance()->db_update('eff_test', array('effTest_name'=>$_POST['mflt_effTest_name'], 'effTest_desc'=>$_POST['mflt_effTest_desc'], 'effCat_id'=>$_POST['mflt_effCat_id'], 
                'effTest_cost'=>$_POST['mflt_effTest_cost'], 'effTest_status'=>$_POST['mflt_effTest_status']), array('effTest_id'=>$_POST['mflt_effTest_id']));
            if ($eff_test['effTest_status'] == '2') {
                $fn_task->save_audit (302, $_POST['mflt_effTest_name']);
            } else {
                $fn_task->save_audit (303, $_POST['mflt_effTest_name']);
                if ($_POST['mflt_effTest_status'] != $eff_test['effTest_status']) {
                    $fn_task->save_audit(($_POST['mflt_effTest_status']=='1'?304:305), $_POST['mflt_effTest_name']);
                }  
            }        
        } else if ($_POST['funct'] == 'add_eff_field') {
            if (empty($_POST['mflf_effTest_id']))       throw new Exception('(ErrCode:6818) [' . __LINE__ . '] - Parameter effTest_id empty.');
            if (empty($_POST['mflf_effField_name']))    throw new Exception('(ErrCode:6822) [' . __LINE__ . '] - Field Field Name empty.', 32);
            if (Class_db::getInstance()->db_count('eff_field', array('effField_name'=>$_POST['mflf_effField_name'], 'effTest_id'=>$_POST['mflf_effTest_id'])) > 0) 
                throw new Exception('(ErrCode:6824) [' . __LINE__ . '] - Field Test Name already exist.', 32);
            $result = Class_db::getInstance()->db_insert('eff_field', array('effTest_id'=>$_POST['mflf_effTest_id'], 'effField_name'=>$_POST['mflf_effField_name'], 'effField_status'=>$_POST['mflf_effTest_status']));
            $fn_task->save_audit (306, 'Test ID = '.$_POST['mflf_effTest_id'].' - '.$_POST['mflf_effField_name']);
        } else if ($_POST['funct'] == 'save_eff_field') {
            if (empty($_POST['mflf_effTest_id']))       throw new Exception('(ErrCode:6818) [' . __LINE__ . '] - Parameter effTest_id empty.');
            if (empty($_POST['mflf_effField_id']))      throw new Exception('(ErrCode:6823) [' . __LINE__ . '] - Parameter effField_id empty.');
            if (empty($_POST['mflf_effField_name']))    throw new Exception('(ErrCode:6822) [' . __LINE__ . '] - Field Field Name empty.', 32);
            if (Class_db::getInstance()->db_count('eff_field', array('effField_name'=>$_POST['mflf_effField_name'], 'effTest_id'=>$_POST['mflf_effTest_id'], 'effField_id'=>'<>'.$_POST['mflf_effField_id'])) > 0) 
                throw new Exception('(ErrCode:6825) [' . __LINE__ . '] - Field Field Name already exist.', 32);
            $result = Class_db::getInstance()->db_update('eff_field', array('effField_name'=>$_POST['mflf_effField_name'], 'effField_status'=>$_POST['mflf_effTest_status']), array('effField_id'=>$_POST['mflf_effField_id']));
            $fn_task->save_audit (307, 'Test ID = '.$_POST['mflf_effTest_id'].' - '.$_POST['mflf_effField_name']);
        } else if ($_POST['funct'] == 'delete_eff_field') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            $eff_field = Class_db::getInstance()->db_select_single('eff_field', array('effField_id'=>$arrayParam['effField_id']), NULL, 1);
            $result = Class_db::getInstance()->db_delete('eff_field', array('effsField_id'=>$arrayParam['effField_id']));
            $fn_task->save_audit (308, 'Test ID = '.$eff_field['effTest_id'].' - '.$eff_field['effField_name']);
        } else if ($_POST['funct'] == 'create_phy_test') { 
            $result = Class_db::getInstance()->db_insert('phy_test', array('phyTest_status'=>'2'));
            $fn_task->save_audit (201, 'Test ID = '.$result);
        } else if ($_POST['funct'] == 'save_phy_test') {
            if (empty($_POST['mplt_phyTest_id']))       throw new Exception('(ErrCode:6824) [' . __LINE__ . '] - Parameter phyTest_id empty.');
            if (empty($_POST['mplt_phyTest_name']))     throw new Exception('(ErrCode:6825) [' . __LINE__ . '] - Field Test Name empty.', 32);
            if (empty($_POST['mplt_phyTest_status']))   throw new Exception('(ErrCode:6826) [' . __LINE__ . '] - Field Status empty.', 32);
            if ($_POST['mplt_phyTest_status'] != '1' && $_POST['mplt_phyTest_status'] != '41')
                throw new Exception('(ErrCode:6830) [' . __LINE__ . '] - Field Status empty.', 32);
            if (Class_db::getInstance()->db_count('phy_test', array('phyTest_name'=>$_POST['mplt_phyTest_name'], 'phyTest_id'=>'<>'.$_POST['mplt_phyTest_id'])) > 0) 
                throw new Exception('(ErrCode:6829) [' . __LINE__ . '] - Test Name already exist.', 32);
            $phy_test = Class_db::getInstance()->db_select_single('phy_test', array('phyTest_id'=>$_POST['mplt_phyTest_id']), NULL, 1);
            $result = Class_db::getInstance()->db_update('phy_test', array('phyTest_name'=>$_POST['mplt_phyTest_name'], 'phyTest_parameters'=>$_POST['mplt_phyTest_parameters'], 'phyTest_cat'=>$_POST['mplt_phyTest_cat'], 'phyTest_equipment'=>$_POST['mplt_phyTest_equipment'], 
                'phyTest_cost'=>$_POST['mplt_phyTest_cost'], 'phyTest_status'=>$_POST['mplt_phyTest_status']), array('phyTest_id'=>$_POST['mplt_phyTest_id']));
            if ($phy_test['phyTest_status'] == '2') {
                $fn_task->save_audit (202, $_POST['mplt_phyTest_name']);
            } else {
                $fn_task->save_audit (203, $_POST['mplt_phyTest_name']);
                if ($_POST['mplt_phyTest_status'] != $phy_test['phyTest_status']) {
                    $fn_task->save_audit(($_POST['mplt_phyTest_status']=='1'?204:205), $_POST['mplt_phyTest_name']);
                }  
            }
        } else if ($_POST['funct'] == 'add_phy_field') {
            if (empty($_POST['mplf_phyTest_id']))       throw new Exception('(ErrCode:6824) [' . __LINE__ . '] - Parameter phyTest_id empty.');
            if (empty($_POST['mplf_phyField_name']))    throw new Exception('(ErrCode:6827) [' . __LINE__ . '] - Field Field Name empty.', 32);
            if (Class_db::getInstance()->db_count('phy_field', array('phyField_name'=>$_POST['mplf_phyField_name'], 'phyTest_id'=>$_POST['mplf_phyTest_id'])) > 0) 
                throw new Exception('(ErrCode:6831) [' . __LINE__ . '] - Field Test Name already exist.', 32);
            $result = Class_db::getInstance()->db_insert('phy_field', array('phyTest_id'=>$_POST['mplf_phyTest_id'], 'phyField_name'=>$_POST['mplf_phyField_name'], 'phyField_status'=>$_POST['mplf_phyTest_status']));
            $fn_task->save_audit (206, 'Test ID = '.$_POST['mplf_phyTest_id'].' - '.$_POST['mplf_phyField_name']);
        } else if ($_POST['funct'] == 'save_phy_field') {
            if (empty($_POST['mplf_phyTest_id']))       throw new Exception('(ErrCode:6824) [' . __LINE__ . '] - Parameter phyTest_id empty.');
            if (empty($_POST['mplf_phyField_id']))      throw new Exception('(ErrCode:6828) [' . __LINE__ . '] - Parameter phyField_id empty.');
            if (empty($_POST['mplf_phyField_name']))    throw new Exception('(ErrCode:6827) [' . __LINE__ . '] - Field Field Name empty.', 32);
            if (Class_db::getInstance()->db_count('phy_field', array('phyField_name'=>$_POST['mplf_phyField_name'], 'phyTest_id'=>$_POST['mplf_phyTest_id'], 'phyField_id'=>'<>'.$_POST['mplf_phyField_id'])) > 0) 
                throw new Exception('(ErrCode:6832) [' . __LINE__ . '] - Field Field Name already exist.', 32);
            $result = Class_db::getInstance()->db_update('phy_field', array('phyField_name'=>$_POST['mplf_phyField_name'], 'phyField_status'=>$_POST['mplf_phyTest_status']), array('phyField_id'=>$_POST['mplf_phyField_id']));
            $fn_task->save_audit (207, 'Test ID = '.$_POST['mplf_phyTest_id'].' - '.$_POST['mplf_phyField_name']);
        } else if ($_POST['funct'] == 'delete_phy_field') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            $phy_field = Class_db::getInstance()->db_select_single('phy_field', array('phyField_id'=>$arrayParam['phyField_id']), NULL, 1);
            $result = Class_db::getInstance()->db_delete('phy_field', array('phyField_id'=>$arrayParam['phyField_id']));
            $fn_task->save_audit (208, 'Test ID = '.$phy_field['phyTest_id'].' - '.$phy_field['phyField_name']);
        } else if ($_POST['funct'] == 'create_bdt_cert') {
            if (empty($_POST['mbsl_client_id']))            throw new Exception('(ErrCode:6809) [' . __LINE__ . '] - Field Customer Name empty.', 32);
            $wfTask_id = $fn_task->task_create($_SESSION['user_id'], '2', '3', '11', $_POST['mbsl_client_id']);
            $wfTrans_id = Class_db::getInstance()->db_select_col ('wf_task', array('wfTask_id'=>$wfTask_id), 'wfTrans_id', NULL, 1);
            $year = date('y');
            $source = Class_db::getInstance()->db_select_col ('vw_client_info', array('client_id'=>$_POST['mbsl_client_id']), 'clientType_id', NULL, 1);
            $inx = Class_db::getInstance()->db_select_col ('aotd_seq', array('lab_id'=>'BDT', 'seq_year'=>$year, 'seq_type'=>'rep'), 'seq_inx');
            if ($inx == '') {
                $inx = '1';
                Class_db::getInstance()->db_insert('aotd_seq', array('seq_type'=>'rep', 'lab_id'=>'BDT', 'seq_year'=>$year, 'seq_inx'=>$inx));
            }
            $cert_no = "OPS/BDT/".$source."/NAC/".$inx."-".$year;
            Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_regNo'=>$cert_no), array('wfTrans_id'=>$wfTrans_id));
            Class_db::getInstance()->db_update('aotd_seq', array('seq_inx'=>intVal($inx)+1), array('seq_type'=>'rep', 'lab_id'=>'BDT', 'seq_year'=>$year));
            $bdtRep_msds = (!empty($_POST['mbsl_bdtRep_msds'])) ? $_POST['mbsl_bdtRep_msds'] : '0';
            Class_db::getInstance()->db_insert('bdt_sample_log', array('wfTrans_id'=>$wfTrans_id, 'bdtRep_no'=>$cert_no, 'client_id'=>$_POST['mbsl_client_id'], 'bdtRep_sampleDesc'=>$_POST['mbsl_bdtRep_sampleDesc'], 'bdtRep_totalSample'=>$_POST['mbsl_bdtRep_totalSample'],
                'clientType_id'=>$source, 'bdtRep_substance'=>$_POST['mbsl_bdtRep_substance'], 'bdtRep_formula'=>$_POST['mbsl_bdtRep_formula'], 'bdtRep_component'=>$_POST['mbsl_bdtRep_component'], 'bdtRep_physical'=>$_POST['mbsl_bdtRep_physical'], 
                'bdtRep_solubility'=>$_POST['mbsl_bdtRep_solubility'], 'bdtRep_condition'=>$_POST['mbsl_bdtRep_condition'], 'bdtRep_msds'=>$bdtRep_msds, 'bdtRep_remark'=>$_POST['mbsl_bdtRep_remark']));
            for ($i=1;$i<=intVal($_POST['mbsl_bdtRep_totalSample']);$i++) {
                $barcode_no = $inx.$year.$i.'B';
                Class_db::getInstance()->db_insert('bdt_sample_info', array('bdtRep_no'=>$cert_no, 'bdtLab_code'=>$cert_no.'/'.$i, 'bdtLab_barCode'=>$barcode_no));
            }
            $result = array('bdtRep_no'=>$cert_no, 'wfTask_id'=>$wfTask_id);     
            $fn_task->save_audit (409, $cert_no);
        } else if ($_POST['funct'] == 'save_bdt_cert_info') {
            if (empty($_POST['mbsl_bdtRep_no']))    throw new Exception('(ErrCode:6833) [' . __LINE__ . '] - Parameter bdtRep_no empty.');
            $bdtRep_msds = (!empty($_POST['mbsl_bdtRep_msds'])) ? $_POST['mbsl_bdtRep_msds'] : '0';
            $result = Class_db::getInstance()->db_update('bdt_sample_log', array('bdtRep_sampleDesc'=>$_POST['mbsl_bdtRep_sampleDesc'], 'bdtRep_substance'=>$_POST['mbsl_bdtRep_substance'], 'bdtRep_formula'=>$_POST['mbsl_bdtRep_formula'],
                'bdtRep_component'=>$_POST['mbsl_bdtRep_component'], 'bdtRep_physical'=>$_POST['mbsl_bdtRep_physical'], 'bdtRep_solubility'=>$_POST['mbsl_bdtRep_solubility'], 'bdtRep_condition'=>$_POST['mbsl_bdtRep_condition'], 'bdtRep_msds'=>$bdtRep_msds, 'bdtRep_remark'=>$_POST['mbsl_bdtRep_remark']), 
                array('bdtRep_no'=>$_POST['mbsl_bdtRep_no']));
            $fn_task->save_audit (410, $_POST['mbsl_bdtRep_no']);
        } else if ($_POST['funct'] == 'save_bdt_sample_info') {
            if (empty($_POST['mbcr_bdtRep_no']))    throw new Exception('(ErrCode:6833) [' . __LINE__ . '] - Parameter bdtRep_no empty.');
            $arr_sample_info = Class_db::getInstance()->db_select('bdt_sample_info', array('bdtRep_no'=>$_POST['mbcr_bdtRep_no']), NULL, NULL, 1);
            foreach ($arr_sample_info as $sample_info) {
                Class_db::getInstance()->db_update('bdt_sample_info', array('bdtLab_sampleCode'=>$_POST['mbcr_bdtLab_sampleCode_'.$sample_info['bdtLab_code']], 'bdtLab_thod'=>$_POST['mbcr_bdtLab_thod_'.$sample_info['bdtLab_code']], 'bdtLab_result'=>$_POST['mbcr_bdtLab_result_'.$sample_info['bdtLab_code']]), 
                    array('bdtLab_code'=>$sample_info['bdtLab_code']));
            }
            $wfTask_statusSave = (!empty($_POST['mbcr_action'])) ? $_POST['mbcr_action'] : '';
            Class_db::getInstance()->db_update('wf_task', array('wfTask_statusSave'=>$wfTask_statusSave, 'wfTask_remark'=>$_POST['mbcr_wfTask_remark']), array('wfTask_id'=>$_POST['mbcr_wfTask_id']));
            $result = Class_db::getInstance()->db_update('bdt_sample_log', array('bdtRep_conclusion'=>$_POST['mbcr_wfTask_remark']), array('bdtRep_no'=>$_POST['mbcr_bdtRep_no']));
            $fn_task->save_audit (413, $_POST['mbcr_bdtRep_no']);  
        } else if ($_POST['funct'] == 'create_ect_cert') {
            if (empty($_POST['mcsl_client_id']))            throw new Exception('(ErrCode:6809) [' . __LINE__ . '] - Field Customer Name empty.', 32);
            $wfTask_id = $fn_task->task_create($_SESSION['user_id'], '3', '4', '21', $_POST['mcsl_client_id']);
            $wfTrans_id = Class_db::getInstance()->db_select_col ('wf_task', array('wfTask_id'=>$wfTask_id), 'wfTrans_id', NULL, 1);
            $year = date('y');
            $source = Class_db::getInstance()->db_select_col ('vw_client_info', array('client_id'=>$_POST['mcsl_client_id']), 'clientType_id', NULL, 1);
            $inx = Class_db::getInstance()->db_select_col ('aotd_seq', array('lab_id'=>'ECT', 'seq_year'=>$year, 'seq_type'=>'rep'), 'seq_inx');
            if ($inx == '') {
                $inx = '1';
                Class_db::getInstance()->db_insert('aotd_seq', array('seq_type'=>'rep', 'lab_id'=>'ECT', 'seq_year'=>$year, 'seq_inx'=>$inx));
            }
            $cert_no = "OPS/ECT/".$source."/NAC/".$inx."-".$year;
            Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_regNo'=>$cert_no), array('wfTrans_id'=>$wfTrans_id));
            Class_db::getInstance()->db_update('aotd_seq', array('seq_inx'=>intVal($inx)+1), array('seq_type'=>'rep', 'lab_id'=>'ECT', 'seq_year'=>$year));
            $ectRep_msds = (!empty($_POST['mcsl_ectRep_msds'])) ? $_POST['mcsl_ectRep_msds'] : '0';
            Class_db::getInstance()->db_insert('ect_sample_log', array('wfTrans_id'=>$wfTrans_id, 'ectRep_no'=>$cert_no, 'client_id'=>$_POST['mcsl_client_id'], 'ectRep_sampleDesc'=>$_POST['mcsl_ectRep_sampleDesc'], 'ectRep_totalSample'=>$_POST['mcsl_ectRep_totalSample'],
                'clientType_id'=>$source, 'ectRep_substance'=>$_POST['mcsl_ectRep_substance'], 'ectRep_formula'=>$_POST['mcsl_ectRep_formula'], 'ectRep_component'=>$_POST['mcsl_ectRep_component'], 'ectRep_physical'=>$_POST['mcsl_ectRep_physical'], 
                'ectRep_solubility'=>$_POST['mcsl_ectRep_solubility'], 'ectRep_condition'=>$_POST['mcsl_ectRep_condition'], 'ectRep_msds'=>$ectRep_msds, 'ectRep_remark'=>$_POST['mcsl_ectRep_remark']));
            for ($i=1;$i<=intVal($_POST['mcsl_ectRep_totalSample']);$i++) {
                $barcode_no = $inx.$year.$i.'C';
                Class_db::getInstance()->db_insert('ect_sample_info', array('ectRep_no'=>$cert_no, 'ectLab_code'=>$cert_no.'/'.$i, 'ectLab_barCode'=>$barcode_no));
            }
            $result = array('ectRep_no'=>$cert_no, 'wfTask_id'=>$wfTask_id);      
            $fn_task->save_audit (509, $cert_no);  
        } else if ($_POST['funct'] == 'save_ect_cert_info') {
            if (empty($_POST['mcsl_ectRep_no']))    throw new Exception('(ErrCode:6834) [' . __LINE__ . '] - Parameter ectRep_no empty.');
            $ectRep_msds = (!empty($_POST['mcsl_ectRep_msds'])) ? $_POST['mcsl_ectRep_msds'] : '0';
            $result = Class_db::getInstance()->db_update('ect_sample_log', array('ectRep_sampleDesc'=>$_POST['mcsl_ectRep_sampleDesc'], 'ectRep_substance'=>$_POST['mcsl_ectRep_substance'], 'ectRep_formula'=>$_POST['mcsl_ectRep_formula'],
                'ectRep_component'=>$_POST['mcsl_ectRep_component'], 'ectRep_physical'=>$_POST['mcsl_ectRep_physical'], 'ectRep_solubility'=>$_POST['mcsl_ectRep_solubility'], 'ectRep_condition'=>$_POST['mcsl_ectRep_condition'], 'ectRep_msds'=>$ectRep_msds, 'ectRep_remark'=>$_POST['mcsl_ectRep_remark']), 
                array('ectRep_no'=>$_POST['mcsl_ectRep_no']));
            $fn_task->save_audit (510, $_POST['mcsl_ectRep_no']);
        } else if ($_POST['funct'] == 'save_ect_sample_info') {
            if (empty($_POST['mccr_ectRep_no']))    throw new Exception('(ErrCode:6834) [' . __LINE__ . '] - Parameter ectRep_no empty.');
            $arr_sample_info = Class_db::getInstance()->db_select('ect_sample_info', array('ectRep_no'=>$_POST['mccr_ectRep_no']), NULL, NULL, 1);
            foreach ($arr_sample_info as $sample_info) {
                Class_db::getInstance()->db_update('ect_sample_info', array('ectLab_sampleCode'=>$_POST['mccr_ectLab_sampleCode_'.$sample_info['ectLab_code']], 'ectLab_results'=>$_POST['mccr_ectLab_results_'.$sample_info['ectLab_code']]), array('ectLab_code'=>$sample_info['ectLab_code']));
            }
            $wfTask_statusSave = (!empty($_POST['mccr_action'])) ? $_POST['mccr_action'] : '';
            Class_db::getInstance()->db_update('wf_task', array('wfTask_statusSave'=>$wfTask_statusSave, 'wfTask_remark'=>$_POST['mccr_wfTask_remark']), array('wfTask_id'=>$_POST['mccr_wfTask_id']));
            $result = Class_db::getInstance()->db_update('ect_sample_log', array('ectRep_conclusion'=>$_POST['mccr_wfTask_remark']), array('ectRep_no'=>$_POST['mccr_ectRep_no']));
            $fn_task->save_audit (513, $_POST['mccr_ectRep_no']);  
        } else if ($_POST['funct'] == 'create_phy_cert') {
            if (empty($_POST['mpsl_client_id']))            throw new Exception('(ErrCode:6809) [' . __LINE__ . '] - Field Customer Name empty.', 32);
            if (empty($_POST['mpsl_phyTest_id']))           throw new Exception('(ErrCode:6824) [' . __LINE__ . '] - Field Test Method empty.', 32);
            $wfTask_id = $fn_task->task_create($_SESSION['user_id'], '4', '5', '31', $_POST['mpsl_client_id']);
            $wfTrans_id = Class_db::getInstance()->db_select_col ('wf_task', array('wfTask_id'=>$wfTask_id), 'wfTrans_id', NULL, 1);
            $year = date('y');
            $source = Class_db::getInstance()->db_select_col ('vw_client_info', array('client_id'=>$_POST['mpsl_client_id']), 'clientType_id', NULL, 1);
            $inx = Class_db::getInstance()->db_select_col ('aotd_seq', array('lab_id'=>'PHY', 'seq_year'=>$year, 'seq_type'=>'rep'), 'seq_inx');
            if ($inx == '') {
                $inx = '1';
                Class_db::getInstance()->db_insert('aotd_seq', array('seq_type'=>'rep', 'lab_id'=>'PHY', 'seq_year'=>$year, 'seq_inx'=>$inx));
            }
            $cert_no = "OPS/PHY/".$source."/NAC/".$inx."-".$year;
            Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_regNo'=>$cert_no), array('wfTrans_id'=>$wfTrans_id));
            Class_db::getInstance()->db_update('aotd_seq', array('seq_inx'=>intVal($inx)+1), array('seq_type'=>'rep', 'lab_id'=>'PHY', 'seq_year'=>$year));
            Class_db::getInstance()->db_insert('phy_sample_log', array('wfTrans_id'=>$wfTrans_id, 'phyRep_no'=>$cert_no, 'client_id'=>$_POST['mpsl_client_id'], 'phyRep_totalSample'=>$_POST['mpsl_phyRep_totalSample'], 'phyTest_id'=>$_POST['mpsl_phyTest_id'],
                'clientType_id'=>$source, 'phyRep_physical'=>$_POST['mpsl_phyRep_physical'], 'phyRep_quantity'=>$_POST['mpsl_phyRep_quantity'], 'phyRep_color'=>$_POST['mpsl_phyRep_color'], 'phyRep_other'=>$_POST['mpsl_phyRep_other']));
            for ($i=1;$i<=intVal($_POST['mpsl_phyRep_totalSample']);$i++) {
                $barcode_no = $inx.$year.$i.'P';
                Class_db::getInstance()->db_insert('phy_sample_info', array('phyRep_no'=>$cert_no, 'phyLab_code'=>$cert_no.'/'.$i, 'phyLab_barCode'=>$barcode_no));
            }
            $result = array('phyRep_no'=>$cert_no, 'wfTask_id'=>$wfTask_id); 
            $fn_task->save_audit (209, $cert_no);
        } else if ($_POST['funct'] == 'save_phy_cert_info') {
            if (empty($_POST['mfsl_phyRep_no']))    throw new Exception('(ErrCode:6834) [' . __LINE__ . '] - Parameter phyRep_no empty.');
            $phyRep_msds = (!empty($_POST['mfsl_phyRep_msds'])) ? $_POST['mfsl_phyRep_msds'] : '0';
            $result = Class_db::getInstance()->db_update('phy_sample_log', array('phyRep_physical'=>$_POST['mfsl_phyRep_physical'], 'phyRep_quantity'=>$_POST['mfsl_phyRep_quantity'], 
                'phyRep_color'=>$_POST['mfsl_phyRep_color'], 'phyRep_other'=>$_POST['mfsl_phyRep_other']), array('phyRep_no'=>$_POST['mfsl_phyRep_no']));
            $fn_task->save_audit (210, $_POST['mfsl_phyRep_no']);
        } else if ($_POST['funct'] == 'save_phy_sample_info') {
            if (empty($_POST['mpcr_phyRep_no']))    throw new Exception('(ErrCode:6834) [' . __LINE__ . '] - Parameter phyRep_no empty.');
            $arr_sample_info = Class_db::getInstance()->db_select('phy_sample_info', array('phyRep_no'=>$_POST['mpcr_phyRep_no']), NULL, NULL, 1);
            foreach ($arr_sample_info as $sample_info) {
                Class_db::getInstance()->db_update('phy_sample_info', array('phyLab_sampleCode'=>$_POST['mpcr_phyLab_sampleCode_'.$sample_info['phyLab_code']], 'phyLab_sampleDesc'=>$_POST['mpcr_phyLab_sampleDesc_'.$sample_info['phyLab_code']],
                    'phyLab_testCondition'=>$_POST['mpcr_phyLab_testCondition_'.$sample_info['phyLab_code']]), array('phyLab_code'=>$sample_info['phyLab_code']));
            }
            $result = '1';  
            $fn_task->save_audit (213, $_POST['mpcr_phyRep_no']);
        } else if ($_POST['funct'] == 'save_phy_workbook') {
            if (empty($_POST['mpcr_phyLab_code']))    throw new Exception('(ErrCode:6836) [' . __LINE__ . '] - Parameter phyLab_code empty.');
            $arr_phy_test_res = Class_db::getInstance()->db_select('phy_test_res', array('phyLab_code'=>$_POST['mpcr_phyLab_code'], 'phyRes_cycle'=>$_POST['mpcr_phyRep_cycle']), NULL, NULL, 1);
            foreach ($arr_phy_test_res as $phy_test_res) {
                if (isset($_POST['mpcr_phyRes_res_'.$phy_test_res['phyRes_id']])) {
                    Class_db::getInstance()->db_update('phy_test_res', array('phyRes_res'=>$_POST['mpcr_phyRes_res_'.$phy_test_res['phyRes_id']]), array('phyRes_id'=>$phy_test_res['phyRes_id']));
                }                
            }
            $result = '1'; 
            $fn_task->save_audit (218, $_POST['mpcr_phyLab_code']);
        } else if ($_POST['funct'] == 'validate_phy_workbook') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            if (empty($arrayParam['phyRep_no']))    throw new Exception('(ErrCode:6834) [' . __LINE__ . '] - Parameter phyRep_no empty.');
            $result = '1';
            $arr_sample_info = Class_db::getInstance()->db_select('phy_sample_info', array('phyRep_no'=>$arrayParam['phyRep_no']), 'phyLab_code', NULL, 1);
            foreach ($arr_sample_info as $sample_info) {
                if (Class_db::getInstance()->db_count('phy_test_res', array('phyLab_code'=>$sample_info['phyLab_code'], 'phyRes_res'=>'is NULL', 'phyRes_cycle'=>$arrayParam['phyRes_cycle'])) > 0) {
                    $result = $sample_info['phyLab_code'];
                    break;
                }
            }
        } else if ($_POST['funct'] == 'save_phy_action') {
            if (empty($_POST['mpcr_wfTask_id']))        throw new Exception('(ErrCode:6814) [' . __LINE__ . '] - Parameter wfTask_id empty.');
            $wfTask_statusSave = (!empty($_POST['mpcr_action'])) ? $_POST['mpcr_action'] : '';
            $result = Class_db::getInstance()->db_update('wf_task', array('wfTask_statusSave'=>$wfTask_statusSave, 'wfTask_remark'=>$_POST['mpcr_wfTask_remark']), array('wfTask_id'=>$_POST['mpcr_wfTask_id']));
            $fn_task->save_audit (222, $_POST['mpcr_phyRep_no']);            
        } else if ($_POST['funct'] == 'create_eff_cert') {
            if (empty($_POST['mfsl_client_id']))            throw new Exception('(ErrCode:6809) [' . __LINE__ . '] - Field Customer Name empty.', 32);
            if (empty($_POST['mfsl_effTest_id']))           throw new Exception('(ErrCode:6824) [' . __LINE__ . '] - Field Test Method empty.', 32);
            $wfTask_id = $fn_task->task_create($_SESSION['user_id'], '5', '6', '41', $_POST['mfsl_client_id']);
            $wfTrans_id = Class_db::getInstance()->db_select_col ('wf_task', array('wfTask_id'=>$wfTask_id), 'wfTrans_id', NULL, 1);
            $year = date('y');
            $source = Class_db::getInstance()->db_select_col ('vw_client_info', array('client_id'=>$_POST['mfsl_client_id']), 'clientType_id', NULL, 1);
            $inx = Class_db::getInstance()->db_select_col ('aotd_seq', array('lab_id'=>'EFF', 'seq_year'=>$year, 'seq_type'=>'rep'), 'seq_inx');
            if ($inx == '') {
                $inx = '1';
                Class_db::getInstance()->db_insert('aotd_seq', array('seq_type'=>'rep', 'lab_id'=>'EFF', 'seq_year'=>$year, 'seq_inx'=>$inx));
            }
            $cert_no = "OPS/EFF/".$source."/NAC/".$inx."-".$year;
            Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_regNo'=>$cert_no), array('wfTrans_id'=>$wfTrans_id));
            Class_db::getInstance()->db_update('aotd_seq', array('seq_inx'=>intVal($inx)+1), array('seq_type'=>'rep', 'lab_id'=>'EFF', 'seq_year'=>$year));
            Class_db::getInstance()->db_insert('eff_sample_log', array('wfTrans_id'=>$wfTrans_id, 'effRep_no'=>$cert_no, 'client_id'=>$_POST['mfsl_client_id'], 'effRep_totalSample'=>$_POST['mfsl_effRep_totalSample'], 'effTest_id'=>$_POST['mfsl_effTest_id'],
                'clientType_id'=>$source, 'effRep_physical'=>$_POST['mfsl_effRep_physical'], 'effRep_quantity'=>$_POST['mfsl_effRep_quantity'], 'effRep_color'=>$_POST['mfsl_effRep_color'], 'effRep_other'=>$_POST['mfsl_effRep_other']));
            for ($i=1;$i<=intVal($_POST['mfsl_effRep_totalSample']);$i++) {
                $barcode_no = $inx.$year.$i.'F';
                Class_db::getInstance()->db_insert('eff_sample_info', array('effRep_no'=>$cert_no, 'effLab_code'=>$cert_no.'/'.$i, 'effLab_barCode'=>$barcode_no));
            }
            $result = array('effRep_no'=>$cert_no, 'wfTask_id'=>$wfTask_id); 
            $fn_task->save_audit (309, $cert_no);
        } else if ($_POST['funct'] == 'save_eff_cert_info') {
            if (empty($_POST['mfsl_effRep_no']))    throw new Exception('(ErrCode:6835) [' . __LINE__ . '] - Parameter effRep_no empty.');
            $effRep_msds = (!empty($_POST['mfsl_effRep_msds'])) ? $_POST['mfsl_effRep_msds'] : '0';
            $result = Class_db::getInstance()->db_update('eff_sample_log', array('effRep_phyical'=>$_POST['mfsl_effRep_physical'], 'effRep_quantity'=>$_POST['mfsl_effRep_quantity'], 
                'effRep_color'=>$_POST['mfsl_effRep_color'], 'effRep_other'=>$_POST['mfsl_effRep_other']), array('effRep_no'=>$_POST['mfsl_effRep_no']));
            $fn_task->save_audit (310, $_POST['mfsl_effRep_no']);
        } else if ($_POST['funct'] == 'save_eff_sample_info') {
            if (empty($_POST['mfcr_effRep_no']))    throw new Exception('(ErrCode:6835) [' . __LINE__ . '] - Parameter effRep_no empty.');
            $arr_sample_info = Class_db::getInstance()->db_select('eff_sample_info', array('effRep_no'=>$_POST['mfcr_effRep_no']), NULL, NULL, 1);
            foreach ($arr_sample_info as $sample_info) {
                $mfcr_effLab_cost = $_POST['mfcr_effLab_cost_'.$sample_info['effLab_code']];
                $effLab_cost = is_numeric($mfcr_effLab_cost) ? $mfcr_effLab_cost : '';
                Class_db::getInstance()->db_update('eff_sample_info', array('effLab_sampleCode'=>$_POST['mfcr_effLab_sampleCode_'.$sample_info['effLab_code']], 'effLab_sampleDesc'=>$_POST['mfcr_effLab_sampleDesc_'.$sample_info['effLab_code']],
                    'effLab_cost'=>$effLab_cost), array('effLab_code'=>$sample_info['effLab_code']));
            }
            $result = '1';  
            $fn_task->save_audit (313, $_POST['mfcr_effRep_no']);
        } else if ($_POST['funct'] == 'save_eff_starting_date') {
            if (empty($_POST['mfcr_effRep_no']))    throw new Exception('(ErrCode:6835) [' . __LINE__ . '] - Parameter effRep_no empty.');
            $result = Class_db::getInstance()->db_update('eff_sample_log', array('effRep_timeStarted'=>$_POST['mfcr_effRep_timeStarted']), array('effRep_no'=>$_POST['mfcr_effRep_no']));
        } else if ($_POST['funct'] == 'save_eff_workbook') {
            if (empty($_POST['mfcr_effLab_code']))  throw new Exception('(ErrCode:6837) [' . __LINE__ . '] - Parameter effLab_code empty.');
            $arr_eff_test_res = Class_db::getInstance()->db_select('eff_test_res', array('effLab_code'=>$_POST['mfcr_effLab_code'], 'effRes_cycle'=>$_POST['mfcr_effRep_cycle']), NULL, NULL, 1);
            foreach ($arr_eff_test_res as $eff_test_res) {
                if (isset($_POST['mfcr_effRes_res_'.$eff_test_res['effRes_id']])) {
                    Class_db::getInstance()->db_update('eff_test_res', array('effRes_res'=>$_POST['mfcr_effRes_res_'.$eff_test_res['effRes_id']]), array('effRes_id'=>$eff_test_res['effRes_id']));
                }                
            }
            $result = '1'; 
            $fn_task->save_audit (318, $_POST['mfcr_effLab_code']);
        } else if ($_POST['funct'] == 'validate_eff_workbook') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6800) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            if (empty($arrayParam['effRep_no']))    throw new Exception('(ErrCode:6835) [' . __LINE__ . '] - Parameter effRep_no empty.');
            $result = '1';
            $arr_sample_info = Class_db::getInstance()->db_select('eff_sample_info', array('effRep_no'=>$arrayParam['effRep_no']), 'effLab_code', NULL, 1);
            foreach ($arr_sample_info as $sample_info) {
                if (Class_db::getInstance()->db_count('eff_test_res', array('effLab_code'=>$sample_info['effLab_code'], 'effRes_res'=>'is NULL', 'effRes_cycle'=>$arrayParam['effRes_cycle'])) > 0) {
                    $result = $sample_info['effLab_code'];
                    break;
                }
            }        
        } else if ($_POST['funct'] == 'save_eff_action') {
            if (empty($_POST['mfcr_wfTask_id']))        throw new Exception('(ErrCode:6814) [' . __LINE__ . '] - Parameter wfTask_id empty.');
            $wfTask_statusSave = (!empty($_POST['mfcr_action'])) ? $_POST['mfcr_action'] : '';
            $result = Class_db::getInstance()->db_update('wf_task', array('wfTask_statusSave'=>$wfTask_statusSave, 'wfTask_remark'=>$_POST['mfcr_wfTask_remark']), array('wfTask_id'=>$_POST['mfcr_wfTask_id']));
            $fn_task->save_audit (322, $_POST['mfcr_effRep_no']);              
        } else {
            throw new Exception('(ErrCode:5001) [' . __LINE__ . '] - Post[funct] not valid.');
        }
        $form_data['result'] = $result;
        $form_data['success'] = true;
        Class_db::getInstance()->db_commit();
    }
} catch (Exception $e) {
    Class_db::getInstance()->db_rollback();
    if ($e->getCode() == 32)
        $form_data['errors'] = substr($e->getMessage(), strpos($e->getMessage(), '] - ') + 3);
    else
        $form_data['errors'] = 'Error on system. Please contact Administrator!' . substr($e->getMessage(), 0, 14);
    $form_data['success'] = false;
    error_log(date("Y/m/d h:i:sa") . " [" . __FILE__ . ":" . __LINE__ . "] - " . $e->getMessage() . "\r\n", 3, $log_dir.'/error/error_' . date("Ymd") . '.log');
}
Class_db::getInstance()->db_close();

/* Return back the values to form */
echo json_encode($form_data);
?>
    