<?php

$config = parse_ini_file('../library/config.ini');
$headers = "From: ".$config['email_from']."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
$email_header = "<html><body>";
$email_footer = $config['email_footer']."</html></body>";

$message = $email_header.'Test'.$email_footer;
$success = mail('hemppok.kembong@gmail.com', 'test', $message, $headers);
if (!$success) {
    $error_message = error_get_last()['message'];
    $email_status = 6;  // fail
    echo $error_message;
}
echo $success;
//function compress($source, $destination, $quality) {
//    $info = getimagesize($source);
//    if ($info['mime'] == 'image/jpeg') 
//        $image = imagecreatefromjpeg($source);
//    elseif ($info['mime'] == 'image/gif') 
//        $image = imagecreatefromgif($source);
//    elseif ($info['mime'] == 'image/png') 
//        $image = imagecreatefrompng($source);
//
//    imagejpeg($image, $destination, $quality);
//    return $destination;
//}
//
//$source_img = 'destination.jpg';
//$destination_img = 'destination4.jpg';
//
//$d = compress($source_img, $destination_img, 10);
?>