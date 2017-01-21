<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 02/11/2016
 * Time: 09:36
 */
require '../../../../PHPMailer/PHPMailerAutoload.php';
$mail= new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true;
$mail->SMTPSecure = "TLS ";
$mail->Host ="smtp.gmail.com";
$mail->Port= 587;
$mail->Username= 'ad.khodja@gmail.com';
$mail->Password='zarisbzarisb30sm';
$mail->From = "ad.khodja@gmail.com";
?>