<?php
session_start();
if(!isset(  $_SESSION['editor'])){

    header('Location: ../log-in.php');
}
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 10/05/2016
 * Time: 11:15
 */


include_once("../../../../php/cnx.php");
$id_etat_editor=$_POST['e_ed'];
$comment=mysqli_escape_string($conn,$_POST['comment']);
$select = $conn->query("UPDATE state_editor SET editor=1 WHERE id=".$id_etat_editor);
if ($select) {
    $insert_msg=$conn->query("INSERT INTO messages(dis,src,msg) VALUES (1,".$_SESSION['editor'].",'$comment')");
    if($insert_msg){
        echo 1;
    }else {
        echo 0;
        echo "Error updating record: " . $conn->error;
    }

} else {
    echo 0;
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>