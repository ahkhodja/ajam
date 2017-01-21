<?php 
include_once("cnx.php");
setlocale(LC_TIME, "fr_FR");
$select = $conn->query("SELECT id, state,file, DATE_FORMAT(date, '%d %M') as date FROM state_author WHERE article=".$_POST['id']);

if($select->num_rows!=0){
	echo"<div id=\"table_contenu\">
<div class=\"panel panel-primary\">

  <table class=\"table table-striped table-condensed\">

    <div class=\"panel-heading\">

      <h3 class=\"panel-title text-center\">TRACK</h3>

    </div>

    <thead>

      <tr>

        <th width=\"80%\" class=\"text-center\">Status</th>

        <th class=\"text-center\">Date</th>
        <th class=\"text-center\">File</th>

      </tr>

    </thead>

    <tbody>";

while($row = $select->fetch_assoc()){

	$select2 = $conn->query("SELECT name FROM file WHERE id=".$row['file']);
	$row2 = $select2->fetch_assoc();
	if($row['state']=="validation"){

		echo"

      <tr>

        <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">".$row['state']."</div><a href=\"edit.php?a=".$_POST['id']."&e=".$row['id']."\"><button type=\"button\" class=\"btn btn-default\" style=\"float:right\">Edit</button></a><button type=\"button\" class=\"btn btn-default\" style=\"float:right\">Validate</button></td>

        <td class=\"text-center \"style=\"line-height:3;\">".$row['date']."</td>
        <td class=\"text-center \"><a href=\"php/download.php?ida=".$_POST['id']."&a=".$row2['name']."\"><button style=\"font-size:24px \"><i class=\"fa fa-file-pdf-o\"></i></button></a></td>

      </tr>


    ";
	}else{
	echo"

      <tr>

        <td class=\"text-center \"style=\"line-height:3;\">".$row['state']."</td>

        <td class=\"text-center\" style=\"line-height:3;\">".$row['date']."</td>
        <td class=\"text-center\"><a href=\"php/download.php?ida=".$_POST['id']."&a=".$row2['name']."\"><button style=\"font-size:24px\"><i class=\"fa fa-file-pdf-o\"></i></button></a></td>

      </tr>

      
    ";

	}
	
	}
echo"</tbody>

  </table>

</div>

</div>";
}