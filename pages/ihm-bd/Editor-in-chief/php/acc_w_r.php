<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 09/10/2016
 * Time: 11:15
 */
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
$editor=1;
$article=intval($_POST['ar']);
$decision=$_POST['dec'];
$id_et_editor=intval($_POST['e_ed']);
$name = md5(uniqid(rand(), true));
$id_file=$_POST['f'];


include_once("../../../../php/cnx.php");



    $insert_etat_author=$conn->query("INSERT INTO state_author (article,file,date,state)VALUE (".$article.",".$id_file.",now(),'Revision')");
    $id_state_author=mysqli_insert_id($conn);
    if($insert_etat_author){
        $insert_decision=$conn->query("INSERT INTO decision (decision,state_author,article,editor,date,type)VALUE('".$decision."',".$id_state_author.",".$article.",".$editor.",now(),'Revision') ");
        if( !$insert_decision){
            die('Error : ('. $conn->error .') '. $conn->error);
        }
        $update_state_editor=$conn->query("update state_editor SET etat='-Under Review-' WHERE id=".$id_et_editor);
        $insert_state_editor=$conn->query("INSERT INTO state_editor (article,file,etat,date,editor)VALUE (".$article.",".$id_file.",'IDLE FOR SUBMITION',now(),".$editor.")");

            echo 1;
    }else{

        echo "0";die();
    }









?>