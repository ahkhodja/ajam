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


include_once("../../../../php/cnx.php");
$conn->autocommit(false);
$conn->begin_transaction();
$id_etat_editor=$_POST['e_ed'];
$id_ed=$_POST['ed'];
$select = $conn->query("UPDATE state_editor SET editor=".$id_ed." WHERE id=".$id_etat_editor);
if ($select) {
        $conn->commit();
        echo 1;


} else {
    $conn->rollback();
    echo 0;

}
$conn->close();
?>