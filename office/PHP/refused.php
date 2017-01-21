<?php 

$idauthor=$_POST['author'];
$idarticle=$_POST['article'];
$etat=$_POST['etat'];
 
$conn= new mysqli('localhost','root','','ajam');



	$insert= $conn->query("UPDATE state_office SET etat='refused' WHERE id=".$etat."");
	if($insert){
		
	echo "1";
	//notification+envoi mail a lauteur et au editeur en chef
	//update state author
	
	}else{die('Error : ('. $conn->error .') '. $conn->error);}

















?>