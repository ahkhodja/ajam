<?php

/**
 * Created by PhpStorm.
 * User: URTI
 * Date: 19/01/2016
 * Time: 10:15
 */
session_start();
$arr = array();
$idauthor=$_SESSION["id"];
$nb_co=intval($_POST["nb_co"]) ;
$mainfile=$_POST["main_file"];
$idauthor=$_SESSION['id'];

$output = array();
if($_POST["tfile"]=="latex"){
    $path='C:\sites\ajam\pages\ihm-bd\Authors\files\\'.$idauthor.'\temp\\';
    chdir($path);

    $outputt=exec("xelatex  ".$mainfile,$output) ;
}else{

    $path='C:\sites\ajam\pages\ihm-bd\Authors\unoconv';
    chdir($path);
    $path2='C:\sites\ajam\pages\ihm-bd\Authors\files\\'.$idauthor.'\temp\\'.$mainfile;

    $outputt=exec('python unoconv -f pdf --output= '.$path2,$output);

}
chdir('C:/sites/ajam/pages/ihm-bd/Authors/files/'.$idauthor.'/temp/');
//print_r ($output);
$filedec =  explode('.', $mainfile );

$filename=$filedec[0].".pdf";
if (file_exists($filename)) {

     chdir('C:\sites\ajam\pages\ihm-bd\Authors\php');


    //insertion article
    include_once("../../../../php/cnx.php");


    $cle = md5(uniqid(rand(), true));
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $type=mysqli_real_escape_string($conn,$_POST['article_type']);
    $area=mysqli_real_escape_string($conn,$_POST['area']);
    $abstract=mysqli_real_escape_string($conn,$_POST['abstract']);
    $keywords=mysqli_real_escape_string($conn,$_POST['keyword']);
    $mainfile=mysqli_real_escape_string($conn,$_POST["main_file"]);
    $main_type=mysqli_real_escape_string($conn,$_POST["ext_file"]);
    $main_size=mysqli_real_escape_string($conn,$_POST["size_file"]);
    $nb_im=intval(mysqli_real_escape_string($conn,$_POST["nb_im"]));

    $inser = $conn->query("INSERT INTO article (author, title, type, area, abstract, keywords,  date,state,cle,etiquette) VALUES ('".$idauthor."','".$title."','".$type."','".$area."','".$abstract."','".$keywords."',now(),'Check Informations','".$cle."','AJAM-D-".date('y')."/')");

    if($inser){

        $idarticle=mysqli_insert_id($conn);

        mkdir("../files/".$idauthor."/".$idarticle."/source",0777,true);
        mkdir("../files/".$idauthor."/".$idarticle."/source/temp",0777,true);
        for($i=1;$i<=$nb_co;$i++){
            $fname=mysqli_real_escape_string($conn,$_POST["co_fn".$i]);
            $mname=mysqli_real_escape_string($conn,$_POST['co_ln'.$i]);
            $lname=mysqli_real_escape_string($conn,$_POST['co_ln'.$i]);
            $affiliation=mysqli_real_escape_string($conn,$_POST['co_af'.$i]);
            $address1=mysqli_real_escape_string($conn,$_POST['co_ad'.$i]);

            $email=mysqli_real_escape_string($conn,$_POST['co_em'.$i]);
            $inser = $conn->query("INSERT INTO co_author (fname, mname, lname, affiliation,adresse,email,article) VALUES ('".$fname."','".$mname."','".$lname."','".$affiliation."','".$address1."','".$email."',".$idarticle.")");}
            if($inser){

                $inserfile = $conn->query("INSERT INTO file (name, size,article,type,extension) VALUES ('".$mainfile."','".$main_size."',".$idarticle.",'file_source','".$main_type."')");
                    rename("../files/".$idauthor."/temp/".$mainfile."","../files/".$idauthor."/".$idarticle."/source/".$mainfile."");

                $inserfile=$conn->query("INSERT INTO file (name, size,article,type) VALUES ('ajam_D_".$idarticle.".pdf','',".$idarticle.",'AJAM-D_pdf')");
                rename("../files/".$idauthor."/temp/".$filename."","../files/".$idauthor."/".$idarticle."/ajam_D_".$idarticle.".pdf");
                $ajam_d=mysqli_insert_id($conn);
//debut ajout premiere page
                $co_array=array();
                for($i=1;$i<=$nb_co;$i++){
                    $co_array[$i-1]=mysqli_real_escape_string($conn,$_POST['co_em'.$i]);
                    $co=mysqli_real_escape_string($conn,$_POST["co_fn".$i])." ".mysqli_real_escape_string($conn,$_POST['co_ln'.$i])."<br />";
                }

                $body="<head>
<style type=\"text/css\">
<!--
table
{
    widtd:100%;
	margin-left:70px;
	margin-top:50px;
    border:none;
    border-collapse: collapse;
}
#header{
	display:inline-block;
	margin:0;
	height:20px;
}
#textLogo, #textLogo h1{
	display:inline-block;
	text-align:left;
	height:20px;
	/*border-left:1px solid #000;*/
	font-size:12px;
}
#logo{
	display:inline-block;
	width:20px;
	margin-left:0;
}

#title{
	margin-top:80px;
	max-width:300px;
	font-size:16px;
	font-weight:bold;
	text-align:center;	
}
td
{
	padding:5px;
    text-align: center;
    border: solid 1px #999;
}

-->
</style>
</head>
<body>
<div id=\"header\">
<!--<div id=\"logo\"><img height=\"20px\" width=\"20px\" src=\"logo.png\"/></div>-->
<div id=\"textLogo\"><h1>Algerien Journal for Advanced Materials</h1></div>
<div>--Manuscript Draft--</div>
</div>
<div id=\"title\">".$title."</div>

<table>
<col style=\"width: 20%; text-align:left; background-color:#f8f8f8;\">
<col style=\"width: 60%; text-align:left;\">
<tr>
<td>Manuscript ID</td>
<td>AJAM-D-".date('y')."/".sprintf('%04d', $idarticle)."</td>
</tr>
<tr>
<td>Article Type</td>
<td>".$type."</td>
</tr>
<tr>
<td>Date Submitted by the Author</td>
<td>".date('l jS \of F Y h:i:s A')."</td>
</tr>
<tr>
<td>Corresponding Author</td>
<td>".$_SESSION['fname']." ".$_SESSION['lname']."</td>
</tr>
<tr>
<td>Complete List of Authors</td>
<td>".$_SESSION['fname']." ".$_SESSION['lname']."<br/>".$co." </td>
</tr>
<tr>
<td>Abstract</td>
<td>".$abstract."</td>
</tr>
<tr>
<td>Keywords</td>
<td>".$keywords."</td>
</tr>
</table>
</body>";
                require('../html2pdf-4.4.0/html2pdf.class.php');
                try
                {
                    $html2pdf = new HTML2PDF("P", "A4", "en");
                    $html2pdf->setDefaultFont("Arial");
                    $html2pdf->writeHTML($body);
                    $html2pdf->Output("../files/".$idauthor."/".$idarticle."/file.pdf",'F');

                }catch(HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
                chdir('C:/sites/ajam/pages/ihm-bd/Authors/files/'.$idauthor.'/'.$idarticle.'/');
                $outputt=exec("gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=ajam_D_".$idarticle."_.pdf file.pdf ajam_D_".$idarticle.".pdf ");
                chdir('C:\sites\ajam\pages\ihm-bd\Authors\php');
                //tester l'existance du fichier
                $inserfile=$conn->query("INSERT INTO file (name, size,article,type) VALUES ('ajam_D_".$idarticle."_.pdf','',".$idarticle.",'AJAM-D')");

                $ajam_d=mysqli_insert_id($conn);
                $inserfile=$conn->query("INSERT INTO state_author (article, file,date,state) VALUES ('".$idarticle."','".$ajam_d."',now(),'validation')");

                    for($j=1;$j<=$nb_im;$j++){

                        rename("../files/".$idauthor."/temp/".mysqli_real_escape_string($conn,$_POST['image'.$j])."","../files/".$idauthor."/".$idarticle."/source/".mysqli_real_escape_string($conn,$_POST['image'.$j])."");
                        $inserimage = $conn->query("INSERT INTO file (name, size,article,type,extension) VALUES ('".mysqli_real_escape_string($conn,$_POST['image'.$j])."','".mysqli_real_escape_string($conn,$_POST['images'.$j])."',".$idarticle.",'image_source','".mysqli_real_escape_string($conn,$_POST['imagee'.$j])."')");

                    }
                for($p=1;$p<=3;$p++) {

                    $su_article = $conn->query("INSERT INTO sug_rev(fname,mname,lname,email,article) VALUES ('".mysqli_real_escape_string($conn, $_POST['re_fn'.$p])."','".mysqli_real_escape_string($conn, $_POST['re_mn'.$p])."','".mysqli_real_escape_string($conn, $_POST['re_ln' .$p]). "','".mysqli_real_escape_string($conn, $_POST['re_em'.$p])."','".$idarticle."')");
                }

                $insert_etat_editor=$conn->query("INSERT INTO state_editor(article,file,etat,date,editor) VALUES ('".$idarticle."','".$ajam_d."','Pre_Submited',now(),".mysqli_real_escape_string($conn, $_POST['editor']).")");

                copy("../files/".$idauthor."/temp/ajam.cls","../files/".$idauthor."/".$idarticle."/source/temp/ajam.cls");
                copy("../files/".$idauthor."/temp/ajam-template.aux","../files/".$idauthor."/".$idarticle."/source/temp/ajam-template.aux");
                copy("../files/".$idauthor."/temp/ajam-template.dvi","../files/".$idauthor."/".$idarticle."/source/temp/ajam-template.dvi");
                copy("../files/".$idauthor."/temp/ajam-template.spl","../files/".$idauthor."/".$idarticle."/source/temp/ajam-template.spl");
                copy("../../../../ajamTex/ajam-template.synctex.gz","../files/".$idauthor."/".$idarticle."/source/temp/ajam-template.synctex.gz");
                copy("../../../../ajamTex/ajam-template.synctex.gz","../files/".$idauthor."/temp/ajam-template.synctex.gz");




                $arr[0]=1;
                $arr[1]=$idarticle;
                $subject="Waiting for approval of AJAM-D-".date('y')."/".$idarticle;
                $FromName  = "AJAM OFFICE";
                require "mail.php";
                $mail=new mail();
                $corp="<p>Dear Dr ".$_SESSION['fname']." ".$_SESSION['fname'].",</p>
                <p>The PDF for your submission, \" ".$title." has been built.It is now waiting for your approval. Please view the submission and be certain that it is free of any errors, before approving it.</p>
                <p>To approve the PDF please login to the manuscript tracking system of AJAM as an author. http://ajam/tracking.html</p>
                <p>Your username is: ".$_SESSION['email']."</p>
                <p>Once your approval is done, no changes in the manuscript contents will be possible. You will receive an e-mail confirming receipt of your submission from the Editorial Office.<br/>
                Yours sincerely,<br/>
                AJAM Publishing Editorial Office</p>";
                $res=$mail->envoyer($_SESSION["email"],$corp,$subject, $FromName,$co_array);
                echo json_encode($arr);
                     //mail





            }else{

                echo'erreur interne';
                die('Error : ('. $conn->error .') '. $conn->error);

            }
    }
    else{
        echo'erreur interne';
        die('Error : ('. $conn->error .') '. $conn->error);
    }
} else {


    echo "erreur file";
}






?>