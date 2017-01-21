<?php

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 09/11/2016
 * Time: 14:21
 */
class mail
{
    public function envoyer($email,$body,$subject,$FromName)
    {
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
        $mail->AddAddress($email, '');
        $mail->FromName= $FromName;
        $mail->Subject=$subject;
        $mail->WordWrap  = 50;
        $mail->IsHTML(true);
        $mail->MsgHTML($body);
        return $mail->Send();
    }
}



?>