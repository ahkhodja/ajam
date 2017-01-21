<?php 
include_once("php/cnx.php");
$select = $conn->query("SELECT fname,lname,mname,affiliation,adresse,city,state,contry,pcode,phone,fax FROM personne WHERE id=9");
$row = $select->fetch_assoc()

?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans nom</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
<link href="css/cssboot2 .css" rel="stylesheet" type="text/css">
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
			<ul class ="nav navbar-nav menu">
            <li class="divider"></li>
				<li class =" active "> <a href ="#"> Accueil </a> </li >
				<li> <a href ="#">About </a> </li >
				<li> <a href ="#">Aimes and Scoop </a> </li >
				
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
         <div class="col-xs-3"></div>

<div class ="col-xs-9">

<div id="contenu">
<div id="table_contenu">
<p><h1>Confirmation</h1><p>


</div>
</div>
 </div>  
</div>

<script src="../../../jquery/jquery-2.1.3.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>

$('ul li a').click(

			function(e) {
				
				e.preventDefault(); // prevent the default action
				e.stopPropagation; // stop the click from bubbling
				$(this).closest('ul').find('.active').removeClass('active');
				$(this).parent().addClass('active');
			});
	


</script>
</body>
</html>
