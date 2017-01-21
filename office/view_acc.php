<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>AJAM | Editor-in-Chief </title>
		<link rel="stylesheet" href="css/personel_space.css" type="text/css" />
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <link href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet" />
        <link href="css/style2.css" rel="stylesheet" type="text/css">
        <script src="../pages/js/jquery-1.9.1.min.js"></script>

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
		<li class="selected"><a class="profile" href="officeHome.php?pseudo=new" id="new"><i class="icon-user"></i>New</a></li>
       
		<li ><a class="messages" href="officeHome.php?pseudo=accepted" ><i class="icon-envelope-alt"></i>Accepted<em>5</em></a></li>
		<li><a class="settings" href="#" ><i class="icon-cog"></i>Refused</a></li>
        <li class="menu"><p class="titre_menu"> Messages</p><li>
		<li><a class="logout" href="#"><i class="icon-signout"></i>Inbox</a></li>
        <li><a class="logout" href="#"><i class="icon-signout"></i>NEW</a></li>
         <li><a class="logout" href="#"><i class="icon-signout"></i>Send</a></li>
	</ul>
<?php

$conn= new mysqli('localhost','root','','ajam');
if ($conn->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
$idarticle=intval($_GET['article']);
  $select = $conn->query("SELECT author, title,type, area,abstract,keywords FROM article  WHERE id=".$idarticle."");
 if ($select->num_rows!=0) {
	  
	 $row = $select->fetch_assoc();
 }
	  
  $select3 = $conn->query("SELECT fname,lname FROM personne  WHERE id=".intval($row['author'])."");
 if ($select3->num_rows!=0) {
	  
	 $row3 = $select3->fetch_assoc();
 }
  
  
  ?>


<div id="corp_view">

<span class="titre_text">Auteur :</span><p class="paragraph_line"><?php echo $row3['fname']." ".$row3['lname']?></p></br></br>
<span class="titre_text">Titre :</span><p class="paragraph_line"><?php echo $row['title']?></p></br></br>
<span class="titre_text">Article type :</span><p class="paragraph_line"><?php echo $row['type']?></p></br></br>
<span class="titre_text">Area article :</span><p class="paragraph_line"><?php echo $row['area']?></p></br></br>
<span class="titre_text">Abstract :</span></br><p class="paragraph"><?php echo $row['abstract']?></p></br>
<span class="titre_text">Keyword :</span></br><p class="paragraph"><?php echo $row['keywords']?></p></br>
<?php 
$select2 = $conn->query("SELECT fname,lname,affiliation,adresse,email FROM co_author  WHERE article=".$idarticle."");
$i=1;
 while($row2 = $select2->fetch_assoc()){
	 
	 echo"
	 <span class=\"titre_text\">CO AUTEUR 1 :</span>
	<table width=\"90%\"  class=\"co_auteur\">
  <tbody>
    <tr>
      <td width=\"14%\" height=\"37\">First name :</td>
      <td width=\"33%\">".$row2['fname']."</td>
      <td width=\"13%\">last name :</td>
      <td width=\"40%\">".$row2['lname']."</td>
    </tr>
    <tr>
      <td height=\"37\">Affiliation :</td>
      <td>".$row2['affiliation']."</td>
      <td>Adresse :</td>
      <td>".$row2['adresse']."</td>
    </tr>
    <tr>
      <td height=\"37\">E-mail :</td>
      <td>".$row2['email']."</td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
	 ";
	 
	 
	 
	 }




?>


<?php 
$idfile=intval($_GET['file']);
  $select1 = $conn->query("SELECT url FROM file  WHERE id=".$idfile."");
  $row1 = $select1->fetch_assoc();
  echo  '<a href="../pages/ihm-bd/Authors/files/'.$_GET['author'].'/'. $row1['url'].'" class="bouton empty gris">DOWNLOAD FILE</a>';
  ?>

<hr>
<?php 
$idfile=intval($_GET['etat']);
  $select1 = $conn->query("SELECT date FROM state_office  WHERE id=".$idfile."");
  $row1 = $select1->fetch_assoc();
  echo"<span class=\"titre_text\">DATE ACCEPTATION :</span><p class=\"paragraph_line\">".$row1 ['date']."";
  ?>


</div>


     <!-- --------------------------------------------------------- Footer----------------------------------------------------------------- -->
  <div id="footer">
    <p>copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CSC)</a></p>
    
  </div>
  </body>
   <!-- ---------------------------------------------------------end footer----------------------------------------------------------------- -->



</body>
</html>