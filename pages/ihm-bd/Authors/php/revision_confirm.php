<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 08/11/2016
 * Time: 11:42
 */
session_start();
$idauthor=$_SESSION['id'];
$idarticle=$_GET["a"];
$id_etat=$_GET["e"];
$etat_editor=$_GET["et"];

$id_file=$_GET["f"];
include_once '../../../../php/cnx.php';


$inserfile=$conn->query("UPDATE state_author SET date=now(),state='-Revision-' WHERE id=".$id_etat);
$inser_etat=$conn->query("INSERT INTO state_author (article, file,date,state) VALUES ('".$idarticle."','".$id_file."',now(),'With Editor')");
$select_etat_editor=$conn->query("UPDATE state_editor set etat='-Draft in Decision-'  WHERE etat='Draft in Decision' AND article=".$idarticle);
$select_editor=$conn->query("SELECT editor FROM state_editor WHERE article=".$idarticle);
$editor=$select_editor->fetch_assoc();
$insert_etat_editor=$conn->query("INSERT INTO state_editor(article,file,etat,date,editor) VALUES ('".$idarticle."','".$id_file."','R1 Submited',now(),".$editor['editor'].")");
$update_etiquette=$conn->query("UPDATE article SET etiquette='AJAM-R1-".date('y')."/' ,state='With editor' WHERE id=".$idarticle);
header('Location: ../usr_home.php?e='.$idarticle);