<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 11/10/2016
 * Time: 09:59
 */

session_start();
if(!isset( $_SESSION['editor'])){

    header('Location: ../log-in.php');

}
include_once("../../../../php/cnx.php");
$editor=$_SESSION['editor'];
$article=intval($_POST['ar']);
$decision=$_POST['dec'];
$id_et_editor=intval($_POST['e_ed']);
$file=$_POST['file'];

$insert_etat_author=$conn->query("INSERT INTO state_author (article,date,state,file)VALUE (".$article.",now(),'Refused',".intval($file).")");
$id_state_author=mysqli_insert_id($conn);
if($insert_etat_author) {


    $insert_decision = $conn->query("INSERT INTO decision (decision,state_author,article,editor,date,type)VALUE('" . $decision . "'," . $id_state_author . "," . $article . "," . $editor . ",now(),'Refused') ");
    if(!$insert_decision){
        echo "Error updating record:" . $conn->error;
    }
    $update_state_editor=$conn->query("update state_editor SET etat='-Submited-' WHERE id=".$id_et_editor);
    if(!$update_state_editor){
        echo "Error updating record: " . $conn->error;
    }
    $insert_state_editor=$conn->query("INSERT INTO state_editor (article,file,etat,date,editor)VALUE (".$article.",".$file.",'Refused',now(),".$editor.")");
    if(!$insert_state_editor){
        echo "Error updating record:" . $conn->error;
    }
    $select_author_id=$conn->query("SELECT author from article WHERE id=".$article);
    if($select_author_id){
        $row_select=$select_author_id->fetch_assoc();
        $select_author=$conn->query("SELECT fname,lname,email from personne WHERE id=".$row_select['author']);
        if($select_author){
            $row_author=$select_author->fetch_assoc();
            $FromName   = "AJAM OFFICE";
            $subject=" AJAM Decision";

            require '../mail/mail.php';
            $mail=new mail();
            $res=$mail->envoyer($row_author['email'],$decision,$subject, $FromName);
            echo 1;
        }


    }




}else{
    echo "Error updating record:" . $conn->error;
}