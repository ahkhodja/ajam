<html>
<head>
<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>AJAM |Editor office </title>
		<link rel="stylesheet" href="css/personel_space.css" type="text/css" />
        <script src="js/jquery-1.8.1.min.js"></script>
</head>
<body>
<div id="header">
<div id="navbar">
<div class="h_left">
					<ul>
      	  				<li class="active"><a href="editor_home.html"><h2>Home</h2></a></li>
        				<li><a href="#"><h2>Articles</h2></a>
                            <ul>
								<li><a href="papers_list.html">Submitted Articles </a></li>
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
<h2 class="div-title">ARTICLE ID <?php echo $_GET['article'];?></h2>
</div>


<form  method="post" action="php/accepted.php" id="forme"  enctype="multipart/form-data">
<fieldset>
 <?php

$conn= new mysqli('localhost','root','','ajam');
if ($conn->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
$idarticle=intval($_GET['article']);
  $select = $conn->query("SELECT title,type, area,abstract,keywords FROM article  WHERE id=".$idarticle."");
 if ($select->num_rows!=0) {
	  
	 $row = $select->fetch_assoc();
 }
	  $idfile=intval($_GET['file']);
  $select1 = $conn->query("SELECT url FROM file  WHERE id=".$idfile."");
  $row1 = $select1->fetch_assoc();
  echo  '<a href="../pages/ihm-bd/Authors/files/'.$_GET['author'].'/'. $row1['url'].'">Download Paper</a>';
  
	 echo'
	 <input type="hidden" id="idauthor" value="'.$_GET['author'].'"/>
<table border="0"  width="91%"   style="margin:10px 20px;" >
      					<tr>
       						<td width="15%">
         						<label for="title">Title :</small></label>
       						</td>
        					<td width="85%">
        						<textarea name="title_area" cols="80"  rows="3" id="title" >'.$row['title'].'</textarea> </td>
                                
        				</tr>
      					<tr>
        					<td>
                            
         						<label for="type_of_paper">Article Type :</small></label>
        					</td>
        					<td>
                            
							<textarea name="title_area" cols="80"  rows="2" id="title" >'.$row['type'].'</textarea>
                            </td>
                            
        				</tr>
        				<tr>
        					<td>
                            
         						<label for="area_of_article">Areas of Article :</label>
        					</td>
                           
        					<td>
							<textarea name="title_area" cols="80"  rows="2" id="title" >'.$row['area'].'</textarea>
							</td>
                            
        				</tr>
        				<tr>
       						<td>
         						<label for="abstract">Abstract :</label>
       						</td>
        					<td>
        		 				<textarea name="abstract_area" cols="80"   rows="10" id ="abstract">'.$row['abstract'].'</textarea>
        					</td>
                           
        				</tr>
                        <tr>
        					<td>
                           
         						<label for="keywords">Keywords :</label>
        					</td>
        					<td>
                            
        						<textarea name="keywords" cols="80"   rows="3" id="keywords">'.$row['keywords'].'</textarea>
        					</td>
                            
        				
                        </tr>
                         
                          
    				
';
	 
	 

  
  
	
	 
	 
	 
 
echo'<tr>
        					<td>
                           <label for="decision">Decision :</label>
         					
        					</td>
        					<td>
                            
        						<select name="decision" id="decision">
  <option value="">-- Please Select --</option>
  <option value="accepted">Accepted</option>
  <option value="refused">Refused</option>



</select>
        					</td>
                            
        				
                        </tr>
  
 
 
  </table>
   
   ';
  
  
?> 

 <div id="accepted">
 <table border="0"  width="91%"   style="margin:10px 20px;" >
  <tbody>
    <tr>
      <td width="15%"><label for="keywords">File :</small></label></td>
      <td width="85%"><input type="file" id="file" name="file[]" /><input type="button" value="Upload" id="submit1"/> </td>
    </tr>
    
  </tbody>
</table>

 	
 <canvas id="my_canvas" width="70" height="70" ></canvas>
 <input class="submit action-button" style=" float:right;"  type="submit" value="Validate" name="submit" id="submit">
 </div>
 <div id="refused"> <input class="submit action-button" style=" float:right;"  type="submit" value="Validate" name="submit" id="submit1"></div>
</fieldset>


</form>
<script src="js/afficherarticle - Copie.js"></script>
</body>

     <!-- --------------------------------------------------------- Footer----------------------------------------------------------------- -->
  <div id="footer">
    <p>copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CSC)</a></p>
    
  </div>
   <!-- ---------------------------------------------------------end footer----------------------------------------------------------------- -->

</body>
</html>