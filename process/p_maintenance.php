<?php

session_start();
require_once '../library/db.php';
require_once '../function/f_task.php';
require_once '../function/f_email.php';

$config = parse_ini_file('../library/config.ini');
$log_dir = $config['log_dir'];

function log_debug($line, $msg, $log_dir) {
    $debugMsg = date("Y/m/d h:i:sa") . " [" . __FILE__ . ":" . $line . "] - " . $msg . "\r\n";
    error_log($debugMsg, 3, $log_dir.'/debug/debug_'.date("Ymd").'.log');
}

$form_data = array(); // Pass back the data to form

try {
    /* Validate the form on the server side - 5500 -> 6500 */
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('(ErrCode:0001) [' . __LINE__ . '] - Session expired. Please logout and login back.', 32);
    } else if (empty($_POST['funct'])) { // Function empty
        throw new Exception('(ErrCode:5000) [' . __LINE__ . '] - Post[funct] empty.');
    } else {
        Class_db::getInstance()->db_connect();        
        Class_db::getInstance()->db_beginTransaction();
        $fn_task = new Class_task(); 
        $fn_email = new Class_email();   
        if ($_POST['funct'] == 'create_state') {            
            if (empty($_POST['mrf_ref_desc']))      throw new Exception('(ErrCode:6515) [' . __LINE__ . '] - Field State empty.', 32);
            else if (Class_db::getInstance()->db_count('ref_state', array('state_desc' => $_POST['mrf_ref_desc'])) > 0)
                throw new Exception('(ErrCode:6516) [' . __LINE__ . '] - State already exist.', 32);
            $result = Class_db::getInstance()->db_insert('ref_state', array('state_desc' => $_POST['mrf_ref_desc']));
        } else if ($_POST['funct'] == 'edit_state') {
            if (empty($_POST['mrf_ref_id']))        throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc'])) throw new Exception('(ErrCode:6515) [' . __LINE__ . '] - Field State empty.', 32);
            else if (Class_db::getInstance()->db_count('ref_state', array('state_desc' => $_POST['mrf_ref_desc'], 'state_id' => '<>'.$_POST['mrf_ref_id'])) > 0) 
                throw new Exception('(ErrCode:6516) [' . __LINE__ . '] - State already exist.', 32);
            $result = Class_db::getInstance()->db_update('ref_state', array('state_desc' => $_POST['mrf_ref_desc']), array('state_id' => $_POST['mrf_ref_id']));    
        } else if ($_POST['funct'] == 'create_city') {            
            if (empty($_POST['mrf_ref_desc']))          throw new Exception('(ErrCode:6519) [' . __LINE__ . '] - Field City empty.', 32);
            else if (empty($_POST['mrf_opt_parent']))   throw new Exception('(ErrCode:6515) [' . __LINE__ . '] - Field State empty.', 32);
            else if (Class_db::getInstance()->db_count('ref_city', array('city_desc' => $_POST['mrf_ref_desc'], 'state_id' => $_POST['mrf_opt_parent'])) > 0)
                throw new Exception('(ErrCode:6520) [' . __LINE__ . '] - City already exist.', 32);
            $result = Class_db::getInstance()->db_insert('ref_city', array('city_desc' => $_POST['mrf_ref_desc'], 'state_id' => $_POST['mrf_opt_parent']));
        } else if ($_POST['funct'] == 'edit_city') {
            if (empty($_POST['mrf_ref_id']))            throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc']))     throw new Exception('(ErrCode:6519) [' . __LINE__ . '] - Field City empty.', 32);
            else if (empty($_POST['mrf_opt_parent']))   throw new Exception('(ErrCode:6515) [' . __LINE__ . '] - Field State empty.', 32);
            else if (Class_db::getInstance()->db_count('ref_city', array('city_desc' => $_POST['mrf_ref_desc'], 'state_id' => $_POST['mrf_opt_parent'], 'city_id' => '<>'.$_POST['mrf_ref_id'])) > 0)
                throw new Exception('(ErrCode:5514) [' . __LINE__ . '] - City already exist.', 32);
            $result = Class_db::getInstance()->db_update('ref_city', array('city_desc' => $_POST['mrf_ref_desc'], 'state_id' => $_POST['mrf_opt_parent']), array('city_id' => $_POST['mrf_ref_id']));    
        } else if ($_POST['funct'] == 'create_department') {            
            if (empty($_POST['mrf_ref_desc']))      throw new Exception('(ErrCode:6521) [' . __LINE__ . '] - Field Department empty.', 32);
            else if (Class_db::getInstance()->db_count('ref_department', array('department_desc' => $_POST['mrf_ref_desc'])) > 0) 
                throw new Exception('(ErrCode:6522) [' . __LINE__ . '] - Department already exist.', 32);
            $result = Class_db::getInstance()->db_insert('ref_department', array('department_desc' => $_POST['mrf_ref_desc']));
        } else if ($_POST['funct'] == 'edit_department') {
            if (empty($_POST['mrf_ref_id']))        throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc'])) throw new Exception('(ErrCode:6521) [' . __LINE__ . '] - Field Department empty.', 32);
            else if (Class_db::getInstance()->db_count('ref_department', array('department_desc' => $_POST['mrf_ref_desc'], 'department_id' => '<>'.$_POST['mrf_ref_id'])) > 0)
                throw new Exception('(ErrCode:6522) [' . __LINE__ . '] - Department already exist.', 32);
            $result = Class_db::getInstance()->db_update('ref_department', array('department_desc' => $_POST['mrf_ref_desc']), array('department_id' => $_POST['mrf_ref_id']));    
        } else if ($_POST['funct'] == 'create_inquiry_category') {            
            if (empty($_POST['mrf_ref_desc']))      throw new Exception('(ErrCode:6523) [' . __LINE__ . '] - Field Inquiry Category empty.', 32);
            else if (Class_db::getInstance()->db_count('t_qnf_category', array('qnfCate_desc' => $_POST['mrf_ref_desc'])) > 0)
                throw new Exception('(ErrCode:6524) [' . __LINE__ . '] - Inquiry Category already exist.', 32);
            $result = Class_db::getInstance()->db_insert('t_qnf_category', array('qnfCate_desc' => $_POST['mrf_ref_desc']));
        } else if ($_POST['funct'] == 'edit_inquiry_category') {
            if (empty($_POST['mrf_ref_id']))        throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc'])) throw new Exception('(ErrCode:6523) [' . __LINE__ . '] - Field Inquiry Category empty.', 32);
            else if (Class_db::getInstance()->db_count('t_qnf_category', array('qnfCate_desc' => $_POST['mrf_ref_desc'], 'qnfCate_id' => '<>'.$_POST['mrf_ref_id'])) > 0)
                throw new Exception('(ErrCode:6524) [' . __LINE__ . '] - Inquiry Category already exist.', 32);
            $result = Class_db::getInstance()->db_update('t_qnf_category', array('qnfCate_desc' => $_POST['mrf_ref_desc']), array('qnfCate_id' => $_POST['mrf_ref_id']));    
        } else if ($_POST['funct'] == 'create_certificate_issuer') {            
            if (empty($_POST['mrf_ref_desc']))      throw new Exception('(ErrCode:6525) [' . __LINE__ . '] - Field Certificate Issuer empty.', 32);
            else if (Class_db::getInstance()->db_count('t_certificate_issuer', array('certIssuer_desc' => $_POST['mrf_ref_desc'])) > 0) 
                throw new Exception('(ErrCode:6526) [' . __LINE__ . '] - Certificate Issuer already exist.', 32);
            $result = Class_db::getInstance()->db_insert('t_certificate_issuer', array('certIssuer_desc' => $_POST['mrf_ref_desc']));
        } else if ($_POST['funct'] == 'edit_certificate_issuer') {
            if (empty($_POST['mrf_ref_id']))        throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc'])) throw new Exception('(ErrCode:6525) [' . __LINE__ . '] - Field Certificate Issuer empty.', 32);
            else if (Class_db::getInstance()->db_count('t_certificate_issuer', array('certIssuer_desc' => $_POST['mrf_ref_desc'], 'certIssuer_id' => '<>'.$_POST['mrf_ref_id'])) > 0)
                throw new Exception('(ErrCode:6526) [' . __LINE__ . '] - Certificate Issuer already exist.', 32);
            $result = Class_db::getInstance()->db_update('t_certificate_issuer', array('certIssuer_desc' => $_POST['mrf_ref_desc']), array('certIssuer_id' => $_POST['mrf_ref_id']));    
        } else if ($_POST['funct'] == 'create_software_method') {            
            if (empty($_POST['mrf_ref_desc']))      throw new Exception('(ErrCode:6527) [' . __LINE__ . '] - Field Software Predictive Method empty.', 32);
            else if (Class_db::getInstance()->db_count('t_software_method', array('softwareMethod_desc' => $_POST['mrf_ref_desc'])) > 0)
                throw new Exception('(ErrCode:6528) [' . __LINE__ . '] - Software Predictive Method already exist.', 32);
            $result = Class_db::getInstance()->db_insert('t_software_method', array('softwareMethod_desc' => $_POST['mrf_ref_desc']));
        } else if ($_POST['funct'] == 'edit_software_method') {
            if (empty($_POST['mrf_ref_id']))        throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc'])) throw new Exception('(ErrCode:6527) [' . __LINE__ . '] - Field Software Predictive Method empty.', 32);
            else if (Class_db::getInstance()->db_count('t_software_method', array('softwareMethod_desc' => $_POST['mrf_ref_desc'], 'softwareMethod_id' => '<>'.$_POST['mrf_ref_id'])) > 0)
                throw new Exception('(ErrCode:6528) [' . __LINE__ . '] - Software Predictive Method already exist.', 32);
            $result = Class_db::getInstance()->db_update('t_software_method', array('softwareMethod_desc' => $_POST['mrf_ref_desc']), array('softwareMethod_id' => $_POST['mrf_ref_id']));    
        } else if ($_POST['funct'] == 'create_CEMS_description') {            
            if (empty($_POST['mrf_ref_desc']))      throw new Exception('(ErrCode:6529) [' . __LINE__ . '] - Field CEMS Industrial Process Description empty.', 32);
            else if (Class_db::getInstance()->db_count('document_name', array('documentName_desc' => $_POST['mrf_ref_desc'], 'documentName_type' => 'cems')) > 0)
                throw new Exception('(ErrCode:6530) [' . __LINE__ . '] - CEMS Industrial Process Description already exist.', 32);
            $result = Class_db::getInstance()->db_insert('document_name', array('documentName_desc' => $_POST['mrf_ref_desc'], 'documentName_type' => 'cems'));
        } else if ($_POST['funct'] == 'edit_CEMS_description') {
            if (empty($_POST['mrf_ref_id']))        throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc'])) throw new Exception('(ErrCode:6529) [' . __LINE__ . '] - Field CEMS Industrial Process Description empty.', 32);
            else if (Class_db::getInstance()->db_count('document_name', array('documentName_desc' => $_POST['mrf_ref_desc'], 'documentName_type' => 'cems', 'documentName_id' => '<>'.$_POST['mrf_ref_id'])) > 0)
                throw new Exception('(ErrCode:6530) [' . __LINE__ . '] - CEMS Industrial Process Description already exist.', 32);
            $result = Class_db::getInstance()->db_update('document_name', array('documentName_desc' => $_POST['mrf_ref_desc']), array('documentName_id' => $_POST['mrf_ref_id']));    
        } else if ($_POST['funct'] == 'create_PEMS_description') {            
            if (empty($_POST['mrf_ref_desc']))      throw new Exception('(ErrCode:6531) [' . __LINE__ . '] - Field PEMS Industrial Process Description empty.', 32);
            else if (Class_db::getInstance()->db_count('document_name', array('documentName_desc' => $_POST['mrf_ref_desc'], 'documentName_type' => 'pems')) > 0)
                throw new Exception('(ErrCode:6532) [' . __LINE__ . '] - PEMS Industrial Process Description already exist.', 32);
            $result = Class_db::getInstance()->db_insert('document_name', array('documentName_desc' => $_POST['mrf_ref_desc'], 'documentName_type' => 'pems'));
        } else if ($_POST['funct'] == 'edit_PEMS_description') {
            if (empty($_POST['mrf_ref_id']))        throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            else if (empty($_POST['mrf_ref_desc'])) throw new Exception('(ErrCode:6531) [' . __LINE__ . '] - Field PEMS Industrial Process Description empty.', 32);
            else if (Class_db::getInstance()->db_count('document_name', array('documentName_desc' => $_POST['mrf_ref_desc'], 'documentName_type' => 'pems', 'documentName_id' => '<>'.$_POST['mrf_ref_id'])) > 0)
                throw new Exception('(ErrCode:6532) [' . __LINE__ . '] - PEMS Industrial Process Description already exist.', 32);
            $result = Class_db::getInstance()->db_update('document_name', array('documentName_desc' => $_POST['mrf_ref_desc']), array('documentName_id' => $_POST['mrf_ref_id']));             
        } else if ($_POST['funct'] == 'add_user') {
            if (empty($_POST['mus_user_name']))                throw new Exception('(ErrCode:6535) [' . __LINE__ . '] - Field Username empty.', 32);
            if (empty($_POST['mus_title_id']))                 throw new Exception('(ErrCode:6537) [' . __LINE__ . '] - Field Title empty.', 32);
            if (empty($_POST['mus_profile_name']))             throw new Exception('(ErrCode:6510) [' . __LINE__ . '] - Field Name empty.', 32);
            if (empty($_POST['mus_profile_lastname']))         throw new Exception('(ErrCode:6504) [' . __LINE__ . '] - Field Last Name empty.', 32);
            if (empty($_POST['mus_profile_email']))            throw new Exception('(ErrCode:6505) [' . __LINE__ . '] - Field Email Address empty.', 32);
            if (empty($_POST['mus_wfGroup_ids']))              throw new Exception('(ErrCode:6507) [' . __LINE__ . '] - Field Department empty.', 32);
            if (empty($_POST['mus_user_password']))            throw new Exception('(ErrCode:6534) [' . __LINE__ . '] - Field Password empty.', 32);
            if (empty($_POST['mus_uType_ids']))                throw new Exception('(ErrCode:6512) [' . __LINE__ . '] - Field Roles empty.', 32);
            if (Class_db::getInstance()->db_count('user', array('user_name'=>$_POST['mus_user_name'])) > 0) 
                throw new Exception('(ErrCode:6513) [' . __LINE__ . '] - Username already exist.', 32);
            $user_password = $fn_task->generateRandomString(10);
            $user_id = Class_db::getInstance()->db_insert('user', array('user_name'=>$_POST['mus_user_name'], 'user_password'=>md5($user_password), 'old_password'=>$user_password, 'user_isFirstTime'=>'0', 'user_type'=>'1', 'user_status'=>$_POST['mus_user_status']));
            $address_id = Class_db::getInstance()->db_insert('address', array('address_line1'=>$_POST['mus_address_line1'], 'address_postcode'=>$_POST['mus_address_postcode'], 'city_id'=> (empty($_POST['mus_city_id'])?'':$_POST['mus_city_id'])));
            $profile_id = Class_db::getInstance()->db_insert('profile', array('title_id'=>$_POST['mus_title_id'], 'profile_name'=>$_POST['mus_profile_name'], 'profile_lastname'=>$_POST['mus_profile_lastname'], 'profile_ikimNo'=>$_POST['mus_profile_ikimNo'], 'profile_designation'=>$_POST['mus_profile_designation'],
                'profile_organization'=>$_POST['mus_profile_organization'], 'profile_phoneNo'=>$_POST['mus_profile_phoneNo'], 'profile_faxNo'=>$_POST['mus_profile_faxNo'], 'profile_email'=>$_POST['mus_profile_email'], 'profile_specialization'=>$_POST['mus_profile_specialization'], 
                'profile_remark'=>$_POST['mus_profile_remark'], 'user_id'=>$user_id, 'address_id'=>$address_id, 'profile_createdBy'=>$_SESSION['user_id'])); 
            Class_db::getInstance()->db_update('user', array('profile_id'=>$profile_id), array('user_id'=>$user_id));
            foreach ($_POST['mus_wfGroup_ids'] as $wfGroup_id) {
                Class_db::getInstance()->db_insert('wf_group_user', array('user_id'=>$user_id, 'wfGroup_id'=>$wfGroup_id));
            }
            foreach ($_POST['mus_uType_ids'] as $uType_id) {
                Class_db::getInstance()->db_insert('user_type', array('user_id'=>$user_id, 'uType_id'=>$uType_id));
                $arr_wfTaskType_id = Class_db::getInstance()->db_select_colm('wf_task_type', array('uType_id'=>$uType_id, 'wfGroup_id'=>'is NULL'), 'wfTaskType_id');
                if (!empty($arr_wfTaskType_id)) {
                    foreach ($arr_wfTaskType_id as $wfTaskType_id) {
                        Class_db::getInstance()->db_insert('wf_task_user', array('user_id'=>$user_id, 'wfTaskType_id'=>$wfTaskType_id, 'wfGroup_id'=>$_POST['mus_wfGroup_ids'][0]));
                    }
                }
                $arr_wfTaskType = Class_db::getInstance()->db_select('wf_task_type', array('uType_id'=>$uType_id, 'wfGroup_id'=>'('.  implode(',', $_POST['mus_wfGroup_ids']).')'));
                foreach($arr_wfTaskType as $wfTaskType) {
                    Class_db::getInstance()->db_insert('wf_task_user', array('user_id'=>$user_id, 'wfTaskType_id'=>$wfTaskType['wfTaskType_id'], 'wfGroup_id'=>$wfTaskType['wfGroup_id']));
                }
            }
            $email_info = Class_db::getInstance()->db_select_single('dt_user_mgmt', array('user_id'=>$user_id), NULL, 1);
            $fn_email->insert_emailSend(1, $user_id, array('user_name'=>$_POST['mus_user_name'], 'department'=>$email_info['wfGroup_names'], 'roles'=>$email_info['role_list']));
            $fn_task->save_audit(6, $_POST['mus_profile_name']);
            $result = $user_id;
        } else if ($_POST['funct'] == 'update_user' || $_POST['funct'] == 'update_profile') {
            if (empty($_POST['mus_user_id']))                  throw new Exception('(ErrCode:6501) [' . __LINE__ . '] - Parameter user_id empty.');
            if (empty($_POST['mus_profile_id']))               throw new Exception('(ErrCode:6502) [' . __LINE__ . '] - Parameter profile_id empty.');
            if (empty($_POST['mus_user_name']))                throw new Exception('(ErrCode:6535) [' . __LINE__ . '] - Field Username empty.', 32);
            if (empty($_POST['mus_title_id']))                 throw new Exception('(ErrCode:6537) [' . __LINE__ . '] - Field Title empty.', 32);
            if (empty($_POST['mus_profile_name']))             throw new Exception('(ErrCode:6510) [' . __LINE__ . '] - Field Name empty.', 32);
            if (empty($_POST['mus_profile_lastname']))         throw new Exception('(ErrCode:6504) [' . __LINE__ . '] - Field Last Name empty.', 32);
            if (empty($_POST['mus_profile_email']))            throw new Exception('(ErrCode:6505) [' . __LINE__ . '] - Field Email Address empty.', 32);
            if (empty($_POST['mus_address_id']))               throw new Exception('(ErrCode:6536) [' . __LINE__ . '] - Parameter address_id empty.');
            if (empty($_POST['mus_user_password']))            throw new Exception('(ErrCode:6534) [' . __LINE__ . '] - Field Password empty.', 32);
            if (empty($_POST['mus_wfGroup_ids']) && $_POST['funct'] == 'update_user')   throw new Exception('(ErrCode:6507) [' . __LINE__ . '] - Field Department empty.', 32);
            if (empty($_POST['mus_uType_ids']) && $_POST['funct'] == 'update_user')     throw new Exception('(ErrCode:6512) [' . __LINE__ . '] - Field Roles empty.', 32);
            if (Class_db::getInstance()->db_count('user', array('user_name'=>$_POST['mus_user_name'], 'user_id'=>'<>'.$_POST['mus_user_id'])) > 0) 
                throw new Exception('(ErrCode:6513) [' . __LINE__ . '] - Username already exist.', 32);
            $user_id = $_POST['mus_user_id'];
            $user = Class_db::getInstance()->db_select_single('user', array('user_id'=>$user_id), NULL, 1);
            $user_password = $_POST['mus_user_password'] == '1029384756' ? $user['user_password'] : md5($_POST['mus_user_password']);
            Class_db::getInstance()->db_update('user', array('user_name'=>$_POST['mus_user_name'], 'user_password'=>$user_password), array('user_id'=>$user_id));
            Class_db::getInstance()->db_update('profile', array('title_id'=>$_POST['mus_title_id'], 'profile_name'=>$_POST['mus_profile_name'], 'profile_lastname'=>$_POST['mus_profile_lastname'], 'profile_ikimNo'=>$_POST['mus_profile_ikimNo'], 'profile_designation'=>$_POST['mus_profile_designation'],
                'profile_organization'=>$_POST['mus_profile_organization'], 'profile_phoneNo'=>$_POST['mus_profile_phoneNo'], 'profile_faxNo'=>$_POST['mus_profile_faxNo'], 'profile_email'=>$_POST['mus_profile_email'], 'profile_specialization'=>$_POST['mus_profile_specialization'], 
                'profile_remark'=>$_POST['mus_profile_remark']), array('profile_id'=>$_POST['mus_profile_id']));
            Class_db::getInstance()->db_update('address', array('address_line1'=>$_POST['mus_address_line1'], 'address_postcode'=>$_POST['mus_address_postcode'], 'city_id'=>(empty($_POST['mus_city_id'])?'':$_POST['mus_city_id'])), array('address_id'=>$_POST['mus_address_id']));
            if ($_POST['funct'] == 'update_user') {
                if ($_POST['mus_user_status'] == '0' && $user['user_status'] == '1') {
                    log_debug(__LINE__, 'Deactivate active user', $log_dir);
                    if (Class_db::getInstance()->db_count('wf_task_assign', array('user_id'=>$user_id)) > 0) {
                        throw new Exception('(ErrCode:6509) [' . __LINE__ . '] - This user is still in the application process. Make sure all application involving this user completed before change Roles.');
                    }
                    Class_db::getInstance()->db_update('user', array('user_status'=>'0'), array('user_id'=>$user_id));
                    $fn_task->save_audit(8, $_POST['mus_profile_name']);
                } else if ($_POST['mus_user_status'] == '1' && $user['user_status'] == '0') {
                    log_debug(__LINE__, 'Active inactive user', $log_dir);
                    Class_db::getInstance()->db_update('user', array('user_status'=>'1'), array('user_id'=>$user_id));
                    $fn_task->save_audit(9, $_POST['mus_profile_name']);
                }
                $arr_groupUser = Class_db::getInstance()->db_select_colm ('wf_group_user', array('user_id'=>$user_id), 'wfGroup_id');
                $arrPost_groupUser = (!empty($_POST['mus_wfGroup_ids'])) ? $_POST['mus_wfGroup_ids'] : array();
                if ($arr_groupUser != $arrPost_groupUser) {
                    $arrDiff_groupUser1 = array_diff($arrPost_groupUser, $arr_groupUser);
                    foreach($arrDiff_groupUser1 as $value) {
                        Class_db::getInstance()->db_insert('wf_group_user', array('user_id'=>$user_id, 'wfGroup_id'=>$value));
                    }
                    $arrDiff_groupUser2 = array_diff($arr_groupUser, $arrPost_groupUser);
                    if (count($arrDiff_groupUser2) > 0) {
                        Class_db::getInstance()->db_delete('wf_group_user', array('user_id'=>$user_id, 'wfGroup_id'=>'('.  implode(',', $arrDiff_groupUser2).')'));
                    }
                } 
                $wfGroup_id_main = $arrPost_groupUser[0];
                $arr_uType = Class_db::getInstance()->db_select_colm ('user_type', array('user_id'=>$user_id), 'uType_id');
                $arrPost_uType = (!empty($_POST['mus_uType_ids'])) ? $_POST['mus_uType_ids'] : array();
                if ($arr_uType != $arrPost_uType) {
                    $arrDiff_uType1 = array_diff($arrPost_uType, $arr_uType);
                    foreach($arrDiff_uType1 as $value) {
                        Class_db::getInstance()->db_insert('user_type', array('user_id'=>$user_id, 'uType_id'=>$value));
                        $arr_wfTaskType_id1 = Class_db::getInstance()->db_select_colm('wf_task_type', array('uType_id'=>$value, 'wfGroup_id'=>'is NULL'), 'wfTaskType_id');
                        if (!empty($arr_wfTaskType_id1)) {
                            foreach ($arr_wfTaskType_id1 as $wfTaskType_id) {
                                Class_db::getInstance()->db_insert('wf_task_user', array('user_id'=>$user_id, 'wfTaskType_id'=>$wfTaskType_id, 'wfGroup_id'=>$wfGroup_id_main));
                            }
                        }
                        $arr_wfTaskType = Class_db::getInstance()->db_select('wf_task_type', array('uType_id'=>$value, 'wfGroup_id'=>'('.  implode(',', $arrPost_groupUser).')'));
                        foreach($arr_wfTaskType as $wfTaskType) {
                            Class_db::getInstance()->db_insert('wf_task_user', array('user_id'=>$user_id, 'wfTaskType_id'=>$wfTaskType['wfTaskType_id'], 'wfGroup_id'=>$wfTaskType['wfGroup_id']));
                        }
                    }
                    $arrDiff_uType2 = array_diff($arr_uType, $arrPost_uType);
                    if (count($arrDiff_uType2) > 0) {
                        foreach($arrDiff_uType2 as $value) {
                            $arr_wfTaskType_id2 = Class_db::getInstance()->db_select_colm('wf_task_type', array('uType_id'=>$value), 'wfTaskType_id');
                            if (!empty($arr_wfTaskType_id2)) {
                                Class_db::getInstance()->db_delete('wf_task_user', array('user_id'=>$user_id, 'wfTaskType_id'=>'('.implode($arr_wfTaskType_id2,',').')'));
                            }
                        }
                        Class_db::getInstance()->db_delete('user_type', array('user_id'=>$user_id, 'uType_id'=>'('.  implode(',', $arrDiff_uType2).')'));
                    }
                }          
                $fn_task->save_audit(7, $_POST['mus_profile_name']);
            } else {
                $fn_task->save_audit(3);
            }
            if ($user['user_password'] != md5($_POST['mus_user_password'])) {
                $fn_email->insert_emailSend(2, $_POST['mus_user_id']);
                if ($_POST['funct'] == 'update_profile')
                    $fn_task->save_audit(4);
            }
            //throw new Exception('(ErrCode:6513) [' . __LINE__ . '] - Out.', 32);        
            $result = '1';
        } else if ($_POST['funct'] == 'update_status_ref') {
            if (empty($_POST['param']))             throw new Exception('(ErrCode:6500) [' . __LINE__ . '] - Parameter param empty');
            $arrayParam = $_POST['param'];
            if (empty($arrayParam['tablename']))    throw new Exception('(ErrCode:6517) [' . __LINE__ . '] - Parameter tablename empty.');
            else if (empty($arrayParam['prefix']))  throw new Exception('(ErrCode:6518) [' . __LINE__ . '] - Parameter prefix empty.');
            else if (empty($arrayParam['ref_id']))  throw new Exception('(ErrCode:6514) [' . __LINE__ . '] - Parameter ref_id empty.');
            Class_db::getInstance()->db_update($arrayParam['tablename'], array($arrayParam['prefix'].'_status'=>$arrayParam['status']), array($arrayParam['prefix'].'_id'=>$arrayParam['ref_id']));
            $result = '1';
        } else if ($_POST['funct'] == 'update_email_noti') {
            if (empty($_POST['mmc_emailType_id']))          throw new Exception('(ErrCode:6538) [' . __LINE__ . '] - Parameter emailType_id empty.');
            if (empty($_POST['mmc_emailType_title']))       throw new Exception('(ErrCode:6539) [' . __LINE__ . '] - Field Email Title empty.', 32);
            if (empty($_POST['mmc_emailType_text']))        throw new Exception('(ErrCode:6539) [' . __LINE__ . '] - Field Email Text empty.', 32);
            $email_type = Class_db::getInstance()->db_select_single('email_type', array('emailType_id'=>$_POST['mmc_emailType_id']), NULL, 1);
            $result = Class_db::getInstance()->db_update('email_type', array('emailType_title'=>$_POST['mmc_emailType_title'], 'emailType_text'=>$_POST['mmc_emailType_text'], 'emailType_status'=>$_POST['mmc_emailType_status']), array('emailType_id'=>$_POST['mmc_emailType_id']));
            $fn_task->save_audit (30, 'Email Type - '.$email_type['emailType_desc']);
            if ($_POST['mmc_emailType_status'] != $email_type['emailType_status']) {
                $fn_task->save_audit(($_POST['mmc_emailType_status']=='1'?31:32), 'Email Type - '.$email_type['emailType_desc']);
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
