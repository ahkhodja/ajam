<?php







  
include_once("cnx.php");

  if(isset($_POST['pseudo'])) {
	 
	 
	  $inser = $conn->query("SELECT id FROM personne  WHERE email='".$_POST['pseudo']."'");
	  
	  
	   

    if ($inser->num_rows!=0) {
      echo "1";
    }
    else
    {
      echo "0";
    }
  }
?>