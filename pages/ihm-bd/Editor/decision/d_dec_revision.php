<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 09/10/2016
 * Time: 11:15
 */
session_start();
if(!isset( $_SESSION['editor'])){

    header('Location: log-in.php');

}
include_once("../../../../php/cnx.php");
$editor=$_SESSION['editor'];
$article=intval($_POST['ar']);
$decision=mysqli_escape_string($conn,$_POST['dec']);
$id_et_editor=intval($_POST['e_ed']);
$author=intval($_POST['auth']);
$id_file=$_POST['f'];

$conn->autocommit(false);
$conn->begin_transaction();

$insert_etat_author=$conn->query("INSERT INTO state_author (article,file,date,state) VALUE (".$article.",".$id_file.",now(),'Revision')");
$id_state_author=mysqli_insert_id($conn);
if($insert_etat_author){
    $insert_decision=$conn->query("INSERT INTO decision (decision,state_author,article,editor,date,type)VALUE('".$decision."',".$id_state_author.",".$article.",".$editor.",now(),'Draft Revision') ");
    if( !$insert_decision){
        die('Error : ('. $conn->error .') '. $conn->error);
    }
    $id_decision=mysqli_insert_id($conn);
    $update_rev=$conn->query("UPDATE state_review SET decision=".$id_decision." WHERE article=".$article." AND type='review 1' AND state='Finished'");
    $update_article=$conn->query("UPDATE article set state='Decision' WHERE id=".$article);
    $select_id=$conn->query("SELECT author from article where id=".$article);
    $row_id=$select_id->fetch_assoc();
    $select_author = $conn->query("SELECT fname,lname ,email FROM personne WHERE id=".$row_id['author']);
    $row_author = $select_author->fetch_assoc();
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
        $conn->rollback();
        echo 0;
        exit;
    }


}else{

    echo 0;die();
}









?>