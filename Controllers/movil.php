<?php 
include 'includes/Mobile_Detect.php';
$detect = new Mobile_Detect();

if ($detect->isMobile()) {
    header("HTTP/1.1 301 Moved Permanently");
   	header('Location: '.$fullPath.'index');
} else {
	header("HTTP/1.1 301 Moved Permanently");
   	header('Location: https://www.facebook.com/spartanracemexico/app/1038774129563596/');
}

?>