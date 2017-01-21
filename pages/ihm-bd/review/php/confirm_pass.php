<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 28/11/2016
 * Time: 10:23
 */
session_start();
$id_rev=$_SESSION['reviwer'];
include_once '../../../../php/cnx.php';
$conn->begin_transaction();
$conn->autocommit(false);
$old_pass=mysqli_escape_string($conn,$_POST["Old"]);
echo $old_pass;
$new_pass=mysqli_escape_string($conn,$_POST["New"]);
$confirm_pass=mysqli_escape_string($conn,$_POST["Confirm"]);
$select=$conn->query("SELECT email FROM reviewer WHERE id=".$id_rev." AND password='".md5($old_pass)."'");
if($select){
    if($select->num_rows!=0){


        $update=$conn->query("UPDATE reviewer SET password='".md5($new_pass)."' WHERE id=".$id_rev);
        if($update){
            echo'update';
            $conn->commit();
            header('Location: conf.php?t=o');
        }else{
            $conn->rollback();
            header('Location: conf.php?t=n');
        }
    }


}else{
    die('Error : ('. $conn->error .') '. $conn->error);
}
