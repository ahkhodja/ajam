<?php
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 10/05/2016
 * Time: 11:15
 */
$id_etat_editor=$_POST['e_ed'];
$editor=$_POST['ed'];
include_once("../../../../php/cnx.php");
$select = $conn->query("UPDATE state_editor SET editor=".intval($editor)." WHERE id=".$id_etat_editor);
if ($select) {
    echo "1";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>