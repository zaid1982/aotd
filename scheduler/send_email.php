<?php

require_once '../library/db.php';
require_once '../function/f_email.php';

$config = parse_ini_file('../library/config.ini');
$log_dir = $config['log_dir'];

function log_debug($function, $line, $msg) {
    $debugMsg = date("Y/m/d h:i:sa")." [".__CLASS__.":".$function.":".$line."] - ".$msg."\r\n";
    error_log($debugMsg, 3, $log_dir.'/scheduler/debug_' . date("Ymd") . '.log');
}

try {    
    log_debug('send_email', __LINE__, 'Starting send_email cron...');
    Class_db::getInstance()->db_connect();            
    $fn_email = new Class_email();   
    $cnt_sending = $fn_email->send_email();
    log_debug('send_email', __LINE__, 'Sending total of '.$cnt_sending.' emails.');
    Class_db::getInstance()->db_close();
    log_debug('send_email', __LINE__, 'Finish send_email cron...');
} catch (Exception $e) {
    error_log(date("Y/m/d h:i:sa") . " [" . __FILE__ . ":" . __LINE__ . "] - " . $e->getMessage() . "\r\n", 3, $log_dir.'/error/error_' . date("Ymd") . '.log');
}
Class_db::getInstance()->db_close();
exit;

?>