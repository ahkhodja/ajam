<?php 
include_once('cnx.php');
$titre=mysqli_real_escape_string($conn,$_POST['title']);
$fname=mysqli_real_escape_string($conn,$_POST['first_name']);
$mname=mysqli_real_escape_string($conn,$_POST['middle_name']);
$lname=mysqli_real_escape_string($conn,$_POST['last_name']);
$Affiliation=mysqli_real_escape_string($conn,$_POST['affiliation']);
$grade=mysqli_real_escape_string($conn,$_POST['grade']);
$addr=mysqli_real_escape_string($conn,$_POST['address-1']);
$city=mysqli_real_escape_string($conn,$_POST['city']);
$state=mysqli_real_escape_string($conn,$_POST['region']);
$country=mysqli_real_escape_string($conn,$_POST['country']);
$pcode=mysqli_real_escape_string($conn,$_POST['post_code']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);
$grade=mysqli_real_escape_string($conn,$_POST['grade']);
$fax=mysqli_real_escape_string($conn,$_POST['fax']);
$password=mysqli_real_escape_string($conn,md5($_POST['password']));


$inser = $conn->query("INSERT INTO personne ( title,fname, mname, lname, affiliation, adresse, city, state, contry, pcode, email, phone, fax, password,date,grade) VALUES ('".$titre."','".$fname."','".$mname."','".$lname."','".$Affiliation."','".$addr."','".$city."','".$state."','".$country."','".$pcode."','".$email."','".$phone."','".$fax."','".$password."',now(),'".$grade."')");




if($inser){
	$id=mysqli_insert_id($conn);
	 mkdir("../pages/ihm-bd/Authors/files/".$id."/temp",0777,true);
   // date_default_timezone_set('Etc/UTC');
    copy("../ajamTEX/ajam.cls","../pages/ihm-bd/Authors/files/".$id."/temp/ajam.cls");
    copy("../ajamTEX/ajam-template.aux","../pages/ihm-bd/Authors/files/".$id."/temp/ajam-template.aux");
    copy("../ajamTEX/ajam-template.dvi","../pages/ihm-bd/Authors/files/".$id."/temp/ajam-template.dvi");
    copy("../ajamTEX/ajam-template.spl","../pages/ihm-bd/Authors/files/".$id."/temp/ajam-template.spl");
    copy("../ajamTEX/ajam-template.synctex.gz","../pages/ihm-bd/Authors/files/".$id."/temp/ajam-template.synctex.gz");
 
require '../PHPMailer/PHPMailerAutoload.php';
 $mail= new PHPMailer();

 

$mail->IsSMTP();
$mail->SMTPAuth   = true;                 
$mail->SMTPSecure = "ssl";                 
$mail->Host ="smtp.gmail.com";     
$mail->Port= 465;
$mail->Username= 'ad.khodja@gmail.com';
$mail->Password='zarisbzarisb30sm';
$mail->From       = "ad.khodja@gmail.com";
$mail->FromName   = "AJAM OFFICE";
$mail->Subject    = "Your Registration to AJAM  ";
 
$mail->WordWrap   = 50;
$mail->IsHTML(true); 
$body="<p>Dear ".$fname.",</p></br> 

<p>Thank you for your registration to AJAM and we are looking forward to see you as potential contributor to the journal contents.</p></br><p> You will find below the parameters of your account.</p></br>
<p>E-mail : ".$email."</p></br>
<p>Password : ".$_POST['password']."</p></br>

<p>Sincerely yours,</p></br> 

<p>".$fname." ".$lname."</p></br>
<p>Editorial office </p></br> 
<p>Algerian Journal of Advanced Materials </p>";
 

 
 $mail->MsgHTML($body);
 
$mail->AddAddress($email);
 
 
 
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 
}
 
	echo  $id;
    
	 
 header('Location: ../pages/thank_you.html'); 
}else{
    die('Error : ('. $conn->error .') '. $conn->error);
}


?>