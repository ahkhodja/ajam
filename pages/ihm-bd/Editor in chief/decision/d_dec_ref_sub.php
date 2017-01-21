<?php
session_start();
if(!isset( $_SESSION['editor_in_chief'])){

    header('Location: log-in.php');

}
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 11/10/2016
 * Time: 09:59
 */

include_once("../../../../php/cnx.php");
$conn->autocommit(false);
$conn->begin_transaction();
$editor=$_SESSION['editor_in_chief'];
$id_file=intval($_POST['file']);
$article=intval($_POST['ar']);
$decision=$_POST['dec'];
$id_et_editor=intval($_POST['e_ed']);

$insert_etat_author=$conn->query("INSERT INTO state_author (article,date,state,file)VALUE (".$article.",now(),'Refused',".$id_file.")");
$id_state_author=mysqli_insert_id($conn);
if($insert_etat_author) {

    $insert_decision = $conn->query("INSERT INTO decision (decision,state_author,article,editor,date,type)VALUE('" . $decision . "'," . $id_state_author . "," . $article . "," . $editor . ",now(),'Refused') ");
    if(!$insert_decision){
        $conn->rollback();
        exit;
    }
    $update_state_editor=$conn->query("update state_editor SET etat='-Draft Submited-' WHERE id=".$id_et_editor);
    $insert_state_editor=$conn->query("INSERT INTO state_editor (article,file,etat,date,editor)VALUE (".$article.",".$id_file.",'Refused',now(),".$editor.")");

    $select_id=$conn->query("SELECT author from article where id=".$article);
    $row_id=$select_id->fetch_assoc();
    $select_author = $conn->query("SELECT fname,lname ,email FROM personne WHERE id=".$row_id['author']);
    $row_author = $select_author->fetch_assoc();
    $update_article=$conn->query("UPDATE article set state='Decision' WHERE id=".$article);
    $subject="DECISION AJAM";
    $FromName   = "AJAM OFFICE";
    require "mail.php";
    $mail=new mail();
    $res=$mail->envoyer($row_author["email"],$decision,$subject, $FromName);
    if($res){
        $conn->commit();

        echo 1;
    }else{
        $conn->rollback();
        echo 0;
        exit;
    }


}else
{
    echo 0;
}


$conn->close();
?>