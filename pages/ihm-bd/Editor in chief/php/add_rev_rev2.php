<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 22/06/2016
 * Time: 23:29
 */
session_start();
if(!isset( $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
$editor=$_SESSION['editor_in_chief'];
$id_article=intval($_POST['idar']);
$id_rev=intval($_POST['idrev']);
$id_file=intval($_POST['idfile']);
$cle = md5(uniqid(rand(), true));
$cle2 = md5(uniqid(rand(), true));
$et_ed=intval($_POST['e_ed']);



include_once("../../../../php/cnx.php");
$conn->autocommit(false);
$conn->begin_transaction();
$add=$conn->query("INSERT INTO state_review (article,file,cle,reviewer,cle2,date,type)values(".$id_article.",".$id_file.",'".$cle."',".$id_rev.",'".$cle2."',now(),'Review 2')");

if($add){
    $id_etat=mysqli_insert_id($conn);
    $article=$conn->query("SELECT etiquette,title,abstract FROM article WHERE id=".$id_article);
    $res_article=$article->fetch_assoc();
    $rev=$conn->query("SELECT fname,lname,email FROM reviewer WHERE id=".$id_rev);
    $row_rev=$rev->fetch_assoc();


    require '../PHPMailer/PHPMailerAutoload.php';
    $mail= new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "TLS ";
    $mail->Host ="smtp.gmail.com";
    $mail->Port= 587;
    $mail->Username= 'ad.khodja@gmail.com';
    $mail->Password='zarisbzarisb30sm';
    $mail->From = "ad.khodja@gmail.com";
    $mail->AddAddress($row_rev['email'], '');
    $mail->FromName   = "AJAM OFFICE";
    $mail->Subject    = "Invitation to review for AJAM ";

    $mail->WordWrap   = 50;
    $mail->IsHTML(true);
    $body="<p> Dear Dr.".$row_rev['fname']." ".$row_rev['lname']."</p>
    <p>As an associate editor of the Algerian Journal of Advanced Materials, I am writing to ask whether you would be able to review the article ID ".$res_article['etiquette'].$id_article.", entitled \"".$res_article['title']."\" for a possible publication in our journal. </br>
I believe that the above paper falls within your field of expertise. 
</p><p>This is the abstract: </p><p>".nl2br($res_article['abstract'])."</p>
<p>If you agree to review this paper, please click this link:  http://localhost/ajam/pages/ihm-bd/review/review2.php?c1=".$cle."&c2=".$cle2."&rsa=".$id_etat."&f=".$id_file."&et_ed=".$et_ed."&b=".$editor." </p>
    <p>If you declined to review this paper, please click this link:  http://localhost/ajam/pages/ihm-bd/review/ref.php?rsa=".$id_etat."</p>
    <p>You can find all of your pending and completed reviews at http://localhost/ajam/pages/ihm-bd/review/log-in.php. Your username is ".$row_rev['email']."&b=".$editor." </p>
    <p>If possible, I would appreciate receiving your review in 60 days. You may submit your comments online at the above URL. There you will find spaces for confidential comments to the editor, comments for the author and a report form to be completed. </p>
    <p>Best regards, </p>
    
    
    ";

    $mail->MsgHTML($body);
    if(!$mail->Send()) {
        $conn->rollback();
        echo "Mailer Error: " . $mail->ErrorInfo;
        echo 0;
        exit();



    }else{
        $conn->commit();
        echo 1;
    }







}else{die('Error : ('. $conn->error .') '. $conn->error);}


?>