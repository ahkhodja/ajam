<?php
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 11/10/2016
 * Time: 09:59
 */

include_once("../../../../php/cnx.php");
$editor=1;
$article=intval($_POST['ar']);
$decision=$_POST['dec'];
$id_et_editor=intval($_POST['e_ed']);
$id_file=$_POST['file'];

$insert_etat_author=$conn->query("INSERT INTO state_author (article,date,state)VALUE (".$article.",now(),'Refused')");
$id_state_author=mysqli_insert_id($conn);
if($insert_etat_author) {

    $insert_decision = $conn->query("INSERT INTO decision (decision,state_author,article,editor,date,type)VALUE('" . $decision . "'," . $id_state_author . "," . $article . "," . $editor . ",now(),'Refused') ");
    $update_state_editor=$conn->query("update state_editor SET etat='-Under Review-' WHERE id=".$id_et_editor);
    $insert_state_editor=$conn->query("INSERT INTO state_editor (article,file,etat,date,editor)VALUE (".$article.",".$id_file.",'Refused',now(),".$editor.")");
echo 1;
}else{
    echo 0;
}