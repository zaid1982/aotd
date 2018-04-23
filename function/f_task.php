<?php

class Class_task {
     
    public $submission_flag = '';
    private $log_dir = '';
    
    function __construct()
    {
        $config = parse_ini_file('../library/config.ini');
        $this->log_dir = $config['log_dir'];
    }
    
    private function get_exception($codes, $function, $line, $msg) {
        if ($msg != '') {            
            $pos = strpos($msg,'-');
            if ($pos !== false)   
                $msg = substr($msg, $pos+2); 
            return "(ErrCode:".$codes.") [".__CLASS__.":".$function.":".$line."] - ".$msg;
        } else
            return "(ErrCode:".$codes.") [".__CLASS__.":".$function.":".$line."]";
    }
    
    private function log_debug($function, $line, $msg) {
        $debugMsg = date("Y/m/d h:i:sa")." [".__CLASS__.":".$function.":".$line."] - ".$msg."\r\n";
        error_log($debugMsg, 3, $this->log_dir.'/debug/debug_'.date("Ymd").'.log');
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) 
            return $this->$property;
        else
            throw new Exception($this->get_exception('0001', __FUNCTION__, __LINE__, 'Get Property not exist ['.$property.']'));
    }

    public function __set( $property, $value ) {
        if (property_exists($this, $property)) 
            $this->$property = $value;        
        else
            throw new Exception($this->get_exception('0002', __FUNCTION__, __LINE__, 'Get Property not exist ['.$property.']'));
    }
    
    public function __isset( $property ) {
        if (property_exists($this, $property)) 
            return isset($this->$property);
        else
            throw new Exception($this->get_exception('0003', __FUNCTION__, __LINE__, 'Get Property not exist ['.$property.']'));
    }
    
    public function __unset( $property ) {
        if (property_exists($this, $property)) 
            unset($this->$property);
        else
            throw new Exception($this->get_exception('0004', __FUNCTION__, __LINE__, 'Get Property not exist ['.$property.']'));
    }
    
     public function task_claim ($user_id, $wfTask_id) {
        try {
            return Class_db::getInstance()->db_update('wf_task', array('wfTask_claimedBy'=>$user_id, 'wftask_timeClaimed'=>'Now()'), array('wfTask_id'=>$wfTask_id));
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
            
    public function task_unclaim ($wfTask_id) {
        try {
            return Class_db::getInstance()->db_update('wf_task', array('wfTask_claimedBy'=>'NULL', 'wftask_timeClaimed'=>'NULL'), array('wfTask_id'=>$wfTask_id));
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function save_log ($user_id, $wfTask_id, $activity_text, $document_id=NULL) {
        try {
            $wfGroup_id =  Class_db::getInstance()->db_select_col('wf_task', array('wfTask_id'=>$wfTask_id), 'wfGroup_id');
            $columns = array('user_id'=>$user_id, 'wfTask_id'=>$wfTask_id, 'activity_text'=>$activity_text);
            if ($document_id != NULL && $document_id != '')
                $columns['document_id'] = $document_id;
            if ($wfGroup_id != '')
                $columns['wfGroup_id'] = $wfGroup_id;
            return Class_db::getInstance()->db_insert('activity_log', $columns);
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }       
    
    public function get_running_no ($wfFlow_id='') {
        try {
            $run_no_new = '';
            $run_turn = '0';
            if ($wfFlow_id != '') {
                $wfFlow_code = Class_db::getInstance()->db_select_col('wf_flow', array('wfFlow_id'=>$wfFlow_id), 'wfFlow_code', NULL, 1);
                $rows = Class_db::getInstance()->db_select_single('wf_transaction', array('wfFlow_id'=>$wfFlow_id), 'wfTrans_no desc');
                if (empty($rows)) {
                    $run_no_new = 'D'.$wfFlow_code.'/'.substr(date('Ym'),2).'/00001';
                } else {
                    $run_no = $rows['wfTrans_no'];
                    $run_turn = substr(intVal(substr($run_no, -5))+100001,1); 
                    $run_no_new = 'D'.$wfFlow_code.'/'.substr(date('Ym'),2).'/'.$run_turn;
                }
            } else
                throw new Exception('(ErrCode:1309) ['.__LINE__.'] - Get running no parameter $wfFlow_id not valid.');
            return $run_no_new;
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function get_registration_no ($wfTask_id='') {   // CPM/169843-1/17/03/01        
        try {
            $reg_no_new = '';
            $reg_company = '';
            if ($wfTask_id == '') 
                throw new Exception('(ErrCode:1310) ['.__LINE__.'] - Function get_registration_no parameter $wfTask_id empty.');
            $wf_task = Class_db::getInstance()->db_select_single('wf_task', array('wfTask_id'=>$wfTask_id), NULL, 1);
            $wf_task_type = Class_db::getInstance()->db_select_single('wf_task_type', array('wfTaskType_id'=>$wf_task['wfTaskType_id']), NULL, 1);
            $wfFlow_code = Class_db::getInstance()->db_select_col('wf_flow', array('wfFlow_id'=>$wf_task_type['wfFlow_id']), 'wfFlow_code', NULL, 1);
            if (in_array($wf_task_type['wfFlow_id'], array('1', '2', '3'))) {
                $reg_company = Class_db::getInstance()->db_select_col('vw_wfGroup_consultant', array('wfTrans_id'=>$wf_task['wfTrans_id']), 'wfGroup_regNo', NULL, 1);
            } else if (in_array($wf_task_type['wfFlow_id'], array('4', '5'))) {
                $industrial_id = Class_db::getInstance()->db_select_col('t_industrial_all', array('wfTrans_id'=>$wf_task['wfTrans_id']), 'industrial_id', NULL, 1);
                $reg_company = Class_db::getInstance()->db_select_col('t_industrial', array('industrial_id'=>$industrial_id), 'industrial_premiseId', NULL, 1);
            }  
            $reg_no_syntax = $wfFlow_code.'/'.$reg_company.'/'.substr(date('Y'),2).'/'.substr(date('Ym'),2).'/';
            $rows = Class_db::getInstance()->db_select_single('wf_transaction', array('wfFlow_id'=>$wf_task_type['wfFlow_id'], 'wfTrans_regNo'=>'%'.$reg_no_syntax.'%'), 'wfTrans_regNo desc');
            if (empty($rows)) {
                $reg_no_new = $reg_no_syntax.'01';
            } else {
                $run_no = $rows['wfTrans_regNo'];
                $reg_turn = substr(intVal(substr($run_no, -2))+101,1); 
                $reg_no_new = $reg_no_syntax.$reg_turn;
            }
            return $reg_no_new;
        } 
        catch (Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function task_create ($user_id, $wfFlow_id, $wfGroup_id, $wfTaskType_id, $client_id = '') {
        try {
            $wfTrans_no = $this->get_running_no($wfFlow_id);
            $columns = array('wfFlow_id'=>$wfFlow_id, 'wfTrans_no'=>$wfTrans_no, 'wfTrans_createdByGr'=>$wfGroup_id, 'wfTrans_createdBy'=>$user_id, 'wfTrans_status'=>'2', 'client_id'=>$client_id);
            $wfTrans_id = Class_db::getInstance()->db_insert('wf_transaction', $columns);            
            $columns = array('wfTrans_id'=>$wfTrans_id, 'wfTaskType_id'=>$wfTaskType_id, 'wfGroup_id'=>$wfGroup_id, 'wfTask_createdByGr'=>$wfGroup_id, 'wfTask_createdBy'=>$user_id, 
                'wfTask_claimedBy'=>$user_id, 'wfTask_timeClaimed'=>'Now()', 'wfTask_status'=>'2');
            return Class_db::getInstance()->db_insert('wf_task', $columns);
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    private function process_submit ($wfTask_id, $wfTrans_id, $wfTaskType_id, $status, $user_id, $wfFlow_id, $next_taskType, $wfTask_refValue) {
        try {
            $this->log_debug(__FUNCTION__, __LINE__, "entering process_submit()");
            if ($wfTaskType_id == '1') {
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4', 'wfTrans_timeSubmit'=>'Now()'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('ats_sample_log', array('atsCert_status'=>'4', 'atsCert_timeReceived'=>'Now()'), array('atsCert_id'=>$wfTask_refValue));
                $atsCert_no = Class_db::getInstance()->db_select_col('ats_sample_log', array('atsCert_id'=>$wfTask_refValue), 'atsCert_no', NULL, 1);
                $this->save_audit(112, $atsCert_no);
            } else if ($wfTaskType_id == '11') {
                $arr_bdt_days = array(0, 4, 8, 12, 16, 20, 24);
                $arr_bdt_test = Class_db::getInstance()->db_select('bdt_test', array('bdtTest_status'=>'1'), 'bdtTest_id', NULL, 1);
                $arr_bdt_sample = Class_db::getInstance()->db_select('bdt_sample_info', array('bdtRep_no'=>$wfTask_refValue), 'bdtLab_code', NULL, 1);
                foreach ($arr_bdt_sample as $bdt_sample) { 
                    Class_db::getInstance()->db_update('bdt_sample_info', array('bdtLab_bottle1'=>'Blank (inoculum)', 'bdtLab_bottle2'=>'Reference substance + inoculum', 'bdtLab_bottle3'=>$bdt_sample['bdtLab_sampleCode'].' + inoculum', 'bdtLab_bottle4'=>'Reference substance + '.$bdt_sample['bdtLab_sampleCode'].' + inoculum'), 
                        array('bdtLab_code'=>$bdt_sample['bdtLab_code']));
                    foreach ($arr_bdt_test as $bdt_test) {
                        foreach ($arr_bdt_days as $bdt_days) {
                            for ($bdt_bottle=1; $bdt_bottle<=4; $bdt_bottle++) {
                                Class_db::getInstance()->db_insert('bdt_test_res', array('bdtLab_code'=>$bdt_sample['bdtLab_code'], 'bdtTest_id'=>$bdt_test['bdtTest_id'], 'bdtRes_day'=>strval($bdt_days), 'bdtRes_bottle'=>$bdt_bottle));
                            }
                        }
                    }
                    for ($bdt_bottle=2; $bdt_bottle<=4; $bdt_bottle++) {
                        foreach ($arr_bdt_days as $bdt_days) {
                            Class_db::getInstance()->db_insert('bdt_biod', array('bdtLab_code'=>$bdt_sample['bdtLab_code'], 'bdtBiod_day'=>strval($bdt_days), 'bdtBiod_bottle'=>$bdt_bottle, 'bdtBiod_biod'=>'0'));
                        }
                    }
                }
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4', 'wfTrans_timeSubmit'=>'Now()'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('bdt_sample_log', array('bdtRep_status'=>'4', 'bdtRep_timeReceived'=>'Now()'), array('bdtRep_no'=>$wfTask_refValue));
            } else if ($wfTaskType_id == '21') {
                $arr_ect_test = Class_db::getInstance()->db_select('ect_test', array('ectTest_status'=>'1'), 'ectTest_id', NULL, 1);
                $arr_ect_sample = Class_db::getInstance()->db_select('ect_sample_info', array('ectRep_no'=>$wfTask_refValue), 'ectLab_code', NULL, 1);
                foreach ($arr_ect_sample as $ect_sample) { 
                    foreach ($arr_ect_test as $ect_test) {
                        $ectTotal_day = $ect_test['ectTest_id'] == '2' ? 5 : 2;
                        for ($ectRes_day=0; $ectRes_day<$ectTotal_day; $ectRes_day++) {
                            for ($ectRes_tank=1; $ectRes_tank<=10; $ectRes_tank++) {
                                Class_db::getInstance()->db_insert('ect_test_res', array('ectLab_code'=>$ect_sample['ectLab_code'], 'ectRes_day'=>$ectRes_day, 'ectTest_id'=>$ect_test['ectTest_id'], 'ectRes_tank'=>$ectRes_tank));
                            }
                        }
                    }
                }
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4', 'wfTrans_timeSubmit'=>'Now()'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('ect_sample_log', array('ectRep_status'=>'4', 'ectRep_timeReceived'=>'Now()'), array('ectRep_no'=>$wfTask_refValue));
            } else if ($wfTaskType_id == '31') {
                $phyTest_id = Class_db::getInstance()->db_select_col('phy_sample_log', array('phyRep_no'=>$wfTask_refValue), 'phyTest_id', NULL, 1);
                $arr_phy_field = Class_db::getInstance()->db_select('phy_field', array('phyTest_id'=>$phyTest_id, 'phyField_status'=>'1'), 'phyField_id', NULL, 1);
                $arr_phy_sample = Class_db::getInstance()->db_select('phy_sample_info', array('phyRep_no'=>$wfTask_refValue), 'phyLab_code', NULL, 1);
                foreach ($arr_phy_sample as $phy_sample) { 
                    foreach ($arr_phy_field as $phy_field) {
                        Class_db::getInstance()->db_insert('phy_test_res', array('phyLab_code'=>$phy_sample['phyLab_code'], 'phyField_id'=>$phy_field['phyField_id']));
                    }
                }
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4', 'wfTrans_timeSubmit'=>'Now()'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('phy_sample_log', array('phyRep_status'=>'4', 'phyRep_timeReceived'=>'Now()', 'phyRep_timeStarted'=>'Now()'), array('phyRep_no'=>$wfTask_refValue));
                $this->save_audit(212, $wfTask_refValue);
            } else if ($wfTaskType_id == '41') {
                $effTest_id = Class_db::getInstance()->db_select_col('eff_sample_log', array('effRep_no'=>$wfTask_refValue), 'effTest_id', NULL, 1);
                $arr_eff_field = Class_db::getInstance()->db_select('eff_field', array('effTest_id'=>$effTest_id, 'effField_status'=>'1'), 'effField_id', NULL, 1);
                $arr_eff_sample = Class_db::getInstance()->db_select('eff_sample_info', array('effRep_no'=>$wfTask_refValue), 'effLab_code', NULL, 1);
                foreach ($arr_eff_sample as $eff_sample) { 
                    foreach ($arr_eff_field as $eff_field) {
                        Class_db::getInstance()->db_insert('eff_test_res', array('effLab_code'=>$eff_sample['effLab_code'], 'effField_id'=>$eff_field['effField_id']));
                    }
                }
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'51', 'wfTrans_timeSubmit'=>'Now()'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('eff_sample_log', array('effRep_status'=>'51', 'effRep_timeReceived'=>'Now()'), array('effRep_no'=>$wfTask_refValue));
                $this->save_audit(312, $wfTask_refValue);
            } else if ($wfTaskType_id == '42') {
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('eff_sample_log', array('effRep_status'=>'4'), array('effRep_no'=>$wfTask_refValue));
                $this->save_audit(329, $wfTask_refValue);
            } else if ($wfTaskType_id == '2') {
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'48'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('ats_sample_log', array('atsCert_status'=>'48', 'atsCert_analyst'=>$user_id), array('atsCert_id'=>$wfTask_refValue));
                $atsCert_no = Class_db::getInstance()->db_select_col('ats_sample_log', array('atsCert_id'=>$wfTask_refValue), 'atsCert_no', NULL, 1);
                if ($status == '13') {
                    $this->submission_flag = '21';
                    $this->save_audit(120, $atsCert_no);
                } else {
                    $this->save_audit(121, $atsCert_no);
                }
            } else if ($wfTaskType_id == '32') {
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'48'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('phy_sample_log', array('phyRep_status'=>'48', 'phyRep_analyst'=>$user_id, 'phyRep_timeCompleted'=>'Now()'), array('phyRep_no'=>$wfTask_refValue));
                if ($status == '13') {
                    $this->submission_flag = '21';
                    $this->save_audit(220, $wfTask_refValue);
                } else {
                    $this->save_audit(221, $wfTask_refValue);
                }
            } else if ($wfTaskType_id == '43') {
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'48'), array('wfTrans_id'=>$wfTrans_id));
                Class_db::getInstance()->db_update('eff_sample_log', array('effRep_status'=>'48', 'effRep_analyst'=>$user_id, 'effRep_timeCompleted'=>'Now()'), array('effRep_no'=>$wfTask_refValue));
                if ($status == '13') {
                    $this->submission_flag = '21';
                    $this->save_audit(320, $wfTask_refValue);
                } else {
                    $this->save_audit(321, $wfTask_refValue);
                }
            } else if ($wfTaskType_id == '3') {
                $atsCert_no = Class_db::getInstance()->db_select_col('ats_sample_log', array('atsCert_id'=>$wfTask_refValue), 'atsCert_no', NULL, 1);
                if ($status == '12') {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('ats_sample_log', array('atsCert_status'=>'4'), array('atsCert_id'=>$wfTask_refValue));
                    $this->submission_flag = '22';
                    $this->save_audit(123, $atsCert_no);
                } else {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'49'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('ats_sample_log', array('atsCert_status'=>'49'), array('atsCert_id'=>$wfTask_refValue));
                    if ($status == '13') {
                        $this->submission_flag = '21';
                        $this->save_audit(125, $atsCert_no);
                    } else {
                        $this->save_audit(124, $atsCert_no);
                    }             
                }
            } else if ($wfTaskType_id == '33') {
                if ($status == '12') {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('phy_sample_log', array('phyRep_status'=>'4'), array('phyRep_no'=>$wfTask_refValue));
                    $this->submission_flag = '22';
                    $this->save_audit(223, $wfTask_refValue);
                } else {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'49'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('phy_sample_log', array('phyRep_status'=>'49'), array('phyRep_no'=>$wfTask_refValue));
                    if ($status == '13') {
                        $this->submission_flag = '21';
                        $this->save_audit(225, $wfTask_refValue);
                    } else {
                        $this->save_audit(224, $wfTask_refValue);
                    }
                }
            } else if ($wfTaskType_id == '44') {
                if ($status == '12') {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'4'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('eff_sample_log', array('effRep_status'=>'4'), array('effRep_no'=>$wfTask_refValue));
                    $this->submission_flag = '22';
                    $this->save_audit(323, $wfTask_refValue);
                } else {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'49'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('eff_sample_log', array('effRep_status'=>'49'), array('effRep_no'=>$wfTask_refValue));
                    if ($status == '13') {
                        $this->submission_flag = '21';
                        $this->save_audit(325, $wfTask_refValue);
                    } else {
                        $this->save_audit(324, $wfTask_refValue);
                    }                
                }
            } else if ($wfTaskType_id == '4') {
                $atsCert_no = Class_db::getInstance()->db_select_col('ats_sample_log', array('atsCert_id'=>$wfTask_refValue), 'atsCert_no', NULL, 1);
                if ($status == '12') {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'48'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('ats_sample_log', array('atsCert_status'=>'48'), array('atsCert_id'=>$wfTask_refValue));
                    $this->submission_flag = '22';
                    $this->save_audit(126, $atsCert_no);
                } else {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'42'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('ats_sample_log', array('atsCert_status'=>'42', 'atsCert_timeReported'=>'Now()'), array('atsCert_id'=>$wfTask_refValue));
                    if ($status == '13') {
                        $this->submission_flag = '21';
                        $this->save_audit(128, $atsCert_no);
                    } else {
                        $this->save_audit(127, $atsCert_no);
                    }                
                }
            } else if ($wfTaskType_id == '34') {
                if ($status == '12') {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'48'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('phy_sample_log', array('phyRep_status'=>'48'), array('phyRep_no'=>$wfTask_refValue));
                    $this->submission_flag = '22';
                    $this->save_audit(226, $wfTask_refValue);
                } else {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'42'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('phy_sample_log', array('phyRep_status'=>'42'), array('phyRep_no'=>$wfTask_refValue));
                    if ($status == '13') {
                        $this->submission_flag = '21';
                        $this->save_audit(228, $wfTask_refValue);
                    } else {
                        $this->save_audit(227, $wfTask_refValue);
                    }                     
                }
            } else if ($wfTaskType_id == '45') {
                if ($status == '12') {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'48'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('eff_sample_log', array('effRep_status'=>'48'), array('effRep_no'=>$wfTask_refValue));
                    $this->submission_flag = '22';
                    $this->save_audit(326, $wfTask_refValue);
                } else {
                    Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_status'=>'42'), array('wfTrans_id'=>$wfTrans_id));
                    Class_db::getInstance()->db_update('eff_sample_log', array('effRep_status'=>'42'), array('effRep_no'=>$wfTask_refValue));
                    if ($status == '13') {
                        $this->submission_flag = '21';
                        $this->save_audit(328, $wfTask_refValue);
                    } else {
                        $this->save_audit(327, $wfTask_refValue);
                    }                      
                }
            }
            return '';
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function task_submit ($user_id, $wfTask_id, $wfTaskType_id='', $status='10', $remarks='', $condition_no='', $assignedGroup=NULL, $jumpTaskType_id=NULL, $assignedUser=NULL, $wfTask_refName='', $wfTask_refValue='') {
        try {
            $this->log_debug(__FUNCTION__, __LINE__, "entering task_submit()");
            $this->submission_flag = '';
                        
            // checking task current status, claimed by this user
            $status = $status == '' ? '10' : $status;
            if ($user_id == '' || $wfTask_id == '')
                throw new Exception('(ErrCode:1302) ['.__LINE__.'] - Parameter empty.');
            $current_task = Class_db::getInstance()->db_select_single('wf_task', array('wfTask_id'=>$wfTask_id, 'wfTask_claimedBy'=>$user_id), NULL, 1);
            if ($wfTaskType_id != $current_task['wfTaskType_id'])
                throw new Exception('(ErrCode:1312) ['.__LINE__.'] - Parameter $wfTaskType_id does not match with wfTask_id.');
            $next_taskType_id = '';
            $current_taskType = Class_db::getInstance()->db_select_single('wf_task_type', array('wfTaskType_id'=>$wfTaskType_id), NULL, 1);
              
            if ($current_taskType['wfTaskCate_id'] == '5')
                throw new Exception('(ErrCode:1308) ['.__LINE__.'] - Cannot allow submission, submission trigger by cron by due date.');
            
            if ($jumpTaskType_id != NULL) {
                $check_taskType = Class_db::getInstance()->db_select_single('wf_task_type', array('wfTaskType_id'=>$jumpTaskType_id), NULL, 1);
                $next_taskType_id = $jumpTaskType_id;
            } else if ($current_taskType['wfTaskCate_id'] == '8') {
                if ($status == '52') {
                    $next_taskType_id = $wfTaskType_id;
                    $this->submission_flag = '53';
                }
            } else {                
                $next_taskType_id = $current_taskType['wfTaskType_next'];
                if ($next_taskType_id == '')
                    throw new Exception('(ErrCode:1303) ['.__LINE__.'] - Next task unavailable.');
                else if ($condition_no != '') {
                    if ($condition_no == '1' || $condition_no == '2' || $condition_no == '3') {
                        if ($current_taskType['wfTaskType_condition'.$condition_no] == '')
                            throw new Exception('(ErrCode:1304) ['.__LINE__.'] - Condition No taskType_id unavailable.');
                        $next_taskType_id = $current_taskType['wfTaskType_condition'.$condition_no];
                    } else
                        throw new Exception('(ErrCode:1305) ['.__LINE__.'] - Condition No format error.');
                }           
            }
            $next_taskType = Class_db::getInstance()->db_select_single('wf_task_type', array('wfTaskType_id'=>$next_taskType_id), NULL, 1);            
            
            $process_submit = $this->process_submit($wfTask_id, $current_task['wfTrans_id'], $wfTaskType_id, $status, $user_id, $current_taskType['wfFlow_id'], $next_taskType, $wfTask_refValue);
            $wfTask_refValue = $process_submit != '' ? $process_submit : $wfTask_refValue;
            
            if ($next_taskType['wfTaskType_isEnd'] == 'Y') {    // end of process
                $setArr = array('wfTask_partition'=>'2', 'wfTask_status'=>$status, 'wfTask_timeSubmitted'=>'Now()', 'wfTask_remark'=>$remarks);
                Class_db::getInstance()->db_update('wf_task', $setArr, array('wfTask_id'=>$wfTask_id));                
                $trans_status = $this->submission_flag != '' ? $this->submission_flag : '9';
                $wf_transaction = Class_db::getInstance()->db_select_single('wf_transaction', array('wfTrans_id'=>$current_task['wfTrans_id']), NULL, 1);
                Class_db::getInstance()->db_update('wf_transaction', array('wfTrans_timeFinish'=>'Now()', 'wfTrans_status'=>$trans_status), array('wfTrans_id'=>$current_task['wfTrans_id']));  
                $end_status = $this->submission_flag != '' ? $this->submission_flag : '';
                $columns = array('wfTask_partition'=>'1', 'wfTask_status'=>$status, 'wfTask_timeSubmitted'=>'Now()' , 'wfTrans_id'=>$current_task['wfTrans_id'], 'wfTask_createdBy'=>$user_id, 'wfTask_createdByGr'=>$current_task['wfGroup_id'], 'wfTask_claimedBy'=>$wf_transaction['wfTrans_createdBy'],
                    'wfTaskType_id'=>$next_taskType_id, 'wfGroup_id'=>$wf_transaction['wfTrans_createdByGr'], 'wfTask_refName'=>$wfTask_refName, 'wfTask_refValue'=>$wfTask_refValue, 'wfTask_status'=>$end_status);
                $next_task_id = Class_db::getInstance()->db_insert('wf_task', $columns);
                Class_db::getInstance()->db_delete('wf_task_assign', array('wfTrans_id'=>$current_task['wfTrans_id']));
                return 'end';
            } else {
                if ($next_taskType['uType_id'] == '')
                    throw new Exception('(ErrCode:1306) ['.__LINE__.'] - Next Task uType_id empty.');
                $claimed_user = '';
                $next_wfGroup_id = '';
                if ($assignedGroup != '') {
                    // check and get taskType assigned to  
                    $arr_task_assign_where = Class_db::getInstance()->db_select('wf_task_assign_where', array('wfTaskType_From'=>$wfTaskType_id));
                    foreach ($arr_task_assign_where as $task_assign_where) {    
                        $where_user_id = '';
                        $where_wfGroup_id = '';
                        if ($task_assign_where['wfTaskAssignWhere_isUser'] == 'Y') {
                            $where_user_id = $user_id;
                            $where_wfGroup_id = $current_task['wfGroup_id'];
                        } else if ($task_assign_where['wfTaskAssignWhere_isUser'] == 'S') {
                            if ($current_taskType['wfTaskCate_id'] == '7') {
                                $where_user_id = $assignedUser;
                                $where_wfGroup_id = $assignedGroup;                                
                            } else 
                                throw new Exception('(ErrCode:1311) ['.__LINE__.'] - Current wfTaskCate_id not equal to 7.');
                        } else
                            $where_wfGroup_id = $assignedGroup;     
                        if (Class_db::getInstance()->db_count('wf_task_assign', array('wfTrans_id'=>$current_task['wfTrans_id'], 'wfTaskType_id'=>$task_assign_where['wfTaskType_To'], 'wfTaskAssign_from'=>$wfTask_id))==0) {
                            Class_db::getInstance()->db_insert('wf_task_assign', array('wfTrans_id'=>$current_task['wfTrans_id'], 'wfTaskAssign_from'=>$wfTask_id, 'wfTaskType_id'=>$task_assign_where['wfTaskType_To'], 'wfGroup_id'=>$where_wfGroup_id, 'user_id'=>$where_user_id));
                        } else {
                            Class_db::getInstance()->db_update('wf_task_assign', array('wfGroup_id'=>$where_wfGroup_id, 'user_id'=>$where_user_id), array('wfTrans_id'=>$current_task['wfTrans_id'], 'wfTaskAssign_from'=>$wfTask_id, 'wfTaskType_id'=>$task_assign_where['wfTaskType_To']));
                        }
                        if ($task_assign_where['wfTaskType_To'] == $next_taskType_id) {
                            $claimed_user = $where_user_id;
                            $next_wfGroup_id = $where_wfGroup_id;
                        }
                    }
                }                
                if ($next_taskType['wfTaskType_isAssigned'] == 'Y') {
                    if ($next_wfGroup_id == '') {
                        $columns = array('wfTrans_id'=>$current_task['wfTrans_id'], 'wfTaskType_id'=>$next_taskType_id);
                        $task_assign = Class_db::getInstance()->db_select_single('wf_task_assign', $columns, 'wfTaskAssign_id desc', 1);
                        $claimed_user = $task_assign['user_id'];
                        $next_wfGroup_id = $task_assign['wfGroup_id'];
                    }
                } else {
                    $claimed_user = '';
                    if ($next_wfGroup_id == '') {
                        $next_wfGroup_id = $next_taskType['wfGroup_id'] != '' ? $next_taskType['wfGroup_id'] : $assignedGroup;
                    }
                }
                $setArr = array('wfTask_partition'=>'2', 'wfTask_status'=>$status, 'wfTask_timeSubmitted'=>'Now()', 'wfTask_remark'=>$remarks);
                Class_db::getInstance()->db_update('wf_task', $setArr, array('wfTask_id'=>$wfTask_id));
                $columns = array('wfTrans_id'=>$current_task['wfTrans_id'], 'wfTask_createdBy'=>$user_id, 'wfTask_createdByGr'=>$current_task['wfGroup_id'], 'wfTask_refName'=>$wfTask_refName, 'wfTask_refValue'=>$wfTask_refValue,
                    'wfGroup_id'=>$next_wfGroup_id, 'wfTaskType_id'=>$next_taskType_id, 'wfTask_dateExpired'=>'|DATE_ADD(CURDATE(),INTERVAL '.$next_taskType['wfTaskType_duration'].' DAY)', 'wfTask_statusPrevious'=>$status);
                if ($claimed_user != '')    $columns['wfTask_claimedBy'] = $claimed_user;
                if ($this->submission_flag != '')   $columns['wfTask_status'] = $this->submission_flag;
                $next_task_id = Class_db::getInstance()->db_insert('wf_task', $columns);
                $this->process_after_submit($wfTask_id, $current_task['wfTrans_id'], $wfTaskType_id, $status, $current_taskType['wfFlow_id'], $next_taskType, $next_task_id);
                return $next_task_id;
            }
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    private function process_after_submit ($wfTask_id, $wfTrans_id, $wfTaskType_id, $status, $wfFlow_id, $next_taskType, $next_task_id) {
        try {
            $this->log_debug(__FUNCTION__, __LINE__, "entering process_after_submit()");
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
        
    public function task_validate ($user_id, $wfTask_id, $submit_type) {
        try {
            $error = 1;
            if ($user_id == '' || $wfTask_id == '' || $submit_type == '')
                throw new Exception('(ErrCode:1307) ['.__LINE__.'] - Parameter empty.');
            $wf_task = Class_db::getInstance()->db_select_single('wf_task', array('wfTask_id'=>$wfTask_id), NULL, 1);
            $wf_task_type = Class_db::getInstance()->db_select_single('wf_task_type', array('wfTaskType_id'=>$wf_task['wfTaskType_id']), NULL, 1);
            if ($wf_task_type['wfTaskType_turn'] == '1') {
                $error = 0;
            } else if (empty($wf_task['wfTask_timeClaimed']) && ($submit_type == 'submit' || $submit_type == 'batch_lulus')) {
                $isClaim = Class_db::getInstance()->db_select_col('wf_task_type', array('wfTaskType_id'=>$wf_task['wfTaskType_id']), 'wfTaskType_isClaim', NULL, 1);
                if ($isClaim == 'N' || $submit_type == 'batch_lulus') {
                    Class_db::getInstance()->db_update('wf_task', array('wfTask_claimedBy'=>$user_id, 'wfTask_timeClaimed'=>'Now()'), array('wfTask_id'=>$wfTask_id));
                    $error = 0;                        
                }   
            } else {
                $taskUser_exist = Class_db::getInstance()->db_count('wf_task_user', array('user_id'=>$user_id, 'wfGroup_id'=>$wf_task['wfGroup_id'], 'wfTaskType_id'=>$wf_task['wfTaskType_id']));
                if ($submit_type == 'claim') {
                    if ($taskUser_exist > 0 && $wf_task['wfTask_claimedBy'] == '' && $wf_task['wfTask_partition'] == '1') 
                        $error = 0;
                } else if ($submit_type == 'unclaim') {
                    if ($taskUser_exist > 0 && $wf_task['wfTask_claimedBy'] == $user_id && $wf_task['wfTask_partition'] == '1') 
                        $error = 0;
                } else if ($submit_type == 'submit' || $submit_type == 'batch_lulus') {
                    if ($taskUser_exist > 0 && $wf_task['wfTask_claimedBy'] == $user_id && $wf_task['wfTask_partition'] == '1') 
                        $error = 0;
                }
            }
            return $error;
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function send_email () {
        try {
            mail($to, $subject, $message);
        } 
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function insert_task_user ($uType_id, $user_id, $wfGroup_id='') {
        try {
            if ($wfGroup_id == '')
                throw new Exception('(ErrCode:1321) ['.__LINE__.'] - Parameter wfGroup_id empty.');
            $userType_id = Class_db::getInstance()->db_insert('user_type', array('user_id'=>$user_id, 'uType_id'=>$uType_id));
            $userGroup_id = Class_db::getInstance()->db_insert('wf_group_user', array('user_id'=>$user_id, 'wfGroup_id'=>$wfGroup_id));
            $arr_wf_taskType = Class_db::getInstance()->db_select('wf_task_type', array('uType_id'=>$uType_id));
            foreach ($arr_wf_taskType as $wf_taskType) {
                Class_db::getInstance()->db_insert('wf_task_user', array('user_id'=>$user_id, 'wfGroup_id'=>$wfGroup_id, 'wfTaskType_id'=>$wf_taskType['wfTaskType_id']));
            }
            return '1';
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function delete_task_user ($uType_id, $user_id, $wfGroup_id='') {
        try {
            if ($wfGroup_id == '')
                throw new Exception('(ErrCode:1321) ['.__LINE__.'] - Parameter wfGroup_id empty.');
            Class_db::getInstance()->db_delete('wf_group_user', array('user_id'=>$user_id, 'wfGroup_id'=>$wfGroup_id));
            $arr_wf_taskType = Class_db::getInstance()->db_select('wf_task_type', array('uType_id'=>$uType_id));
            foreach ($arr_wf_taskType as $wf_taskType) {
                Class_db::getInstance()->db_delete('wf_task_user', array('user_id'=>$user_id, 'wfGroup_id'=>$wfGroup_id, 'wfTaskType_id'=>$wf_taskType['wfTaskType_id']));
                // select wf_task, update then insert
                //$wf_task = Class_db::getInstance()->db_select('wf_task', array('wfTask_claimedBy'=>$user_id, 'wfTask_partition'=>'1', 'wfTaskType_id'=>$wf_taskType['wfTaskType_id']));
                Class_db::getInstance()->db_update('wf_task', array('wfTask_claimedBy'=>'NULL', 'wfTask_timeClaimed'=>'NULL'), array('wfTask_claimedBy'=>$user_id, 'wfTask_partition'=>'1', 'wfTaskType_id'=>$wf_taskType['wfTaskType_id']));
            }
            return '1';
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function convert_time_mysql ($dates, $times='') {
        try {
            if ($dates == '')
                return '';
            else if ($times == '')
                return substr($dates, 6, 4).'-'.substr($dates, 3, 2).'-'.substr($dates, 0, 2);
            $j = substr($times, 6, 2) == 'PM' ? 12 : 0;
            $times = strval(intval(substr($times, 0, 2))+$j).substr($times, 2, 3);
            return substr($dates, 6, 4).'-'.substr($dates, 3, 2).'-'.substr($dates, 0, 2).' '.$times;
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function save_audit($auditAction_id='0', $audit_transNo='') {
        try {
            $place = '';
            $ipaddress = '';
            $this->log_debug(__FUNCTION__, __LINE__, 'Audit Trail = '.$auditAction_id);
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
            if (!in_array($ipaddress, array('', 'UNKNOWN', '::1'), true)) {
                $details = json_decode(file_get_contents("http://ipinfo.io/$ipaddress/json"));
                $place = $ip.$details->city;
            }
            return Class_db::getInstance()->db_insert('audit', array('user_id'=>(isset($_SESSION['user_id'])?$_SESSION['user_id']:''), 'auditAction_id'=>$auditAction_id, 'audit_ip'=>$ipaddress, 'audit_place'=>$place, 'audit_transNo'=>$audit_transNo));
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1301', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
}

?>
