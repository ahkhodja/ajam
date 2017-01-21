<?php







  
include_once("cnx.php");

  if(isset($_POST['pseudo'])&&isset($_POST['password'])) {
	 
	 
	  $inser = $conn->query("SELECT id,fname,lname FROM personne  WHERE personne.id = (
		SELECT
			author
		FROM
			article
		WHERE
			id = ".$_POST['pseudo']."
	)AND PASSWORD='".md5($_POST['password'])."'");
	  
	  
	   

    if ($inser->num_rows!=0) {
      echo "1";
	  session_start();
	  $row = $inser->fetch_assoc();
	  $_SESSION['id']=$row['id'];
	  $_SESSION['fname']=$row['fname'];
	  $_SESSION['lname']=$row['lname'];
	  
    }
    else
    {
      echo "0";
    }
  }
?>