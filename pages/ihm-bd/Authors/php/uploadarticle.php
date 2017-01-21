<?php
session_start();
$idauthor=$_SESSION['id'];


$conn= new mysqli('localhost','root','','ajam');
$title=mysqli_real_escape_string($conn,$_POST['title_area']);
$type=mysqli_real_escape_string($conn,$_POST['type_of_paper']);
$area=mysqli_real_escape_string($conn,$_POST['area_of_article']);
$abstract=mysqli_real_escape_string($conn,$_POST['abstract_area']);
$keywords=mysqli_real_escape_string($conn,$_POST['keywords']);
$file=$_FILES['file']['name'][0];
	

$inser = $conn->query("INSERT INTO article (author, title, type, area, abstract, keywords, fichierZip, date,state) VALUES ('".$idauthor."','".$title."','".$type."','".$area."','".$abstract."','".$keywords."','".mysqli_real_escape_string($conn,$file)."',now(),'Check for formatting')");

if($inser){
  $idarticle=mysqli_insert_id($conn);
    $nom = md5(uniqid(rand(), true));
    $extension_upload = strtolower(  substr(  strrchr($file, '.')  ,1)  );
    rename("../files/".$idauthor."/temp/".$file."", "../files/".$idauthor."/".$nom.".".$extension_upload."");
    $inserfile = $conn->query("INSERT INTO file (name, url,article,type) VALUES ('".mysqli_real_escape_string($conn,$file)."','".$nom.".".$extension_upload."',".$idarticle.",'new')");
    $fileid=mysqli_insert_id($conn);
    $inserstate = $conn->query("INSERT INTO state_author (article, file,date,state) VALUES ('".$idarticle."','".$fileid."',now(),'Check for formatting')");
    $inserstate2 = $conn->query("INSERT INTO state_office (article, file,date,etat) VALUES ('".$idarticle."','".$fileid."',now(),'new')");
  
 
  
  
  
}else{
	  unlink("../files/".$idauthor."/temp/".$file."");
    die('Error : ('. $conn->error .') '. $conn->error);
	
}
$nb=intval($_POST['number_co_authors']);
for($i=1;$i<=$nb;$i++){
$fname=mysqli_real_escape_string($conn,$_POST["first_name".$i]);
$mname=mysqli_real_escape_string($conn,$_POST['middle_name'.$i]);
$lname=mysqli_real_escape_string($conn,$_POST['last_name'.$i]);
$affiliation=mysqli_real_escape_string($conn,$_POST['affiliation'.$i]);
$address1=mysqli_real_escape_string($conn,$_POST['address-1'.$i]);
$address2=mysqli_real_escape_string($conn,$_POST['address-2'.$i]);
$email=mysqli_real_escape_string($conn,$_POST['e-mail'.$i]);
$inser = $conn->query("INSERT INTO co_author (fname, mname, lname, affiliation,adresse,email,article) VALUES ('".$fname."','".$mname."','".$lname."','".$affiliation."','".$address1.$address2."','".$email."',".$idarticle.")");}
if($inser){
	
	
require '../PHPMailer/PHPMailerAutoload.php';
    $mail= new PHPMailer();

 

$mail->IsSMTP();
$mail->SMTPAuth   = true;                 
$mail->SMTPSecure = "ssl";                 
$mail->Host ="smtp.gmail.com";     
$mail->Port= 465;
$mail->Username= 'ad.khodja@gmail.com';
$mail->Password='ZARISBZARISB30NS';
$mail->From       = "ad.khodja@gmail.com";
for($j=1;$j<=$nb;$j++){
	$mail->AddCC($_POST['e-mail'.$j]);
	
	}
$mail->FromName   = "AJAM OFFICE";
$mail->Subject    = "Acknowledgement of manuscript receipt to AJAM ";
 
$mail->WordWrap   = 50;
$mail->IsHTML(true); 
$body="<p>
Dear ".$_SESSION['title']."  ".$_SESSION['fname']."  ".$_SESSION['lname'].",</p>

<p>Thank you for submitting your manuscript entitled “".$title."” to Algerian Journal of Advanced Materials. </p>
<p>Your submission has been assigned the following manuscript ID: AJAM-D-15-". $idarticle.". Please quote this number in the subject line in all correspondence with our journal regarding this manuscript. </p>
<p>You can track the status of your manuscript by logging on to the manuscript tracking system of AJAM for authors. The URL is <a href=\"http://ajam/tracking.html\">http://ajam/tracking.html</a></p>
<p>Thank you for your interest in our journal</p>
<p>Yours sincerely,</p>

<p>AJAM Publishing Editorial Office</p>





";
 

 
 $mail->MsgHTML($body);
 
$mail->AddAddress($_SESSION['email']);
 if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 header('Location: ../usr_home.php');
}
 
	
	
	
	$conn->close();
	
	
	
	
;
}else{
    die('Error : ('. $conn->error .') '. $conn->error);
}
 header('loaction : ../usr_home.php');
 ?>