<?php
session_start();
if(!isset($_SESSION['id'])){

    header('Location: ../../login.html');

}
 
include_once("../../../../php/cnx.php");
$select = $conn->query("INSERT  INTO messages (src,dis,msg,date,title) values(".$_SESSION['id'].",1,'".$_POST['msg']."',now(),'".$_POST['title']."' )");
if($select){
	echo'
	<div id="table_contenu">
	
	<h2>Confirmation</h2>
<p class = "lead">your message have been successfully sent</p>
	
	
	
	</div>
	
	
	';
	
	
	
	}else
	{
		echo "Error: <br>" . $conn->error;
		
		}
	?>