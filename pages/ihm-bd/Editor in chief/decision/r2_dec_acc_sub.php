<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 05/10/2016
 * Time: 11:18
 */
session_start();
if(!isset( $_SESSION['editor_in_chief'])){

    header('Location: log-in.php');

}

$editor=$_SESSION['editor_in_chief'];
$article=intval($_POST['ar']);
$decision=$_POST['dec'];
$id_et_editor=intval($_POST['e_ed']);
$id_file=intval($_POST['file']);
$author=intval($_POST['auth']);
include_once("../../../../php/cnx.php");
$conn->autocommit(false);
$conn->begin_transaction();


$insert_etat_author=$conn->query("INSERT INTO state_author (article,file,date,state)VALUE (".$article.",".$id_file.",now(),'Accepted')");
$id_state_author=mysqli_insert_id($conn);
if($insert_etat_author) {
    $insert_decision = $conn->query("INSERT INTO decision (decision,state_author,article,editor,date,type)VALUE('" . $decision . "'," . $id_state_author . "," . $article . "," . $editor . ",now(),'Accepted') ");
    $update_state_editor=$conn->query("update state_editor SET etat='-R2 Submited-' WHERE id=".$id_et_editor);
    $insert_state_editor=$conn->query("INSERT INTO state_editor (article,file,etat,date,editor)VALUE (".$article.",".$id_file.",'Accepted',now(),".$editor.")");
    $select_author = $conn->query("SELECT fname,lname ,email FROM personne WHERE id=".$author);
    $row_author = $select_author->fetch_assoc();
    $update_article=$conn->query("UPDATE article set state='Decision' WHERE id=".$article);
    $subject="DECISION AJAM";
    $FromName   = "AJAM OFFICE";
    require "mail.php";
    $mail=new mail();
    $body=$decision;
    $res=$mail->envoyer($row_author["email"],$body,$subject, $FromName);
    if($res){
        $conn->commit();

        echo 1;
    }else{

        echo 0;
        $conn->rollback();
    }


}else{

    echo 0;die();
}









?>