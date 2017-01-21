<?php
session_start();


/**
 * Created by PhpStorm.
 * User: URTI
 * Date: 19/01/2016
 * Time: 10:15
 */

$arr = array();
$nb_co=intval($_POST["nb_co"]);
$editor=intval($_POST["d"]);
$mainfile=$_POST["main_file"];
$output = array();
$idarticle=$_POST["id_article"];
$id_etat=$_POST["etat"];
$idauthor=$_SESSION['id'];
$path='C:\sites\ajam\pages\ihm-bd\Authors\files\\'.$idauthor.'\\'.$idarticle.'\source\temp\\';
if($_POST["tfile"]=="latex"){
    $path='C:\sites\ajam\pages\ihm-bd\Authors\files\\'.$idauthor.'\\'.$idarticle.'\source\temp\\';
    chdir($path);

    $outputt=exec("xelatex  ".$mainfile,$output) ;
}else{

    $path='C:\sites\ajam\pages\ihm-bd\Authors\unoconv';
    chdir($path);
    $path2='C:\sites\ajam\pages\ihm-bd\Authors\files\\'.$idauthor.'\\'.$idarticle.'\source\temp\\'.$mainfile;

    $outputt=exec('python unoconv -f pdf --output= '.$path2,$output);
    chdir('C:\sites\ajam\pages\ihm-bd\Authors\files\\'.$idauthor.'\\'.$idarticle.'\source\temp\\');

}
$filedec =  explode('.', $mainfile );
$filename=$filedec[0].".pdf";
if (file_exists($filename))
{
    chdir('C:\sites\ajam\pages\ihm-bd\Authors\php');
    //insertion article
    include_once("../../../../php/cnx.php");


    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $type=mysqli_real_escape_string($conn,$_POST['type']);
    $area=mysqli_real_escape_string($conn,$_POST['area']);
    $abstract=mysqli_real_escape_string($conn,$_POST['abstract']);
    $keywords=mysqli_real_escape_string($conn,$_POST['keyword']);
    $mainfile=mysqli_real_escape_string($conn,$_POST["main_file"]);
    $main_type=mysqli_real_escape_string($conn,$_POST["ext_file"]);
    $main_size=mysqli_real_escape_string($conn,$_POST["size_file"]);
    $nb_im=intval(mysqli_real_escape_string($conn,$_POST["nb_im"]));

    $inser = $conn->query("UPDATE article SET author='".$idauthor."', title='".$title."', type='".$type."', area='".$area."', abstract='".$abstract."', keywords='".$keywords."' WHERE id= ".intval($idarticle));



    if($inser){

        $delete=$conn->query("DELETE FROM file WHERE article =".$idarticle." AND type like '%source'");
        $delete=$conn->query("DELETE FROM co_author WHERE article =".$idarticle);
        $delete=$conn->query("DELETE FROM sug_rev WHERE article =".$idarticle);
        if($delete){

            for($i=1;$i<=$nb_co;$i++)
            {
                $fname=mysqli_real_escape_string($conn,$_POST["co_fn".$i]);
                $mname=mysqli_real_escape_string($conn,$_POST['co_ln'.$i]);
                $lname=mysqli_real_escape_string($conn,$_POST['co_ln'.$i]);
                $affiliation=mysqli_real_escape_string($conn,$_POST['co_af'.$i]);
                $address1=mysqli_real_escape_string($conn,$_POST['co_ad'.$i]);

                $email=mysqli_real_escape_string($conn,$_POST['co_em'.$i]);
                $inser = $conn->query("INSERT INTO co_author (fname, mname, lname, affiliation,adresse,email,article) VALUES ('".$fname."','".$mname."','".$lname."','".$affiliation."','".$address1."','".$email."',".$idarticle.")");}
            if($inser){

                $inserfile = $conn->query("INSERT INTO file (name, size,article,type,extension) VALUES ('".$mainfile."','".$main_size."',".$idarticle.",'file_source','".$main_type."')");
                rename("../files/".$idauthor."/".$idarticle."/source/temp/".$mainfile."","../files/".$idauthor."/".$idarticle."/source/".$mainfile."");

                $inserfile=$conn->query("INSERT INTO file (name, size,article,type) VALUES ('ajam_R2_".$idarticle.".pdf','',".$idarticle.",'AJAM-R')");
                rename("../files/".$idauthor."/".$idarticle."/source/temp/".$filename."","../files/".$idauthor."/".$idarticle."/ajam_R2_".$idarticle.".pdf");

                for($i=1;$i<=$nb_co;$i++){

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
<div>--Revised 2 Paper--</div>
</div>
<div id=\"title\">".$title."</div>

<table>
<col style=\"width: 20%; text-align:left; background-color:#f8f8f8;\">
<col style=\"width: 60%; text-align:left;\">
<tr>
<td>Manuscript ID</td>
<td>AJAM-R2-".date('y')."/".$idarticle."</td>
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
                $outputt=exec("gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=ajam_R2_".$idarticle."_.pdf file.pdf ajam_R2_".$idarticle.".pdf ");
                chdir('C:\sites\ajam\pages\ihm-bd\Authors\php');
                //tester l'existance du fichier
                $inserfile=$conn->query("INSERT INTO file (name, size,article,type) VALUES ('ajam_R2_".$idarticle."_.pdf','',".$idarticle.",'AJAM-D')");
                $ajam_d=mysqli_insert_id($conn);





                // $inserfile=$conn->query("INSERT INTO state_author (article, file,date,state) VALUES ('".$idarticle."','".$ajam_d."',now(),'With Editor')");
               $inserfile=$conn->query("UPDATE state_author SET date=now(), file='".$ajam_d."' WHERE id=".$id_etat);
//etat_editeur
                for($j=1;$j<=$nb_im;$j++){

                    rename("../files/".$idauthor."/".$idarticle."/source/temp/".mysqli_real_escape_string($conn,$_POST['image'.$j])."","../files/".$idauthor."/".$idarticle."/source/".mysqli_real_escape_string($conn,$_POST['image'.$j])."");
                    $inserimage = $conn->query("INSERT INTO file (name, size,article,type,extension) VALUES ('".mysqli_real_escape_string($conn,$_POST['image'.$j])."','".mysqli_real_escape_string($conn,$_POST['images'.$j])."',".$idarticle.",'image_source','".mysqli_real_escape_string($conn,$_POST['imagee'.$j])."')");

                }
                for($p=1;$p<=3;$p++) {

                    $su_article = $conn->query("INSERT INTO sug_rev(fname,mname,lname,email,article) VALUES ('".mysqli_real_escape_string($conn, $_POST['re_fn'.$p])."','".mysqli_real_escape_string($conn, $_POST['re_mn'.$p])."','".mysqli_real_escape_string($conn, $_POST['re_ln' .$p]). "','".mysqli_real_escape_string($conn, $_POST['re_em'.$p])."','".$idarticle."')");
                }
                //$select_etat_editor=$conn->query("UPDATE state_editor set etat='-IDLE FOR SUBMITION-'  WHERE etat='IDLE FOR SUBMITION' AND article=".$idarticle);


               // $insert_etat_editor=$conn->query("INSERT INTO state_editor(article,file,etat,date,editor) VALUES ('".$idarticle."','".$ajam_d."','Revision 1',now(),".mysqli_real_escape_string($conn, $editor).")");

                copy("../../../../ajamTex/ajam-template.synctex.gz","../files/".$idauthor."/".$idarticle."/source/temp/ajam-template.synctex.gz");

                $arr[0]=1;
                $arr[1]=$idarticle;
                echo json_encode($arr);





            }
            else{



            }
        }
        else{
            die('Error : ('. $conn->error .') '. $conn->error);
        }
    }
    else{
        die('Error : ('. $conn->error .') '. $conn->error);
        echo "0";
    }
}
else {
    echo "0";
}

?>