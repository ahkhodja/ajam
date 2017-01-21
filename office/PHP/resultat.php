<?php 
include_once("cnx.php");
setlocale(LC_TIME, "fr_FR");
$select = $conn->query("SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_office  WHERE etat='".$_POST['pseudo']."'");
echo "<table width=\"100%\" id=\"principale\"cellspacing=\"0\"  cellpadding=\"0\">
  <tbody>";
if ($select->num_rows!=0) {
      
	  
	  while($row = $select->fetch_assoc()){
	 
	       $select2=$conn->query("SELECT title,author FROM article  WHERE id=".$row['article']."");
		    $select3=$conn->query("SELECT url FROM file  WHERE id=".$row['file']."");
			
	       $row2= $select2->fetch_assoc();
		   $row3= $select3->fetch_assoc();
		   $select4=$conn->query("SELECT fname,lname FROM personne  WHERE id=".$row2['author']."");
		     $row4= $select4->fetch_assoc();




echo "
    <tr class=\"lien\">
      <td width=\"10\" height=\"10\"><input type=\"checkbox\" name=\"checkbox\" class=\"checkbox\">
       </td>
	         
       </td>

      <td id=\"lien1\" ><a href='view-new.php?author=". $row2['author']."&article=". $row['article']."&file=".$row['file']."&etat=".$row['id']."'><h4>". $row2['title']."</a></h4></td>
      <td width=\"150\"align=\"right\"><p>".$row4['fname']." ".$row4['lname']."</p></td>
	   <td width=\"10\" height=\"10\"><p>". $row['article']."</p>
       </td>
      <td width=\"80\" align=\"right\">".$row['date']."</td>
     
    </tr>
  ";


}


}else
   echo'<td align="center"><h4>Aucun Resultat...</h4></td>';

{
echo'</tbody>
</table>';	
	
	
	
	
	
	
	}



?>