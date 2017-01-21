<?php 
include_once("cnx.php");
setlocale(LC_TIME, "fr_FR");
$select = $conn->query("SELECT id,title,state, DATE_FORMAT(date, '%d %M') as date FROM article WHERE author=".$_POST['id']);

if ($select->num_rows!=0) {
	echo "
<div id=\"table_contenu\">
<legend> &nbsp;Track :</legend>
<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='10%'>Id</th>
                <th width='70%'>Title</th>
                <th width='10%'>State</th>
                <th width='10%'>DATE</th>
            </tr>
        </thead>
		<tbody>
";
	 while($row = $select->fetch_assoc()){
	
      echo "
	   <tr>
                <td>". $row['id']."</td>
                <td><a href=\"php/track.php?id=".$row['id']."\" class=\"lien\">". $row['title']."</a></td>

                <td>". $row['state']."</td>
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
