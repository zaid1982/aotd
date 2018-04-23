<?php

//require_once 'f_task.php';

class Class_email {     // 17++
    
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
    
    private function log_debug_scheduler($function, $line, $msg) {
        $debugMsg = date("Y/m/d h:i:sa")." [".__CLASS__.":".$function.":".$line."] - ".$msg."\r\n";
        error_log($debugMsg, 3, $this->log_dir.'/scheduler/debug_'.date("Ymd").'.log');
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
            
    public function insert_emailSend ($emailType_id, $emailSend_user='', $arr_textParam=array(), $emailSend_email='', $timeSet='') {
        try {            
            if (empty($emailType_id))       throw new Exception('(ErrCode:1702) [' . __LINE__ . '] - Parameter emailType_id empty.');
            if (empty($emailSend_user))     throw new Exception('(ErrCode:1703) [' . __LINE__ . '] - Parameter emailSend_user empty.');
            if (empty($timeSet))
                $timeSet = 'Now()';
            $email_type = Class_db::getInstance()->db_select_single('email_type', array('emailType_id'=>$emailType_id), NULL, 1);
            $emailSend_title = $email_type['emailType_title'];
            $emailSend_text = $email_type['emailType_text'];
            if (!empty($arr_textParam)){
                foreach ($arr_textParam as $item => $value) {
                    if (strpos($emailSend_title,"[".$item."]") !== false)
                        $emailSend_title = str_replace ("[".$item."]", $value, $emailSend_title);
                    if (strpos($emailSend_text,"[".$item."]") !== false)
                        $emailSend_text = str_replace ("[".$item."]", $value, $emailSend_text);
                }
            }
            $user_profile = Class_db::getInstance()->db_select_single('profile', array('user_id'=>$emailSend_user, 'profile_status'=>'1'), 'profile_email', NULL, 1);
            $emailSend_text = str_replace ("[receiver_name]", $user_profile['profile_name'], $emailSend_text);
            if (empty($emailSend_email)) {
                $emailSend_email = $user_profile['profile_email'];
            }
            return Class_db::getInstance()->db_insert('email_send', array('emailType_id'=>$emailType_id, 'emailSend_email'=>$emailSend_email, 'emailSend_user'=>$emailSend_user, 'emailSend_timeSet'=>$timeSet,
                'emailSend_title'=>$emailSend_title, 'emailSend_text'=>$emailSend_text));
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1701', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function send_email() {
        try {            
            $config = parse_ini_file('../library/config.ini');
            $result = 0;
            $headers = "From: ".$config['email_from']."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
            $email_header = "<html><body>";
            $email_footer = $config['email_footer']."</html></body>";
            
            $arr_email_send = Class_db::getInstance()->db_select('email_send', array('emailSend_timeSet'<='<Now()'), 'emailSend_id', $config['email_countPerSend']);
            foreach ($arr_email_send as $email_send) {
                $error_message = '';
                $email_status = 1;
                $this->log_debug_scheduler (__FUNCTION__, __LINE__, 'Receiver : '.$email_send['emailSend_email']);
                $this->log_debug_scheduler (__FUNCTION__, __LINE__, 'Title : '.$email_send['emailSend_title']);
                $this->log_debug_scheduler (__FUNCTION__, __LINE__, 'Message : '.$email_send['emailSend_text']);
                try {    
                    $message = $email_header.$email_send['emailSend_text'].$email_footer;       
                    $success = mail($email_send['emailSend_email'], $email_send['emailSend_title'], $message, $headers);
                    if (!$success) {
                        $error_message = error_get_last()['message'];
                        $email_status = 6;  // fail
                    }   
                }                
                catch(Exception $e_2) {
                    $error_message = $e_2->getMessage();
                    $this->log_debug_scheduler (__FUNCTION__, __LINE__, 'Error message : '.$error_message);
                    $email_status = 6;
                }
                $this->log_debug_scheduler (__FUNCTION__, __LINE__, 'Result : '.$email_status);
                Class_db::getInstance()->db_insert('email_log', array('emailSend_id'=>$email_send['emailSend_id'], 'emailType_id'=>$email_send['emailType_id'], 'emailSend_email'=>$email_send['emailSend_email'], 'emailSend_user'=>$email_send['emailSend_user'],
                    'emailSend_title'=>$email_send['emailSend_title'], 'emailSend_text'=>$email_send['emailSend_text'], 'emailSend_timeCreated'=>$email_send['emailSend_timeCreated'], 'emailSend_timeSet'=>$email_send['emailSend_timeSet'], 'emailSend_retry'=>$email_send['emailSend_retry'],
                    'emailLog_error'=>$error_message, 'emailLog_status'=>$email_status));
                Class_db::getInstance()->db_delete('email_send', array('emailSend_id'=>$email_send['emailSend_id']));
            }
            return $result;
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1701', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
    public function send_email_activation($pic, $name, $user_name, $user_password, $activationKey) {
        try {     
            $headers = "From: helpdesk@rania.com.my\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
            $to = $pic; 
            $subject = "JAS iRemote System - Account Activation.";
            $message = "<html><body>";
            $message .= "<p>Dear ".$name.",</p>";
            $message .= "<p>In order to prevent unauthorized sign-up, please click link to activate your account.</p>";
            $message .= "<p><a href=\"http://iremote.rania.com.my/login.php?activationCode=".$activationKey."\">http://iremote.rania.com.my/login.php?activationCode=".$activationKey."</a></p>"; 
            $message .= "<p>If you experience problems with the provided link, simply copy and paste the link below into the address field within your browser.</p>";
            $message .= "<p>Your Username / IC Number is <strong>".$user_name."</strong></p>";
            $message .= "<p>Your Password is <strong>".$user_password."</strong></p>";
            $message .= "<br><br><br>";
            $message .= "<i>Note: This is and automail from iRemote System. Please do not reply to the email.</i>";
            $message .= "</html></body>";
            $this->log_debug(__FUNCTION__, __LINE__, $message);
            mail($to, $subject, $message, $headers);
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1701', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
        
    public function send_email_user_creation($pic, $name, $user_name, $user_password, $roles) {
        try {     
            $headers = "From: helpdesk@rania.com.my\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
            $to = $pic; 
            $subject = "JAS iRemote System - Appointment as System User.";
            $message = "<html><body>";
            $message .= "<p>Dear ".$name.",</p>";
            $message .= "<p>You have been appointed as system user.</p>";            
            $message .= "<p>Kindly login to iRemote System - <a href=\"http://iremote.rania.com.my\">http://iremote.rania.com.my</a> as stated below.</p>";
            $message .= "<p>User Id : <strong>".$user_name."</strong><br>";
            $message .= "Password : <strong>".$user_password."</strong><br>";
            $message .= "Role : <strong>".$roles."</strong></p>";
            $message .= "<br><br><br>";
            $message .= "<i>Note: This is and automail from iRemote System. Please do not reply to the email.</i>";
            $message .= "</html></body>";
            $this->log_debug(__FUNCTION__, __LINE__, $message);
            mail($to, $subject, $message, $headers);
        }
        catch(Exception $e) {
            error_log(date("Y/m/d h:i:sa")." [".__FILE__.":".__LINE__."] - ".$e->getMessage()."\r\n", 3, $this->log_dir.'/error/error_'.date("Ymd").'.log');
            throw new Exception($this->get_exception('1701', __FUNCTION__, __LINE__, $e->getMessage()), $e->getCode());
        }
    }
    
}

?>
