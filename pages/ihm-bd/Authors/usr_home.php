<?php
$contenu="";
session_start();
if(!isset($_SESSION['id'])){
	
	 header('Location: ../../login.html');
	
	}
	
	if(isset($_GET['a'])) {
        if($_GET['a']=='t'){


        include_once("php/cnx.php");
        $select = $conn->query("SELECT etiquette,id,title,type,area,state, DATE_FORMAT(date, '%d-%m-%Y') as datee FROM article WHERE author=" . $_SESSION['id']." ORDER BY date DESC");
        if($select){
			$contenu = $contenu . "
<div id=\"table_contenu\">
<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='12%'>Id</th>
                <th >Title</th>

                <th width='10%'>Date</th>
                <th width='15%' >Status</th>
            </tr>
        </thead>
		<tbody>
";
			if (mysqli_num_rows($select) != 0) {

            while ($row = $select->fetch_assoc()) {

                $contenu = $contenu . "
	   <tr>
                <td class='font_10'>" . $row['etiquette'].sprintf('%04d',$row['id']) . "</td>
                <td><a href=\"php/track.php?id=" . $row['id'] . "\" class=\"lien\">" . $row['title'] . "</a></td>

                <td>" . $row['datee'] . "</td>
                <td>" . $row['state'] . "</td>
        </tr>
  ";


            }


        }else{
$contenu = $contenu . "<td colspan=4>There are no manuscript in this list.</td>";

			}
			$contenu = $contenu . '</tbody>
</table></div>';

		} else {
            echo "
	
	
	";


        }
    }

    }
if(isset($_GET['t'])&&(!empty($_GET['t']))) {


	$id_article=intval($_GET['t']);
	include_once("php/cnx.php");
	$select = $conn->query("SELECT etiquette FROM article WHERE id=".$id_article);
	if (mysqli_num_rows($select) != 0) {
		$row = $select->fetch_assoc();
		$contenu="<p>
Your manuscript : “".$row['etiquette'].$id_article."” is succesfully submited, It should be approved by yourself .</p>";
	} else {
		echo "
	
	
	";


	}


}
if(isset($_GET['e'])&&(!empty($_GET['e']))) {


	$id_article=intval($_GET['e']);
	include_once("php/cnx.php");
	$select = $conn->query("SELECT etiquette FROM article WHERE id=".$id_article);
	if (mysqli_num_rows($select) != 0) {
		$row = $select->fetch_assoc();
		$contenu="<p>Your manuscript :\"".$row['etiquette'].$id_article."\" is succesfully approuved.</p>";
	} else {
		echo "
	
	
	";


	}


}


?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Author Account</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
<link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/cssboot.css" rel="stylesheet" type="text/css">
    <link href="css/usr_home.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<script src="../../../jquery/jquery-2.1.3.js"></script>
	<script src="../../../bootstrap/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


<![endif]-->

</head>

<body>
<input type="hidden" id="ident" value="<?php echo $_SESSION['id'] ?>"/>

<div class="container-fluid ">
<div class="col-lg-12 ">
		<nav class ="navbar navbar-inverse">
        <div class ="navbar-header ">
 <a class ="navbar-brand " href ="usr_home.php?a=t">Author Account</a>
</div>
			<ul class ="nav navbar-nav ">
            <li class="divider"></li>
				<li class =" active "> <a href ="usr_home.php?a=t"> Home </a> </li >
				<li> <a href ="#">Ethics </a> </li >
				<li> <a href ="#">Author Guidelines</a> </li >

			</ul>
          <div class="pull-right log-out"> <a href="../../../php/log_out.php" id="log-out"> <img src="images/1480521556_logout.png"> Sign out</a></div>
 		</nav>
        </div>
	</div>
<div class="container-fluid">
         <div class="col-xs-3">
         <div class="col-sm-12">
			 <div class="row profile">
				 <div class="col-sm-4 pading_left">
					 <img src="images/profile.png" id="profile">
				 </div>
				 <div class="col-sm-7 pading_profile text_moyen">
					 <div class="form-group">
						 <div class="row min_height">
							 <label class="col-lg-6 control-label no_padding" for="text">First name : </label>
							 <label class="col-lg-6 control-label no_padding text_label" for="text"><?php echo $_SESSION['fname']; ?> </label>
						 </div>
						 <div class="row min_height">
							 <label class="col-lg-6 control-label no_padding" for="text">Last name : </label>
							 <label class="col-lg-6 control-label no_padding text_label" for="text"><?php echo $_SESSION['lname']; ?> </label>
						 </div>
						 <div class="row min_height">
							 <label class="col-lg-6 control-label no_padding" for="text">Grade : </label>
							 <label class="col-lg-6 control-label no_padding text_label" for="text"><?php echo $_SESSION['grade']; ?> </label>
						 </div>

					 </div>

				 </div>
			 </div>
		   <div class="row menu_principale">
         		<div class="panel panel-info panel_perso">
          			
            		<div class=" head_perso panel-heading ">
           				 <h3 class="panel-title im"><i class ="fa  fa-file-text-o fa-1x "></i>&nbsp;ARTICLES</h3>
          			</div>
                	<div class="list-group">
           			 	<a href="usr_home.php?a=t" id="track" class="list-group-item liste_perso">
            				<i class ="fa   fa-search fa-2x "></i>&nbsp; Track Paper
             		 
            			</a>
                    	 <a href="submission_new.php" target="_blank" class="list-group-item liste_perso">
            				<i class ="fa    fa-upload fa-2x "></i>&nbsp; &nbsp;Submit
             		 
						 </a>
            
            		</div>
                <div class="panel-heading head_perso">
           				 <h3 class="panel-title im"><i class ="fa  fa-envelope fa-1x "></i>&nbsp;MESSAGES</h3>
          			</div>
        		<div class="list-group">
           			 <a href="#" class="list-group-item liste_perso" id="inbox">
            		<i class ="fa  fa-inbox fa-2x "></i>	  &nbsp;Inbox
             		 
            		</a>
                    <a href="#"  class="list-group-item liste_perso" id="contact">
            			  <i class ="fa  fa-envelope fa-2x "></i>&nbsp;Contact us
             		 
            		</a>
            
            	</div>
                <div class="panel-heading head_perso">
           				 <h3 class="panel-title im"><i class ="fa fa-user fa-1x"></i>&nbsp;PROFILE</h3>
          		</div>
                <a href="#" class="list-group-item liste_perso" id="edit">
            			<i class ="fa  fa-edit fa-2x "></i>&nbsp; Edit Informations
             		 
            		</a>
                    
          </div>
		   </div>
        </div></div>

<div class ="col-xs-9">
<div id="chargement" style="display: none"><img src="images/ajax-loader.gif" alt="" id="charg" /></div>
<div id="contenu">
<?php  echo $contenu?>
</div>
 </div>

  <footer class="row col-sm-12">

          <p class="footer_perso text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

      </footer>
</div>
<script>
$(document).ready(function() {
	ident=parseInt($('#ident').val());

	$("#chargement").hide();
	$('#table').dataTable( {
		"language": {
			"lengthMenu": "Display _MENU_ records per page",
			"zeroRecords": "No article available",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "No article available",
			"infoFiltered": "(filtered from _MAX_ total articles)"
		},
		"order": [2,'desc'],
		"lengthChange": false,
		"iDisplayLength": 10
	} );

	$("#inbox").click(function(){
		
		$("#table_contenu").remove();
		  
		$("#chargement").show();
		$.ajax({
								
								
								type:"POST",
								url:"php/res_inbox.php",
								data: {id:ident },async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").append(data);
									
									
									//$('#table').DataTable();



									}});
		});
	
	
	
	
	
	
	$("#contact").click(function(){
	
	$("#table_contenu").remove();
		  
		$("#chargement").show();
	$.ajax({
		type:"POST",
		url:"php/cantact.php",
		success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").append(data);
						$('#envoyer').on('click', function(e) {
							
							 textarea=$('#textarea').val();
							 title =$('#text').val();
							e.stopPropagation(e);
							$("#table_contenu").remove();
							$("#chargement").show();
							$.ajax({
								
								
								type:"POST",
								url:"php/envoi_msg.php",
								data: {id:ident,msg:textarea,title:title },async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").append(data);
									
									
									



									}});
							
							
							
							 return false;
							 
							 
							 
							 
							 

});
}
		
		});
	});

$("#edit").click(function(){
		
		$("#table_contenu").remove();
		  
		$("#chargement").show();
		$.ajax({
								
								
								type:"POST",
								url:"php/edit_profile.php",
								data: {id:ident },async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").append(data);
									
									$('#submit-edit').on('click', function(e) {
										e.stopPropagation(e);
										affiliation=$('#affiliation').val();
										$.ajax({
								type:"POST",
								url:"php/update_profile.php",
								data: {affiliation:affiliation,adresse:$('#adresse').val(),city:$('#city').val(),state:$('#state').val(),contry:$('#contry').val(),pcode:$('#pcode').val(),Phone:$('#Phone').val(),fax:$('#fax').val() },async:false,
								success:function(data)
								{
									$("#table_contenu").remove();
									$("#contenu").append(data);
									
									}});return false;
										
										
										
										
										});
									



									}});
		});
		$('.lien1').on('click', function(e) {
										e.stopPropagation();
										$("#table_contenu").remove();
		  
										$("#chargement").show();
									id=parseInt($('td:nth-child(1)',$(this).closest('tr')).text());
									$.ajax({
								
								
								type:"POST",
								url:"php/detaille_track.php",
								data: {id:id },async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").append(data);
									
									
									



									}});	
										
 return false;
});
$('ul li a').click(

			function() {
				
				 // stop the click from bubbling
				$(this).closest('ul').find('.active').removeClass('active');
				$(this).parent().addClass('active');
			});
} );
</script>
</body>
</html>
