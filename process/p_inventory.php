<?php

session_start();
require_once '../library/db.php';
require_once '../function/f_task.php';
require_once '../function/f_upload.php';

$config = parse_ini_file('../library/config.ini');
$log_dir = $config['log_dir'];

function log_debug($line, $msg, $log_dir) {
    $debugMsg = date("Y/m/d h:i:sa")." [".__FILE__.":".$line."] - ".$msg."\r\n";
    error_log($debugMsg, 3, $log_dir.'/debug/debug_'.date("Ymd").'.log');
}

$form_data = array(); // Pass back the data to form

try {
    /* Validate the form on the server side - 5600 */
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('(ErrCode:0001) [' . __LINE__ . '] - Session expired. Please logout and login back.', 32);
    } else if (empty($_POST['funct'])) { // Function empty
        throw new Exception('(ErrCode:5000) [' . __LINE__ . '] - Post[funct] empty.');
    } else {
        Class_db::getInstance()->db_connect();        
        Class_db::getInstance()->db_beginTransaction();
        $fn_task = new Class_task();          
        if ($_POST['funct'] == 'add_inventory_category') { 
            if (empty($_POST['mvc_inventory_type']))    throw new Exception('(ErrCode:5602) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_inventory_type', array('inventory_type'=>$_POST['mvc_inventory_type'])) > 0) 
                throw new Exception('(ErrCode:5604) [' . __LINE__ . '] - Category Name already exist.', 32);
            $result = Class_db::getInstance()->db_insert('aotd_inventory_type', array('inventory_type'=>$_POST['mvc_inventory_type'], 'inventory_type_status'=>$_POST['mvc_inventory_type_status']));
            $fn_task->save_audit(19, $_POST['mvc_inventory_type']);
        } else if ($_POST['funct'] == 'save_inventory_category') {
            if (empty($_POST['mvc_inventory_type_id'])) throw new Exception('(ErrCode:5601) [' . __LINE__ . '] - Parameter inventory_type_id empty.');
            if (empty($_POST['mvc_inventory_type']))    throw new Exception('(ErrCode:5602) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_inventory_type', array('inventory_type'=>$_POST['mvc_inventory_type'], 'inventory_type_id'=>'<>'.$_POST['mvc_inventory_type_id'])) > 0) 
                throw new Exception('(ErrCode:5604) [' . __LINE__ . '] - Category Name already exist.', 32);
            $inventory_type = Class_db::getInstance()->db_select_single('aotd_inventory_type', array('inventory_type_id'=>$_POST['mvc_inventory_type_id']), NULL, 1);
            $result = Class_db::getInstance()->db_update('aotd_inventory_type', array('inventory_type'=>$_POST['mvc_inventory_type'], 'inventory_type_status'=>$_POST['mvc_inventory_type_status']), array('inventory_type_id'=>$_POST['mvc_inventory_type_id']));
            if ($_POST['mvc_inventory_type'] != $inventory_type['inventory_type']) {
                $fn_task->save_audit(20, $_POST['mvc_inventory_type']);
            } else if ($_POST['mvc_inventory_type_status'] != $inventory_type['inventory_type_status']) {
                $fn_task->save_audit(($_POST['mvc_inventory_type_status']=='1'?21:22), $_POST['mvc_inventory_type']);
            }
        } else if ($_POST['funct'] == 'add_inventory_item') {
            if (empty($_POST['mvi_item_name']))             throw new Exception('(ErrCode:5604) [' . __LINE__ . '] - Field Item Name empty.', 32);
            if (empty($_POST['mvi_inventory_type_id']))     throw new Exception('(ErrCode:5602) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_inventory', array('item_name'=>$_POST['mvi_item_name'])) > 0) 
                throw new Exception('(ErrCode:5603) [' . __LINE__ . '] - Item Name already exist.', 32);
            $document_id = $fn_upload->upload_file ('1', $_FILES['mvi_img_file'], 'Inventory image - '.$_POST['mvi_inventory_id'], '4', '', '', $_POST['mvi_inventory_id']);
            $result = Class_db::getInstance()->db_insert('aotd_inventory', array('item_name'=>$_POST['mvi_item_name'], 'inventory_type_id'=>$_POST['mvi_inventory_type_id'], 'location'=>$_POST['mvi_location'], 'classification'=>$_POST['mvi_classification'],
                'form'=>$_POST['mvi_form'], 'packing_size'=>$_POST['mvi_packing_size'], 'formulation'=>$_POST['mvi_formulation'], 'msds'=>$_POST['mvi_msds'], 'balance'=>$_POST['mvi_balance'],
                'min_level'=>$_POST['mvi_min_level'], 'price'=>$_POST['mvi_price'], 'inventory_status'=>$_POST['mvi_inventory_status'], 'document_id'=>$document_id));
            $fn_task->save_audit(23, $_POST['mvi_item_name']);            
        } else if ($_POST['funct'] == 'mvi_item_name') {
            if (empty($_POST['mvi_inventory_id']))          throw new Exception('(ErrCode:5605) [' . __LINE__ . '] - Parameter inventory_id empty.');
            if (empty($_POST['mvi_item_name']))             throw new Exception('(ErrCode:5604) [' . __LINE__ . '] - Field Item Name empty.', 32);
            if (empty($_POST['mvi_inventory_type_id']))     throw new Exception('(ErrCode:5602) [' . __LINE__ . '] - Field Category Name empty.', 32);
            if (Class_db::getInstance()->db_count('aotd_inventory', array('item_name'=>$_POST['mvi_item_name'], 'inventory_id'=>'<>'.$_POST['mvi_inventory_id'])) > 0) 
                throw new Exception('(ErrCode:5603) [' . __LINE__ . '] - Item Name already exist.', 32);            
            $fn_upload = new Class_upload(); 
            $document_id = $fn_upload->upload_file ('1', $_FILES['mvi_img_file'], 'Inventory image - '.$_POST['mvi_inventory_id'], '4', '', '', $_POST['mvi_inventory_id']);
            $inventory = Class_db::getInstance()->db_select_single('aotd_inventory', array('inventory_id'=>$_POST['mvi_inventory_id']), NULL, 1);
            $result = Class_db::getInstance()->db_update('aotd_inventory', array('item_name'=>$_POST['mvi_item_name'], 'inventory_type_id'=>$_POST['mvi_inventory_type_id'], 'location'=>$_POST['mvi_location'], 'classification'=>$_POST['mvi_classification'],
                'form'=>$_POST['mvi_form'], 'packing_size'=>$_POST['mvi_packing_size'], 'formulation'=>$_POST['mvi_formulation'], 'msds'=>$_POST['mvi_msds'], 'balance'=>$_POST['mvi_balance'],
                'min_level'=>$_POST['mvi_min_level'], 'price'=>$_POST['mvi_price'], 'inventory_status'=>$_POST['mvi_inventory_status'], 'document_id'=>$document_id), array('inventory_id'=>$_POST['mvi_inventory_id']));
            $fn_task->save_audit(24, $_POST['mvc_inventory_type']);
            if ($_POST['mvi_inventory_status'] != $inventory['inventory_status']) {
                $fn_task->save_audit(($_POST['mvi_inventory_status']=='1'?25:26), $_POST['mvi_item_name']);
            }       
        } else if ($_POST['funct'] == 'add_inventory_transaction') {
            if (empty($_POST['mvt_inventory_ids']))         throw new Exception('(ErrCode:5605) [' . __LINE__ . '] - Field Item Name empty.', 32);
            if (empty($_POST['mvt_transaction_type']))      throw new Exception('(ErrCode:5606) [' . __LINE__ . '] - Field Transaction Type empty.', 32);
            $inventory = Class_db::getInstance()->db_select_single('aotd_inventory', array('inventory_id'=>$_POST['mvt_inventory_ids']), NULL, 1);
            if ($_POST['mvt_transaction_type'] == '2' && $_POST['mvt_quantity_taken'] > $inventory['balance'])
                throw new Exception('(ErrCode:5607) [' . __LINE__ . '] - Quantity Taken cannot exceed Total Stock.', 32);
            $balance = $_POST['mvt_transaction_type'] == '2' ? (intval($inventory['balance']) - intval($_POST['mvt_quantity_taken'])) : (intval($inventory['balance']) + intval($_POST['mvt_stock_purchased']));
            $result = Class_db::getInstance()->db_insert('aotd_inventory_transaction', array('transaction_type'=>$_POST['mvt_transaction_type'], 'inventory_id'=>$_POST['mvt_inventory_ids'], 'user_id'=>$_SESSION['user_id'],
                'date_trans'=>'Now()', 'stock_purchased'=>$_POST['mvt_stock_purchased'], 'quantity_taken'=>$_POST['mvt_quantity_taken'], 'total_stock'=>$inventory['balance'], 'balance'=>$balance, 'notes'=>$_POST['mvt_notes']));
            $trans_cnt = $_POST['mvt_transaction_type'] == '2' ? 20000000 : 10000000;
            $trans_cnt = $trans_cnt + intval($result);
            Class_db::getInstance()->db_update('aotd_inventory_transaction', array('transaction_no'=>'T'.$trans_cnt), array('transaction_id'=>$result));
            Class_db::getInstance()->db_update('aotd_inventory', array('balance'=>$balance), array('inventory_id'=>$_POST['mvt_inventory_ids']));
            $fn_task->save_audit(($_POST['mvt_transaction_type']=='1'?27:28), $inventory['item_name'].' - '.($_POST['mvt_transaction_type']=='1'?$_POST['mvt_stock_purchased']:$_POST['mvt_quantity_taken']));
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
    