<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 01/11/2016
 * Time: 22:41
 */
include_once ("../../../../php/cnx.php");
$fname=mysqli_real_escape_string($conn,$_POST["fname"]);
$mname=mysqli_real_escape_string($conn,$_POST["mname"]);
$lname=mysqli_real_escape_string($conn,$_POST["lname"]);
$email=mysqli_real_escape_string($conn,$_POST["email"]);
$password=md5($_POST["password"]);
$insert_revewver=$conn->query("INSERT INTO reviewer(fname,mname,lname,email,password)VALUES ('".$fname."','".$mname."','".$lname."','".$email."','".$password."')" );
if($insert_revewver){


    //mail verre reviewver.
    echo 1;
}else{echo 0;}