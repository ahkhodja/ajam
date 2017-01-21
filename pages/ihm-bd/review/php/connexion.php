<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 03/11/2016
 * Time: 09:29
 */
if(isset($_POST['pseudo'])&&isset($_POST['password'])) {
    include_once ("../../../../php/cnx.php");
    $user=mysqli_escape_string($conn,$_POST["pseudo"]);

    $password=mysqli_escape_string($conn,$_POST["password"]);

    $inser = $conn->query("SELECT id,fname,mname,lname,email FROM reviewer  WHERE email='".$user."'AND password='".md5($password)."'");
    if ($inser) {
        if($inser->num_rows!=0){
            session_start();
            $row = $inser->fetch_assoc();
            $_SESSION['reviwer']=$row['id'];
            $_SESSION['reviwer_fname']=$row['fname'];
            $_SESSION['reviwer_lname']=$row['lname'];
            $_SESSION['reviwer_email']=$row['email'];
            $_SESSION['reviwer_mname']=$row['mname'];

            echo 1;}else{
            echo 0;
        }
    }else{
        echo 0;
    }

}
else
{

    echo 0;
}
?>