<?php 
session_start();
if(isset($_SESSION['id'])){
$id=$_SESSION['id'];
$name=str_replace(" ", "_",$_FILES['file']['name']);
if(!empty($_FILES['file'])){

		if($_FILES['file']['error']==0 && move_uploaded_file($_FILES['file']['tmp_name'],"files/".$id."/temp/{$name}")){$uploaded[]=$name;}

	
	print_r($uploaded);
	}

}else{
}
?>