<?php 
session_start();
$id=$_POST['id'];
if(!empty($_FILES['file'])){
	foreach($_FILES['file']['name'] as $key =>$name){
		if($_FILES['file']['error'][$key]==0 && move_uploaded_file($_FILES['file']['tmp_name'][$key],"../../pages/ihm-bd/Authors/files/".$id."/temp/{$name}")){$uploaded[]=$name;}
		}
	
	print_r($uploaded);
	}


?>