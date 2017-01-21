<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 01/08/2016
 * Time: 11:14
 */
$area=$_POST['r'];
//echo  nl2br($area);
include_once ("/php/cnx.php");
$insert=$conn->query( "INSERT INTO retour (text) VALUES ('".$area."')");
$id=mysqli_insert_id($conn);
$select=$conn->query("SELECT text FROM retour WHERE id=".$id);
$row = $select->fetch_assoc();
//echo $row['text'];
echo nl2br($row['text']);
if($insert){}
else
    die('Error : ('. $conn->error .') '. $conn->error);

?>