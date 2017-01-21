<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 08/05/2016
 * Time: 11:43
 */
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
$id_editor=intval($_POST['ide']);
$id_etat_editor=intval($_POST['e_ed']);
$id_article=intval($_POST['idar']);
$id_author=intval($_POST['idau']);
$file=intval($_POST['idf']);
include_once("../../../../php/cnx.php");
mb_internal_encoding("UTF-8");
$select = $conn->query("UPDATE state_editor SET etat='-Submited-' WHERE id=".$id_etat_editor);
if ($select === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
}
$select = $conn->query("INSERT INTO state_editor (article,file,etat,date,editor) VALUES ('".$id_article."','".$file."','Waiting Review',now(),'".$id_editor."')");
if ($select) {
    $update_article=$conn->query("UPDATE article SET etiquette='AJAM-R1-".date("y")."/' WHERE id=".$id_article);

    echo "1";

} else {
    echo "Error updating record: " . $conn->error;
}



$conn->close();
?>
