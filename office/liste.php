<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>AJAM |Editor office  </title>
		<link rel="stylesheet" href="css/personel_space.css" type="text/css" />
</head>
<body>
<div id="header">
<div id="navbar">
<div class="h_left">
					<ul>
      	  				<li><a href="editor_home.html"><h2>Home</h2></a></li>
        				<li class="active"><a href="#"><h2>Articles</h2></a>
                            <ul>
								<li><a href="papers_list.html">Submitted Articles </a></li>
            					<li><a href="assign_to-editor.html">Assign to Editor</a></li>
								<li><a href="track_paper.html">Track Articles</a></li>
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
	<a href="#">
		<img src="profil.png"  width="26px" height="26px">
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
<h2 class="div-title">List of new submitted paper</h2>
</div>
<div id="forme">

<fieldset>
<table id="tableau" border="1"  width=100% style="max-width: 1024px;" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
          <th>Title</th>
            <th>Author</th>         
            <th>Submission date</th>
            
            
			<th>Details</th>
			<th>Download</th>
			
          </tr>
        </thead>
        
        
        <?php 
		include_once("../php/cnx.php");
		 $select = $conn->query("SELECT id,article,file, date FROM state_office  WHERE etat='new'");
		  if ($select->num_rows!=0) {
      
	  
	  while($row = $select->fetch_assoc()){
	 
	       $select2=$conn->query("SELECT title,author FROM article  WHERE id=".$row['article']."");
		    $select3=$conn->query("SELECT url FROM file  WHERE id=".$row['file']."");
			
	       $row2= $select2->fetch_assoc();
		   $row3= $select3->fetch_assoc();
		   $select4=$conn->query("SELECT fname,lname FROM personne  WHERE id=".$row2['author']."");
		     $row4= $select4->fetch_assoc();
		   echo'
        
          <tr class="light">
		  <td> '. $row2['title'].'</td>
            <td><a href="#">'.$row4['fname'].' '.$row4['lname'].'</a></td>
			<td>'.$row['date'].'</td> 
            						
				
			<td style="text-align: center;"><a href="afficherarticle.php?author='.$row2['author'].'&article='.$row['article'].'&file='.$row['file'].'&etat='.$row['id'].'">Read more</a></td>
			<td><a href="../pages/ihm-bd/Authors/files/'.$row2['author'].'/'. $row3['url'].'">download</a></td>
			
			
						

			</tr>
         
        ';
		   
		   
	 
	  }
    }
	
	
		
		
		
		
		
		?>
       
</table>
</fieldset>
<br/>
<br/>
</div>

</body>

     <!-- --------------------------------------------------------- Footer----------------------------------------------------------------- -->
  <div id="footer">
    <p>copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CSC)</a></p>
    
  </div>
   <!-- ---------------------------------------------------------end footer----------------------------------------------------------------- -->

</body>
</html>