<?php 
session_start();
include_once("cnx.php");
$select = $conn->query("UPDATE personne SET affiliation='".$_POST['affiliation']."',adresse='".$_POST['adresse']."',state='".$_POST['state']."',contry='".$_POST['contry']."',pcode='".$_POST['pcode']."',Phone='".$_POST['Phone']."',fax='".$_POST['fax']."' 
WHERE id=".$_SESSION['id']);

if($select){
	echo'
	<div id="table_contenu">
	
	<h2>Confirmation</h2>
<p class = "lead">Updated successfully</p>
	
	
	
	</div>
	
	
	';
	
	
	
	}else
	{
		echo "Error: <br>" . $conn->error;
		
		}




?>