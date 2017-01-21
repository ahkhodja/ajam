<?php
session_start();
if(!isset( $_SESSION['editor'])){

    header('Location: log-in.php');

}
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 11/10/2016
 * Time: 09:59
 */

include_once("../../../../php/cnx.php");
$editor=$_SESSION['editor'];
$id_file=intval($_POST['file']);
$article=intval($_POST['ar']);
$decision=$_POST['dec'];
$id_et_editor=intval($_POST['e_ed']);

$insert_etat_author=$conn->query("INSERT INTO state_author (article,date,state,file)VALUE (".$article.",now(),'Refused',".$id_file.")");
$id_state_author=mysqli_insert_id($conn);
if($insert_etat_author) {

    $insert_decision = $conn->query("INSERT INTO decision (decision,state_author,article,editor,date,type)VALUE('" . $decision . "'," . $id_state_author . "," . $article . "," . $editor . ",now(),'Refused') ");
    $id_decision=mysqli_insert_id($conn);
    $update_rev=$conn->query("UPDATE state_review SET decision=".$id_decision." WHERE article=".$article." AND type='review 1' AND state='Finished'");
    $update_state_editor=$conn->query("update state_editor SET etat='-Draft in Decision-' WHERE id=".$id_et_editor);
    $insert_state_editor=$conn->query("INSERT INTO state_editor (article,file,etat,date,editor)VALUE (".$article.",".$id_file.",'Refused',now(),".$editor.")");
    $update_article=$conn->query("UPDATE article set state='Decision' WHERE id=".$article);

    echo 1;
}else
{echo 0;}
$conn->close();