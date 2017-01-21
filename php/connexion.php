<?php

include_once("cnx.php");

  if(isset($_POST['pseudo'])&&isset($_POST['password'])) {
	  $inser = $conn->query("SELECT id,fname,lname,mname,email,title,grade,affiliation,contry,city,adresse FROM personne  WHERE email='".$_POST['pseudo']."'AND PASSWORD='".md5($_POST['password'])."'");
      if ($inser->num_rows!=0) {

	  session_start();
	  $row = $inser->fetch_assoc();
	  $_SESSION['id']=$row['id'];
	  $_SESSION['fname']=$row['fname'];
      $_SESSION['mname']=$row['mname'];
	  $_SESSION['lname']=$row['lname'];
	  $_SESSION['email']=$row['email'];
      $_SESSION['title']=$row['title'];
	  $_SESSION['grade']=$row['grade'];
      $_SESSION['affiliation']=$row['affiliation'];
          $_SESSION['city']=$row['city'];
          $_SESSION['contry']=$row['contry'];
          $_SESSION['adresse']=$row['adresse'];
        echo "1";
      } else
             {
      echo "0";
         }
  }
?>