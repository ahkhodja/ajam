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

    $inser = $conn->query("SELECT id,fname,mname,lname,email FROM editor  WHERE email='".$user."'AND password='".md5($password)."'");
    if ($inser) {

        session_start();
        $row = $inser->fetch_assoc();
        $_SESSION['editor_in_chief']=$row['id'];
        $_SESSION['editor_in_chief_fname']=$row['fname'];
        $_SESSION['editor_in_chief_lname']=$row['lname'];
        $_SESSION['editor_in_chief_email']=$row['email'];
        $_SESSION['editor_in_chief_mname']=$row['mname'];

        echo 1;
    }else{
        echo 0;
    }

}
else
    {

    echo 0;
}
?>