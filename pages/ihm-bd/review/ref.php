<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 06/11/2016
 * Time: 13:21
 */
include_once("../../../php/cnx.php");
$id=mysqli_real_escape_string($conn,$_GET['rsa']);
$test=$conn->query("SELECT state WHERE");

$update=$conn->query("update state_review set state='Refused' ,date_reject=now() WHERE id=".$id);
if($update){
    $select=$conn->query("SELECT e.fname as namef,e.lname as namel, p.fname,p.lname,r.email,a.id,a.etiquette FROM article a,personne p,state_review s,editor e,state_editor se,reviewer r where s.id=".$id." AND a.id=s.article and p.id=a.author and se.article=s.article and e.id= se.editor and r.id=s.reviewer  ");

    if($select){


        $row_article=$select->fetch_assoc();
        $body="
<p>Dear Dr. ".$row_article['fname']." ".$row_article['lname']."</p>
<p> Thank you for your response about the reviewing of the manuscript ".$row_article['etiquette'].$row_article['id']." submitted to the Algerian Journal of Advanced Materials.</p>
<p>With kind regards<br/>
pr ".$row_article['namef']." ".$row_article['namel']." <br/>
Associate Editor<br/>
Algerian Journal of Advanced Materials </p>
";

        $subject="Thank you for your response about reviewing the paper".$row_article['etiquette'].$row_article['id'];
        $FromName   = "AJAM OFFICE";
        require "mail_function.php";
        $mail=new mail_function();
        $res=$mail->envoyer($row_article["email"],$body,$subject, $FromName);

    }else{
        die('Error : ('. $conn->error .') '. $conn->error);
    }




}else{
    die('Error : ('. $conn->error .') '. $conn->error);
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Review ID:<?php echo $row_article['etiquette'].$row_article['id']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
    <link rel="stylesheet" href="css/review.css" type="text/css" />
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <!-- <script src=../../js/jquery-1.9.1.min.js></script> -->
    <script src="../../../js/jquery-1.11.3.min.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body style="padding-bottom: 70px">
<div class="container-fluid">
    <div class="col-lg-12">
        <nav class ="navbar navbar-inverse">
            <div class ="navbar-header ">
                <a class ="navbar-brand " href ="#">REVIEWVER ACCOUNT  </a>
            </div>

            <div class ="navbar-form pull-right " id="rev_info">
                <?php echo $row_article['fname']." ".$row_article['lname'];?>
            </div>
        </nav>
    </div>
</div>
<div class="container-fluid">
    <div class="form-group">
        <div class="col-lg-1">
</div>

        <div class="col-lg-10">

            <label for="text" class="text-left mail" >
                Dear Dr. <?php echo $row_article['fname']." ".$row_article['lname'];?>,</br></br>
                Thank you for your response about the reviewing of the manuscript <?php echo $row_article['etiquette'].$row_article['id']  ?> submitted to the Algerian Journal of Advanced Materials.</label>
                    </br>
            </br>
            With kind regards
            </br>
            pr <?php echo $row_article['namef']." ".$row_article['namel'];?>
            </br>
            Associate Editor
            </br>
            Algerian Journal of Advanced Materials
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <p></p>
    </div>
    </div>
</div>
</body>
</html>

