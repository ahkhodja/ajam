<?php
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 01/05/2016
 * Time: 01:03
 */
$id_editor=1;
include_once("../../../../php/cnx.php");
setlocale(LC_TIME, "fr_FR");
$sql="SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_editor WHERE editor=".$id_editor." AND etat='Submited'";

$select = $conn->query($sql);
if ($select->num_rows!=0) {
    echo "
<div id=\"contenu\">
<legend> &nbsp;Submited Article :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                <th width='10%'>DOWNLOAD</th>
                  </tr>
        </thead>
		<tbody>

";
    while($row = $select->fetch_assoc()){
        $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
        $row2 = $select2->fetch_assoc();
        $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
        $row3 = $select3->fetch_assoc();
        "
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/show.php?idar=".$row['article']."&et_e=".$row['id']."&idau=".$row2['author']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
                <td class=\"text-center\"><a><button><i class=\"fa fa-file-pdf-o\"></i></button></a></td>
            </tr>
  ";
    }
    


}else{


 echo "<p> No new items..</p>";

}

?>