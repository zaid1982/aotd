<?php
session_start(); 
require_once '../library/db.php';
require_once '../function/f_task.php';
require_once '../function/f_email.php';

$config = parse_ini_file('../library/config.ini');
$log_dir = $config['log_dir'];

function log_debug($line, $msg, $log_dir) {
    $debugMsg = date("Y/m/d h:i:sa")." [".__FILE__.":".$line."] - ".$msg."\r\n";
    error_log($debugMsg, 3, $log_dir.'/debug/debug_'.date("Ymd").'.log');
}

// Function to get the client ip address
function get_client_ip_server() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']!='')
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']!='')
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED']!='')
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR']!='')
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED']!='')
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!='')
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}
    
$form_data = array(); // Pass back the data to form

try {     
    /* Validate the form on the server side - 5200 */
    if (empty($_POST['funct'])) { // Function empty
        throw new Exception('(ErrCode:5000) ['.__LINE__.'] - Post[funct] empty.');
    } else {        
        $fn_task = new Class_task();  
        $fn_email = new Class_email();
        Class_db::getInstance()->db_connect();
        Class_db::getInstance()->db_beginTransaction();
        if ($_POST['funct'] == 'task_create') {  
            $result = $fn_task->task_create($_SESSION["user_id"], $_POST['wfFlow_id'], $_POST['wfGroup_id'], $_POST['wfTaskType_id']);
        } else if ($_POST['funct'] == 'task_unclaim') {  
            if ($fn_task->task_validate($_SESSION["user_id"], $_POST['wfTask_id'], 'unclaim') != 0)
                throw new Exception('(ErrCode:5200) ['.__LINE__.'] - Task already unclaimed.', 32);
            $result = $fn_task->task_unclaim($_POST['wfTask_id']);
        } else if ($_POST['funct'] == 'task_claim') {  
            if ($fn_task->task_validate($_SESSION["user_id"], $_POST['wfTask_id'], 'claim') != 0)
                throw new Exception('(ErrCode:5200) ['.__LINE__.'] - Task already claimed by other user.', 32);
            $result = $fn_task->task_claim($_SESSION["user_id"], $_POST['wfTask_id']);
        } else if ($_POST['funct'] == 'task_submit') {  
            log_debug(__LINE__, 'wfTask_id'.$_POST['wfTask_id'], $log_dir);            
            if ($fn_task->task_validate($_SESSION["user_id"], $_POST['wfTask_id'], 'submit') != 0)
                throw new Exception('(ErrCode:5201) ['.__LINE__.'] - Cannot proceed the transaction.', 32);
            $result = $fn_task->task_submit($_SESSION["user_id"], $_POST['wfTask_id'], $_POST['wfTaskType_id'], $_POST['status'], $_POST['remarks'], $_POST['condition_no'], $_POST['assigned_group'], NULL, $_POST['assigned_user'], $_POST['refName'], $_POST['refValue']);    
            if (!empty($_POST['refName']) && !empty($_POST['refValue'])) {
                $email_data = Class_db::getInstance()->db_select_single('dt_email_checkpoint', array('wfTask_id'=>$result));
                if (!empty($email_data)) {
                    $arr_email = array();
                    $arr_email['flow_name'] = $email_data['wfFlow_desc'];
                    $arr_email['task_name'] = $email_data['wfTaskType_name'];
                    $arr_email['cert_no'] = $email_data['wfTrans_no'];
                    $arr_email['status'] = $email_data['status_desc'];
                    $lab_data = Class_db::getInstance()->db_select_single('vw_lab_data', array(), NULL, 1, array('lab_code'=>substr($_POST['refName'], 0, 3), 'ref_name'=>$_POST['refName'], 'ref_value'=>$_POST['refValue'])); 
                    $lab_short = substr($_POST['refName'], 0, strlen($_POST['refName'])-3);
                    $arr_email['no_of_sample'] = $lab_data[$lab_short.'_totalSample'];
                    $arr_email['customer'] = $lab_data['client_organisation'];
                    if (empty($email_data['wfTask_claimedBy'])) {
                        $arr_task_user = Class_db::getInstance()->db_select('wf_task_user', array('wfTaskType_id'=>$email_data['wfTaskType_id'], 'wfGroup_id'=>$email_data['wfGroup_id'], 'wfTaskUser_status'=>'1'));
                        foreach ($arr_task_user AS $task_user) {
                            $fn_email->insert_emailSend('4', $task_user['user_id'], $arr_email);
                        }
                    } else {
                        $fn_email->insert_emailSend('4', $email_data['wfTask_claimedBy'], $arr_email);
                    }
                }
            }
        } else if ($_POST['funct'] == 'get_wfGroup_id') {  
            $result = Class_db::getInstance()->db_select_col('wf_task_user', array('wfTaskType_id'=>$_POST['wfTaskType_id'], 'user_id'=>$_SESSION["user_id"]), 'wfGroup_id', NULL, 1);
        } else if ($_POST['funct'] == 'get_task_info') {   
            $result = Class_db::getInstance()->db_select_single('wf_task', array('wfTask_id'=>$_POST['wfTask_id']), NULL, 1);
            $result['wfTask_status_desc'] = Class_db::getInstance()->db_select_col('ref_status', array('status_id'=>$result['wfTask_status']), 'status_desc', NULL, 1);
            $result['wfTask_claimedBy_name'] = Class_db::getInstance()->db_select_col('user', array('user_id'=>$result['wfTask_claimedBy']), 'user_fullname', NULL, 1);
        } else if ($_POST['funct'] == 'get_task_previous') {
            $wfTrans_id = Class_db::getInstance()->db_select_col('wf_task', array('wfTask_id'=>$_POST['wfTask_id']), 'wfTrans_id', NULL, 1); 
            if (empty($_POST['wfTaskType_id']))
                $result = Class_db::getInstance()->db_select_col('wf_task', array('wfTask_id'=>'<'.$_POST['wfTask_id'],'wfTrans_id'=>$wfTrans_id, 'wfTask_partition'=>'2', 'wfTask_claimedBy'=>'is not NULL'), 'wfTask_id', 'wfTask_id desc', 1);
            else
                $result = Class_db::getInstance()->db_select_col('wf_task', array('wfTrans_id'=>$wfTrans_id, 'wfTask_partition'=>'2', 'wfTask_claimedBy'=>'is not NULL', 'wfTaskType_id'=>$_POST['wfTaskType_id']), 'wfTask_id', 'wfTask_id desc', 1);
        } else if ($_POST['funct'] == 'save_task_info') {   
            $result = Class_db::getInstance()->db_update('wf_task', array('wfTask_status'=>$_POST['wfTask_status'], 'wfTask_remark'=>$_POST['wfTask_remark']), array('wfTask_id'=>$_POST['wfTask_id']));
        } else if ($_POST['funct'] == 'get_is_return') { 
            $wfTaskType_id = Class_db::getInstance()->db_select_col('wf_task', array('wfTask_id'=>$_POST['wfTask_id']), 'wfTaskType_id', NULL, 1);
            $result = Class_db::getInstance()->db_select_col('wf_task_type', array('wfTaskType_id'=>$wfTaskType_id), 'wfTaskType_isReturn', NULL, 1);
        } else if ($_POST['funct'] == 'get_list_taskType') { 
            $columns = array('wfFlow_id'=>$_POST['wfFlow_id'], 'uType_cate'=>$_POST['uType_cate'], 'wfGroup_id'=>$_POST['wfGroup_id']);
            $result = Class_db::getInstance()->db_select('vw_task_assign', $columns, 'wfTaskType_id');  
        } else if ($_POST['funct'] == 'get_user_assigned') { 
            $columns = array('wfTaskUser_id'=>'is not NULL', 'wfGroup_id'=>$_POST['wfGroup_id']);
            $result = Class_db::getInstance()->db_select('vw_user_assigned', $columns, 'user_fullname', NULL, NULL, array('wfTaskType_id'=>$_POST['wfTaskType_id']));
        } else if ($_POST['funct'] == 'get_user_notAssigned') { 
            $columns = array('wfTaskUser_id'=>'is NULL', 'wfGroup_id'=>$_POST['wfGroup_id']);
            $result = Class_db::getInstance()->db_select('vw_user_assigned', $columns, 'user_fullname', NULL, NULL, array('wfTaskType_id'=>$_POST['wfTaskType_id']));
        } else if ($_POST['funct'] == 'save_task_user') { 
            Class_db::getInstance()->db_insert('wf_task_user', array('wfGroup_id'=>$_POST['wfGroup_id'], 'wfTaskType_id'=>$_POST['wfTaskType_id'], 'user_id'=>$_POST['user_id']));
            $result = 'User Task successfully saved'; 
        } else if ($_POST['funct'] == 'remove_task_user') { 
            // unclaim task claimed by this user
            $setArr = array('wfTask_claimedBy'=>'NULL', 'wfTask_timeClaimed'=>'NULL');
            Class_db::getInstance()->db_update('wf_task', $setArr, array('wfGroup_id'=>$_POST['wfGroup_id'], 'wfTaskType_id'=>$_POST['wfTaskType_id'], 'wfTask_claimedBy'=>$_POST['user_id']));
            Class_db::getInstance()->db_delete('wf_task_user', array('wfGroup_id'=>$_POST['wfGroup_id'], 'wfTaskType_id'=>$_POST['wfTaskType_id'], 'user_id'=>$_POST['user_id']));
            $result = 'User Task successfully deleted'; 
        } else if ($_POST['funct'] == 'get_task_history_info') {
            $wfTrans_id = empty($_POST['wfTask_id']) ? '' : Class_db::getInstance()->db_select_col('wf_task', array('wfTask_id'=>$_POST['wfTask_id']), 'wfTrans_id');
            $result = Class_db::getInstance()->db_select_single('dt_task_history_info', array('wfTrans_id'=>$wfTrans_id), 'wfTask_id desc');
            $result['train'] = Class_db::getInstance()->db_select_col('dt_task_type', array('wfTrans_id'=>$wfTrans_id, 'wfTaskType_isEnd'=>'N'), 'wfTaskType_id', 'wfTask_id desc');
        } else if ($_POST['funct'] == 'get_value_from_table') {
            $result = Class_db::getInstance()->db_select_col($_POST['tablename'], array($_POST['column_name']=>$_POST['column_value']), $_POST['column_out']);
        } else if ($_POST['funct'] == 'save_audit') {
            log_debug(__LINE__, 'save_audit = '.$_POST['auditModule_id'].' - '.$_POST['auditAction_id'], $log_dir);
            $result = $_POST['auditAction_id'] != '0' ? $fn_task->save_audit($_POST['auditAction_id'], $_POST['audit_transNo']) : '0';
        } else if ($_POST['funct'] == 'get_general_info') {
            $columns = !empty($_POST['columns']) ? $_POST['columns'] : array();
            $param = array('table_name'=>$_POST['tablename'], 'status_name'=>$_POST['status_name']);
            if (!empty($_POST['param']))
                $param = array_merge($param, $_POST['param']);
            if (!empty($_POST['status_name']))
                $result = Class_db::getInstance()->db_select_single('vw_join_status', $columns, NULL, NULL, $param);
            else
                $result = Class_db::getInstance()->db_select_single($_POST['tablename'], $columns, NULL, NULL, $param);
        } else if ($_POST['funct'] == 'get_general_info_multiple') {
            $columns = !empty($_POST['columns']) ? $_POST['columns'] : array();
            $param = array('table_name'=>$_POST['tablename'], 'status_name'=>$_POST['status_name']);
            if (!empty($_POST['param']))
                $param = array_merge($param, $_POST['param']);
            if (!empty($_POST['status_name']))
                $result = Class_db::getInstance()->db_select('vw_join_status', $columns, NULL, NULL, NULL, $param);
            else 
                $result = Class_db::getInstance()->db_select($_POST['tablename'], $columns, (!empty($_POST['order']) ? $_POST['order'] : NULL), NULL, NULL, $param);
        } else {
            throw new Exception('(ErrCode:5001) ['.__LINE__.'] - Post[funct] not valid.');
        }
        $form_data['result'] = $result;
        $form_data['success'] = true;
        Class_db::getInstance()->db_commit();
    }    
} catch(Exception $e) {
    Class_db::getInstance()->db_rollback();
    if ($e->getCode() == 32)
        $form_data['errors'] = substr($e->getMessage(), strpos($e->getMessage(), '] - ') + 3);
    else if ($e->getCode() == 31)
        $form_data['errors'] = substr($e->getMessage(), strpos($e->getMessage(), '] - ') + 3);
    else
        $form_data['errors'] = 'Error on system. Please contact Administrator! ' . substr($e->getMessage(), 0, 14);   
    $form_data['success'] = false;
    error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $log_dir.'/error/error_'.date("Ymd").'.log');
} 
Class_db::getInstance()->db_close();
        
/* Return back the values to form */
//$input = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($form_data));
$json = json_encode($form_data);
switch (json_last_error()){
    case JSON_ERROR_CTRL_CHAR:
        log_debug(__LINE__, 'JSON_ERROR_CTRL_CHAR', $log_dir);
        break;
    case JSON_ERROR_UTF8:
        log_debug(__LINE__, 'JSON_ERROR_UTF8', $log_dir);
        break;
    case JSON_ERROR_SYNTAX:
        log_debug(__LINE__, 'JSON_ERROR_SYNTAX', $log_dir);
        break;
    case JSON_ERROR_DEPTH:
        log_debug(__LINE__, 'JSON_ERROR_DEPTH', $log_dir);
        break;
    case JSON_ERROR_STATE_MISMATCH:
        log_debug(__LINE__, 'JSON_ERROR_STATE_MISMATCH', $log_dir);
        break;
    default:
        //log_debug(__LINE__, 'others');
        break;
}
echo $json;

?>
