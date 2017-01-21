<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>AJAM | Editor-in-Chief </title>
		<link rel="stylesheet" href="css/personel_space.css" type="text/css" />
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet" />
        <script src="../pages/js/jquery-1.9.1.min.js"></script>
 <script type="text/javascript">
$(window).load(function() {

	
})
</script>       
</head>
<body>
<div id="header">
<div id="navbar">
<div class="h_left">
					<ul>
      	  				<li class="active"><a href="editor_home.php"><h2>Home</h2></a></li>
        				<li><a href="#"><h2>Articles</h2></a>
                            <ul>
								<li><a href="papers_list.php">Submitted Articles </a></li>
            					<li><a href="assign_to-editor.html">Assign to Editor</a></li>
								<li><a href="track_paper.html">Track Articles</a></li>
          					</ul>
                        </li>
        				<li ><a href="#"><h2>Editors</h2></a>
							<ul>
            					<li><a href="associate_editors.html">Associate Editors</a></li>
            					<li><a href="add_editor.html">Add Editor</a></li>
								<li><a href="update_editors_list.html">Update Editors</a></li>
								<li><a href="editor_decision.html">Editor Approval</a></li>
          					</ul>
						</li>									
        				<li><a href="#"><h2>About</h2></a>
							<ul>
            					<li><a href="about_journal.html">The journal</a></li>
            					<li><a href="ethical_guidelines.html">Ethical Guidelines</a></li>
								<li><a href="editor_support.html">Site Support</a></li>
          					</ul>
						</li>
      				</ul>
					</div>
<div class="h_right">
<li class="h_right">
	
		<img src="profil.png"  width="26px" height="26px"><a href="#">Welcome Mr. Aourag
	</a>
	<ul>
    	<li><a href="account_informations.html">Change details</a></li>
    	<li><a href="login.html">Logout</a></li>
    </ul>
</li>
</div>
</div>
</div>
<div id="forme">
<h2 class="div-title">Welcome Office</h2>
</div>


	<ul class="form">
    <li class="menu"><p class="titre_menu"> Article befor revision</p><li>
		<li class="selected"><a class="profile" href="#" id="new"><i class="icon-user"></i>New</a></li>
       
		<li ><a class="messages" href="#" id="accepted"><i class="icon-ok"></i>Accepted<em>5</em></a></li>
		<li><a class="settings" href="#" id="refused"><i class="icon-cog"></i>Refused</a></li>
        <li class="menu"><p class="titre_menu"> Messages</p><li>
		<li><a class="logout" href="#"><i class="fa-inbox:"></i>Inbox</a></li>
        <li><a class="logout" href="#"><i class="icon-signout"></i>NEW</a></li>
         <li><a class="logout" href="#"><i class="icon-signout"></i>Send</a></li>
	</ul>



<div id="corp">

<div id="contenu">
  <div id="chargement"><img src="images/chargement.gif" alt="" /></div>
  <?php 
  if(isset($_GET['pseudo'])){
	  switch ($_GET['pseudo']) {
    case 'new':
        $lien='view-new.php';
        break;
    case 'accepted':
         $lien='view-_acc.php';
        break;
    
}
  include_once("php/cnx.php");
  $select = $conn->query("SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_office  WHERE etat='".$_GET['pseudo']."'");
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

      <td id=\"lien1\" ><a href='".$lien."?author=". $row2['author']."&article=". $row['article']."&file=".$row['file']."&etat=".$row['id']."'><h4>". $row2['title']."</a></h4></td>
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
	
	
	
	
	
	
	}}


  
  
  
  
  
  ?>
  
   </div>

</div>


</body>

     <!-- --------------------------------------------------------- Footer----------------------------------------------------------------- -->
  <div id="footer">
    <p>copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CSC)</a></p>
    
  </div>
   <!-- ---------------------------------------------------------end footer----------------------------------------------------------------- -->
<script type="text/javascript">

$(document).ready(function() {
		$("#chargement").hide();
		$('ul.form li a').click(
			function(e) {
				e.preventDefault(); // prevent the default action
				e.stopPropagation; // stop the click from bubbling
				$(this).closest('ul').find('.selected').removeClass('selected');
				$(this).parent().addClass('selected');
			});
	});
	
	$("#new").click(function(){
		$("#principale").remove();
		$("#chargement").show();
	$.ajax({
								
								
								type:"POST",
								url:"php/resultat.php",
								data: {pseudo: "new"},async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").after(data);
									$('.lien').on('click', function(e) {
										e.stopPropagation();
 alert($(':nth-child(4)',this).text());
});
									}});
	
	
	
	
	});
	$("#accepted").click(function(){
		$("#principale").remove();
		$("#chargement").show();
	$.ajax({
								
								
								type:"POST",
								url:"php/resultatAR.php",
								data: {pseudo: "accepted"},async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").after(data);
									
									}});
	
	
	
	
	});
		$("#refused").click(function(){
		$("#principale").remove();
		$("#chargement").show();
	$.ajax({
								
								
								type:"POST",
								url:"php/resultatAR.php",
								data: {pseudo: "refused"},async:false,
								success:function(data)
								{
									$("#chargement").hide();
									
									$("#contenu").after(data);
									
									}});
	
	
	
	
	});
	
	
</script>

</body>
</html>