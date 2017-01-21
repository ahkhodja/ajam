<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 19/10/2016
 * Time: 14:42
 */
session_start();
$idauthor=$_SESSION['id'];
$idarticle=$_GET["a"];
$id_etat=$_GET["e"];
$etat_editor=$_GET["et"];

$id_file=$_GET["f"];
include_once '../../../../php/cnx.php';


$inserfile=$conn->query("INSERT INTO state_author (article, file,date,state) VALUES ('".$idarticle."','".$id_file."',now(),'With Editor')");
$inserfile=$conn->query("UPDATE state_author SET date=now(),state='Submited Manuscript', file='".$id_file."' WHERE id=".$id_etat);
$insert_etat_editor=$conn->query("UPDATE state_editor SET etat='Draft Submited' WHERE  id=".$etat_editor);
$select_article=$conn->query("SELECT title FROM article WHERE id=".$idarticle);
$row_article=$select_article->fetch_assoc();
$select_co=$conn->query("SELECT email FROM co_author WHERE article=".$idarticle);
$update=$conn->query("UPDATE article set state='With Editor' WHERE id=".$idarticle);
$co_array=array();
$i=0;
if($select_co){
    if($select_co->num_rows!=0){
        while ($row_coauthor=$select_co->fetch_assoc()){
            $co_array[$i]=$row_coauthor['email'];
            $i++;
        }

    }
}
$subject="Receipt acknowledgement of correspondance";
$FromName  = "AJAM OFFICE";
require "mail.php";
$mail=new mail();
$corp="<p>Dear Dr ".$_SESSION['fname']." ".$_SESSION['fname'].",</p>
                <p>Thank you for submitting your manuscript entitled \" ".$row_article['title']." \" to Algerian Journal of Advanced Materials.</p>
                <p>Your submission has been assigned the following manuscript ID: AJAM-D-".date('y')."/".$idarticle." Please quote this number in the subject line in all correspondence with our journal regarding this manuscript. </p>
                <p>You can track the status of your manuscript by logging on to the manuscript tracking system of AJAM as an author. The URL is http://ajam/tracking.html</p>
                <p>Your username is: ".$_SESSION['email']."</p>
                <p>Thank you for your interest in our journal.<br/>
                Yours sincerely,<br/>
                AJAM Publishing Editorial Office</p>";
$res=$mail->envoyer($_SESSION["email"],$corp,$subject, $FromName,$co_array);
header('Location: ../usr_home.php?e='.$idarticle);




?>