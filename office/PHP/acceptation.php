<?php 
$file=$_POST['file'];
$idauthor=$_POST['author'];
$idarticle=$_POST['article'];
$etat=$_POST['etat'];
 $nom = md5(uniqid(rand(), true));
 $extension_upload = strtolower(  substr(  strrchr($file, '.')  ,1)  );
 rename("../../pages/ihm-bd/Authors/files/".$idauthor."/temp/".$file."", "../../pages/ihm-bd/Authors/files/".$idauthor."/".$nom.".".$extension_upload."");
$conn= new mysqli('localhost','root','','ajam');
 $inserfile = $conn->query("INSERT INTO file (name, url,article,type) VALUES ('".mysqli_real_escape_string($conn,$file)."','".$nom.".".$extension_upload."',".$idarticle.",'with_editor')");
$fileid=mysqli_insert_id($conn);
$inser = $conn->query("INSERT INTO state_editor_chef(article,file,etat,date) values (".$idarticle.",".$fileid.",'new',now())");
if($inser){
	$insert2= $conn->query("UPDATE state_office SET etat='accepted',date=now() WHERE id=".$etat."");
	
	
	echo "1";
	
	
	}else{die('Error : ('. $conn->error .') '. $conn->error);}

















?>