<?php
session_start();
include_once("cnx.php");
setlocale(LC_TIME, "fr_FR");
$select = $conn->query("SELECT src,title, DATE_FORMAT(date, '%d %M') as date FROM messages WHERE dist=".$_POST['id']);
if ($select) {
	echo "
<div id=\"table_contenu\">
<legend> &nbsp;Inbox :</legend>
<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th>EXPIDITEUR</th>
                <th>TITLES</th>
                <th>DATE</th>
                  </tr>
        </thead>
		<tbody>
";
	 while($row = $select->fetch_assoc()){
	
      echo "
	   <tr>
                <td>Office</td>
                <td>". $row['title']."</td>
                <td>". $row['date']."</td>
             </tr>
  ";

	 }
	 
echo'</tbody>
</table></div>';

}else
   echo'<div id="table_contenu"><h1>Aucun Resultat...</h1></div>';

{
	
	
	
	
	
	
	
	}



?>
