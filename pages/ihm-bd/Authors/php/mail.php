<?php

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 13/11/2016
 * Time: 14:07
 */
class mail
{

    public function envoyer($email,$body,$subject,$FromName,$coautor)
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
        for($i=0;$i<count($coautor);$i++){
            $mail->AddAddress($coautor[$i],'');
        }
        $mail->FromName= $FromName;
        $mail->Subject=$subject;
        $mail->WordWrap  = 50;
        $mail->IsHTML(true);
        $mail->MsgHTML($body);
        return $mail->Send();
    }
}
?>