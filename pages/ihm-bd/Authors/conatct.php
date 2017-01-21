<?php 
$id=9;

?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans nom</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/cssboot.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, intial-scale=1.0">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

</head>

<body>

<div class="container-fluid">
<div class="col-lg-12">
		<nav class ="navbar navbar-inverse">
        <div class ="navbar-header ">
 <a class ="navbar-brand " href ="#">AJAM </a>
</div>
			<ul class ="nav navbar-nav">
            <li class="divider"></li>
				<li class =" active "> <a href ="#"> Accueil </a> </li >
				<li> <a href ="#">About </a> </li >
				<li> <a href ="#">aimes ans scop </a> </li >
				<li> <a href ="#">Réfé rences </a> </li >
			</ul>
		<form class ="navbar-form pull-right ">
			<input type ="text" style =" width : 150px " class ="input-sm form-control " placeholder =" Recherche ">
			<button type ="submit" class ="btn btn-primary btn-sm">
		<span class =" glyphicon glyphicon-eye-open "></span > Chercher </button>
 		</form>
 		</nav>
        </div>
	</div>
<div class="container-fluid">
         <div class="col-xs-3">
         <div class="col-sm-12"><div id="detaille"><img src="../../../images/no-profile-img.gif">
         
         <div id="info">
         <label>name</label>
         
         </div>
         
         </div></div>
                 <div class="col-sm-12">  
         		<div class="panel panel-info">
          			<div class="panel-heading">
           				 <h3 class="panel-title text-center">Messages</h3>
          			</div>
        		<div class="list-group">
           			 <a href="#" class="list-group-item" id="inbox"><span class="glyphicon glyphicon-inbox"></span> 
            			  Inbox
             		 <span class="badge">120</span>
            		</a>
                    <a href="#" class="list-group-item">
            			  Contact us
             		 <span class="badge">120</span>
            		</a>
            
            	</div>
            	<div class="panel-heading">
           				 <h3 class="panel-title text-center">Articles:</h3>
          		</div>
                <div class="list-group">
           			 <a href="#" class="list-group-item">
            			 Track
             		 <span class="badge">120</span>
            		</a>
                     <a href="#" class="list-group-item">
            			Submit
             		 
            		</a>
            
            	</div>
                <div class="panel-heading">
           				 <h3 class="panel-title text-center">Profile:</h3>
          		</div>
                <a href="#" class="list-group-item"><span class="glyphicon glyphicon-edit"></span>
            			Edit 
             		 
            		</a>
                    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-log-out"></span>
            			log out 
             		 
            		</a>
          </div>
        </div></div>

<div class ="col-xs-9">
<div id="chargement"><img src="images/ajax-loader.gif" alt="" id="charg" /></div>
<div id="contenu">
<div id="table_contenu">
<form class ="col-lg-12">
		<legend >Cantact</legend >
			<div class ="form-group ">
                <label for="texte">OBJECT : </label>
                <input id=" text " type =" text " class ="form-control ">
			</div>
			<div class ="form-group ">
				<label for="textarea">TEXTE : </label>
				<textarea id="textarea" type ="textarea" rows="16" class ="form-control "></textarea></br>
                <button class ="pull-right btn btn-default ">Envoyer </button >
			 </div>
</form>
</div>
</div>
 </div>  
</div>

<script src="../../../jquery/jquery-2.1.3.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
	
    $('#table').DataTable(  ); 
	$("#chargement").hide();
	$("#inbox").click(function(){
		
		$("#table_contenu").remove();
		  
		$("#chargement").show();
		$.ajax({
								
								
								type:"POST",
								url:"php/res_inbox.php",
								data: {id:9 },async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").append(data);
									
									
									$('#table').DataTable();



									}});
		});
	
	
	
	
	
$("#inbox").click(function(){
	
	$("#table_contenu").remove();
		  
		$("#chargement").show();
	$.ajax({
		type:"POST",
		url:"php/cantact.php",
		success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").append(data);
									
									}
		
		});
	});
	
	
	
	
	
	
	
	
	
} );
</script>
</body>
</html>
