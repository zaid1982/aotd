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
    /* Validate the form on the server side - 5300 */
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('(ErrCode:0001) [' . __LINE__ . '] - Session expired. Please logout and login back.', 32);
    } else if (empty($_POST['funct'])) { // Function empty
        throw new Exception('(ErrCode:5000) [' . __LINE__ . '] - Post[funct] empty.');
    } else {
        Class_db::getInstance()->db_connect();        
        Class_db::getInstance()->db_beginTransaction();
        $fn_task = new Class_task();          
        if ($_POST['funct'] == 'add_customer_category') { 
            if (empty($_POST['mcc_clientGrp_name']))    throw new Exception('(ErrCode:5302) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (empty($_POST['mcc_clientType_id']))     throw new Exception('(ErrCode:5303) [' . __LINE__ . '] - Field Customer Type empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_client_group', array('clientGrp_name'=>$_POST['mcc_clientGrp_name'])) > 0) 
                throw new Exception('(ErrCode:5304) [' . __LINE__ . '] - Category Name already exist.', 32);
            $result = Class_db::getInstance()->db_insert('aotd_client_group', array('clientGrp_name'=>$_POST['mcc_clientGrp_name'], 'clientType_id'=>$_POST['mcc_clientType_id'], 'clientGrp_desc'=>$_POST['mcc_clientGrp_desc']));
            $fn_task->save_audit(12, $_POST['mcc_clientGrp_name']);
        } else if ($_POST['funct'] == 'update_customer_category') {
            if (empty($_POST['mcc_clientGrp_id']))      throw new Exception('(ErrCode:5301) [' . __LINE__ . '] - Parameter clientGrp_id empty.');
            if (empty($_POST['mcc_clientGrp_name']))    throw new Exception('(ErrCode:5302) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (empty($_POST['mcc_clientType_id']))     throw new Exception('(ErrCode:5303) [' . __LINE__ . '] - Field Customer Type empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_client_group', array('clientGrp_name'=>$_POST['mcc_clientGrp_name'], 'clientGrp_id'=>'<>'.$_POST['mcc_clientGrp_id'])) > 0) 
                throw new Exception('(ErrCode:5304) [' . __LINE__ . '] - Category Name already exist.', 32);
            $result = Class_db::getInstance()->db_update('aotd_client_group', array('clientGrp_name'=>$_POST['mcc_clientGrp_name'], 'clientType_id'=>$_POST['mcc_clientType_id'], 'clientGrp_desc'=>$_POST['mcc_clientGrp_desc']), array('clientGrp_id'=>$_POST['mcc_clientGrp_id']));
            $fn_task->save_audit(13, $_POST['mcc_clientGrp_name']);            
        } else if ($_POST['funct'] == 'add_customer') {
            if (empty($_POST['mcu_client_organisation']))   throw new Exception('(ErrCode:5306) [' . __LINE__ . '] - Field Customer Name empty.', 32);
            if (empty($_POST['mcu_clientGrp_id']))          throw new Exception('(ErrCode:5302) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (!isset($_POST['mcu_client_black']))          throw new Exception('(ErrCode:5307) [' . __LINE__ . '] - Field Blacklisted empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_client_info', array('client_organisation'=>$_POST['mcu_client_organisation'])) > 0) 
                throw new Exception('(ErrCode:5308) [' . __LINE__ . '] - Customer Name already exist.', 32);
            $result = Class_db::getInstance()->db_insert('aotd_client_info', array('client_organisation'=>$_POST['mcu_client_organisation'], 'clientGrp_id'=>$_POST['mcu_clientGrp_id'], 'client_pic'=>$_POST['mcu_client_pic'], 'client_designation'=>$_POST['mcu_client_designation'],
                'client_address'=>$_POST['mcu_client_address'], 'client_city'=>$_POST['mcu_client_city'], 'client_state'=>$_POST['mcu_client_state'], 'client_postcode'=>$_POST['mcu_client_postcode'], 'client_email'=>$_POST['mcu_client_email'],
                'client_url'=>$_POST['mcu_client_url'], 'client_black'=>$_POST['mcu_client_black'], 'client_phoneNo'=>$_POST['mcu_client_phoneNo'], 'client_faxNo'=>$_POST['mcu_client_faxNo'], 'country_id'=>$_POST['mcu_country_id']));
            $fn_task->save_audit(14, $_POST['mcu_client_organisation']);
        } else if ($_POST['funct'] == 'update_customer') {
            if (empty($_POST['mcu_client_id']))             throw new Exception('(ErrCode:5305) [' . __LINE__ . '] - Parameter client_id empty.');
            if (empty($_POST['mcu_client_organisation']))   throw new Exception('(ErrCode:5306) [' . __LINE__ . '] - Field Customer Name empty.', 32);
            if (empty($_POST['mcu_clientGrp_id']))          throw new Exception('(ErrCode:5302) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (!isset($_POST['mcu_client_black']))          throw new Exception('(ErrCode:5307) [' . __LINE__ . '] - Field Blacklisted empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_client_info', array('client_organisation'=>$_POST['mcu_client_organisation'], 'client_id'=>'<>'.$_POST['mcu_client_id'])) > 0) 
                throw new Exception('(ErrCode:5308) [' . __LINE__ . '] - Customer Name already exist.', 32);        
            $client_info = Class_db::getInstance()->db_select_single('aotd_client_info', array('client_id'=>$_POST['mcu_client_id']), NULL, 1);    
            $result = Class_db::getInstance()->db_update('aotd_client_info', array('client_organisation'=>$_POST['mcu_client_organisation'], 'client_pic'=>$_POST['mcu_client_pic'], 'client_designation'=>$_POST['mcu_client_designation'],
                'client_address'=>$_POST['mcu_client_address'], 'client_city'=>$_POST['mcu_client_city'], 'client_state'=>$_POST['mcu_client_state'], 'client_postcode'=>$_POST['mcu_client_postcode'], 'client_email'=>$_POST['mcu_client_email'],
                'client_url'=>$_POST['mcu_client_url'], 'client_black'=>$_POST['mcu_client_black'], 'client_phoneNo'=>$_POST['mcu_client_phoneNo'], 'client_faxNo'=>$_POST['mcu_client_faxNo'], 'country_id'=>$_POST['mcu_country_id']), array('client_id'=>$_POST['mcu_client_id']));
            $fn_task->save_audit(15, $_POST['mcu_client_organisation']);
            if ($_POST['mcu_client_black'] != $client_info['client_black']) {
                $fn_task->save_audit(($_POST['mcu_client_black']=='1'?16:17), $_POST['mcu_client_organisation']);
            }                
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
    