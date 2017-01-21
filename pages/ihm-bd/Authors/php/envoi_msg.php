<?php
 
include_once("cnx.php");
$select = $conn->query("INSERT  INTO messages (src,dist,msg,date,title) values(".$_POST['id'].",1,'".$_POST['msg']."',now(),'".$_POST['title']."' )");
if($select){
	echo'
	<div id="table_contenu">
	
	<h2>Confirmation</h2>
<p class = "lead">you have benn succefuly send</p>
	
	
	
	</div>
	
	
	';
	
	
	
	}else
	{
		echo "Error: <br>" . $conn->error;
		
		}
	?>