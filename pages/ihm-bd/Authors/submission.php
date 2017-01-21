<?php session_start();
//if(!isset($_SESSION['id']))
//{
//	header('Location: ../../login.html');
//}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>AJAM | User Account</title>
       
		<link rel="stylesheet" href="css/personel_space.css" type="text/css" />
		
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
</head>
<body>
<div id="header">
<div id="navbar">
<div class="h_left">
					<ul>
      	  				<li class="active"><a href="#"><h2>Home</h2></a></li>
        				<li><a href="#"><h2>Manuscript</h2></a></li>
                        <!--
                        	<ul>
            					<li><a href="#">Articles</a></li>
            					<li><a href="#">Articles Reviewv?</a></li>
          					</ul>-->
        				<li><a href="#"><h2>Journal</h2></a></li>      
        				<li><a href="#"><h2>About</h2></a></li>
        				<li ><a href="#"><h2></h2></a></li>
      				</ul>
					</div>
<div class="h_right">
<a href="#">
    <img src="profil.png"  width="26px" height="26px"></a></div>
</div>
</div>
<div id="forme">
<h2 class="div-title">Welcome <?php echo $_SESSION['fname']." ".$_SESSION['lname'];?></h2>
</div>
<form  method="post" action="php/uploadarticle.php" id="forme"  enctype="multipart/form-data">
<ul>
<h2 id="macro">Submission</h2>
</ul>
<ul id="progressbar">
<li class="active">Paper informations</li>
<li>About co-authors</li>
<li>The manuscript files</li>
<li>Validat informations</li>
</ul>
<fieldset>
<h2 class="div-title">Paper informations</h2>
<h3 class="div-subtitle">Step 1</h3>
<table border="0"  width="95%"   style="margin:10px 20px;" >
      					<tr>
       						<td width="17%">
         						<label for="title">Title <small style="color:#F00">*</small></label>
       						</td>
        					<td width="83%">
        						<textarea name="title_area"  rows="3" id="title"></textarea> </td>
                        </tr>
      					<tr>
        					<td>
                            <br/>
         						<label for="type_of_paper">Article Type<small style="color:#F00">*</small></label>
        					</td>
        					<td>
                            <br/>
        						<select name="type_of_paper"  id="type" >
									<option value="" >-- Please Select --</option>
                    				<option value='review'>Review article
            						<option value='regular'>Regular paper
									<option value="application">Application
									<option value="communication">Communication
									<option value="feature_article">Feature Article
									<option value="highlight">Highlight					
           						</select>
        					</td>
                        </tr>
        				<tr>
        					<td>
                            
         						<label for="area_of_article">Areas of Article <small style="color:#F00">*</small></label>
        					</td>
                           
        					<td>
                           
        						<select name="area_of_article" id="topics" >
									<option value="" >-- Please Select --</option>									
                                    <option value="biomaterials">Biomaterials
                                    <option value="catalysis_surface science">Catalysis/surface science
                                    <option value="ceramics">Ceramics
									<option value='chemical_properties'>Chemical properties
                                    <option value="electrical_magnetic_organic_materials">Electrical/magnetic organic materials
                                    <option value="electrical_magnetic_inorganic_materials">Electronic/ magnetic inorganic materials								
									<option value='inorganics_materials'>Inorganics materials
									<option value="liquid_crystals">Liquid crystals
									<option value='magnetic_properties'>Magnetic properties
                                    <option value="metals_and_alloys">Metals and Alloys
									<option value="nanotechnology">Nanotechnology                     
									<option value="optical_organic_materials">Optical organic materials
									<option value='optical_properties'>Optical properties
									<option value='organics_materials'>Organics materials
									<option value="polymers_composites">Polymers/composites
                                    <option value="Semiconductors">Semiconductors
									<option value='structural_properties'>Structural properties                                                                       
                                    <option value="sol-gel">Sol-gel
                                    <option value="solid_state_ionics">Solid state ionics
                                    <option value="theoretical">Theoretical
									<option value='thermodynamic_properties'>Thermodynamic properties
                                    <option value="thin_films">Thin films</option>                           
                                    
           						</select>
        					</td>
                        </tr>
        				<tr>
        					<td>
         					</td>
        					<td>
        						<label for="note"><small>The abstract length should be between 150 and 200 words *</small></label>
        					</td>
                        </tr>
        				<tr>
       						<td>
         						<label for="abstract">Abstract <small style="color:#F00">*</small></label>
       						</td>
        					<td>
        		 				<textarea id ="abstract" name="abstract_area"   rows="10"></textarea>
        					</td>
                        </tr>
  				<tr>
        					<td>
         					</td>
        					<td>
        						<label for="note"><small>Keywords should be separated by semicolons, e.g. electroceramics; metallic ; ceramics.</small></label>
        					</td>
                        </tr>
                        <tr>
        					<td>
                           
         						<label for="keywords">Keywords <small style="color:#F00">*</small></label>
        					</td>
        					<td>
                            
        						<textarea id="keywords" name="keywords"   rows="3"></textarea>
        					</td>
                        </tr>        
        		<tr>
       				<td>
         				<label for="number_co_authors">Number of co-authors<small style="color:#F00">*</small></label>
       				</td>
        			<td>
        				<input type="text" name="number_co_authors" size="20" id="nbr"/>
        			</td>
                </tr>
                         
                          
    				</table>
					
 <input class="next action-button" style=" float:right;" type="button" value="Next" name="next" id="step1_next">
<br/>
<br/>
</fieldset>
<fieldset id="co-author" class="co1">
<h2 class="div-title">About co-authors</h2>
<h3 class="div-subtitle">Step 2</h3>
<div id="apres1"></div>
<input class="previous action-button" style=" float:left;"type="button" value="Previous" name="previous" id="step2_previous">
<input class="next action-button" style=" float:right;" type="button" value="Next" name="next" id="step2_next">
<br/>
<br/>
</fieldset>
<fieldset>
<h2 class="div-title">The manuscrit files</h2>
<h3 class="div-subtitle">Please Attach Files</h3>
<input type="file" id="file" name="file[]" />
      <input type="button" value="Upload" id="submit1"/>
      <div id="uploaded_progress"><div></div></div><br/>
   


<input class="previous action-button" style=" float:left;" type="button" value="Previous" name="previous" id="step3_previous">
<input class="next action-button" style=" float:right;" type="button" value="Next" name="next" id="step3_next">
<br/>
<br/>
</fieldset>
<fieldset>
<h2 class="div-title">instead of validate</h2>
<h3 class="div-subtitle">Step 4</h3>
<div id="information">
<table width="855" border="0">
  <tbody>
    <tr>
      <td width="128"><label class="labelinformation">Titre :</label></td>
      <td width="717"><p  id="titre" >&nbsp;</p></td>
    </tr>
    <tr>
      <td><label class="labelinformation">Article type :</label></td>
      <td><p  id="articletype" >&nbsp;</p></td>
    </tr>
    <tr>
      <td><label class="labelinformation">Area of article :</label></td>
      <td><p  id="articlearea" >&nbsp;</p></td>
    </tr>
   
  </tbody>
</table>

  
  
  <label><h4 style="padding-left: 6px; font-style: italic; text-decoration: underline;">Abstract :</h4></label>
  <p class="text" id="abstractinfo" >&nbsp;</p>
   <label><h4 style="padding-left: 6px; font-style: italic; text-decoration: underline;">Keywords :</h4></label>
  <p class="text" id="keywordinfo" >&nbsp;</p>
  
  <div id="coapres1"></div>
</div>





<input class="previous action-button" style=" float:left;" type="button" value="Previous" name="previous" id="step4_previous">
<input class="submit action-button" style=" float:right;"  type="submit" value="Submit" name="submit" id="submit" onKeyPress="refuserToucheEntree(event);">
<br/>
<br/>
</fieldset>

</form>
<script src="js/stepbystep.js">

</script>
     <!-- --------------------------------------------------------- Footer----------------------------------------------------------------- -->
  <div id="footer">
    <p>Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CSC)</a></p>
    
  </div>
   <!-- ---------------------------------------------------------end footer----------------------------------------------------------------- -->

</body>
</html>