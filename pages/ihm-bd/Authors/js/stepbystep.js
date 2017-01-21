var current_div, next_div, previous_div, nbr_co_authors , first=true,uploaded=false,valide=true;
 //divs
 function progressbar(percent, $element) {
        var progressBarWidth = percent * $element.width() / 100;
        $element.find('div').animate({ width: progressBarWidth }, 0).html(percent + "% ");}
 
 
 
 
 
 //--------------------------
function refuserToucheEntree(event)
{
    // Compatibilité IE / Firefox
    if(!event && window.event) {
        event = window.event;
    }
    // IE
    if(event.keyCode == 13) {
        event.returnValue = false;
        event.cancelBubble = true;
    }
    // DOM
    if(event.which == 13) {
        event.preventDefault();
        event.stopPropagation();
    }
}
$("#step1_next").click(function(){
	//
	valide=true;
	current_div = $(this).parent();
	if($("#title").val()==""){
		//alert($('#title_area').val());
		$("#titre").text('ahmed');
				$("#title").css("border-color","#ff0000");
				$("#erreur_title").fadeIn().text("Please enter the title of manuscript you wish to submit");
				 valide=false;
				 window.location.hash='#title';
				}
					else
					{
						$("#erreur_title").fadeOut();
						$("#title").css("border-color","#15ED34");
					}	
						
					
					// Type of manuscript
					if($("#type").val()==""){
				$("#type").css("border-color","#ff0000");
				$("#erreur_type_of_paper").fadeIn().text("Please select the type of manuscript you wish to submit ");
				 valide=false;
				 window.location.hash='#type';
				}else 
					{
						$("#erreur_type_of_paper").fadeOut();
						$("#type").css("border-color","#15ED34");
						
						
					}
					//Topics of manuscript
					
					if($("#topics").val()==""){
				$("#topics").css("border-color","#ff0000");
				$("#erreur_area_of_article").fadeIn().text("Please select the topics of manuscript you wish to submit ");
				 valide=false;
				 window.location.hash='#topics';
				}else 
					{
						$("#erreur_area_of_article").fadeOut();
						$("#topics").css("border-color","#15ED34");
						
						
					}
					
					//abstract
					if($("#abstract").val()==""){
				$("#abstract").css("border-color","#ff0000");
				$("#erreur_abstract").fadeIn().text("Please enter the abstract of manuscript you wish to submit");
				 valide=false;
				 window.location.hash='#title';
				}else 
					{
						$("#erreur_abstract").fadeOut();
						$("#abstract").css("border-color","#15ED34");
						
						
					}
					//keywords
					if($("#keywords").val()==""){
				$("#keywords").css("border-color","#ff0000");
				$("#erreur_keywords").fadeIn().text("Please enter the keywords of manuscript you wish to submit");
				 valide=false;
				 window.location.hash='#title';
				}else 
					{
						$("#erreur_keywords").fadeOut();
						$("#keywords").css("border-color","#15ED34");
						
						
					}
					//
					//nombre co authors
					if($("#nbr").val()==""){
				$("#nbr").css("border-color","#ff0000");
				$("#erreur_nbr").fadeIn().text("Please enter the number of co-authors");
				 valide=false;
				 window.location.hash='#title';
				}else if(!$("#nbr").val().match(/^[0-9]+$/i))
				{
					$("#nbr").css("border-color","#ff0000");
				$("#erreur_nbr").fadeIn().text("error the value is not valide");
				valide=false;
					}
					else
					{
						$("#erreur_nbr").fadeOut();
						$("#nbr").css("border-color","#15ED34");
								nbr_co_authors =parseInt($("#nbr").val());
					}
		if(valide==true){
							for(var i=1;i<=nbr_co_authors;i++){
							$("#apres"+i+"").after("<div class=\"div-subtitle\"id=\"coa"+(i)+"\"><h3 class=\"div-subtitle\">Co-Author -"+(i)+"-</h3><table border=\"0\"  width=\"95%\"   style=\"margin:10px 30px;\"><tr><td><label for=\"first_name\">First Name <small style=\"color:#F00\">*</small></label></td><td><input type=\"text\" name=\"first_name"+(i)+"\"  size=\"40\" id=\"fnco"+(i)+"\" /></td><td><div class=\"erreur\" id=\"erreur_fnco"+(i)+"\"></div></td></tr><tr><td><label for=\"middle_name\">Middle Name</label></td><td><input type=\"text\" name=\"middle_name"+(i)+"\" size=\"40\" id=\"mnco"+(i)+"\" /></td><td><div class=\"erreur\" id=\"erreur_mnco"+(i)+"\"></div></td></tr><tr><td><label for=\"last_name\">Last Name <small style=\"color:#F00\">*</small></label></td><td><input type=\"text\" name=\"last_name"+(i)+"\"  size=\"40\" id=\"lnco"+(i)+"\" /></td><td><div class=\"erreur\" id=\"erreur_lnco"+(i)+"\"></div></td></tr><tr><td><label for=\"affiliation\">Affiliation <small style=\"color:#F00\">*</small></label></td><td><input type=\"text\" name=\"affiliation"+i+"\"  size=\"40\" id=\"afco"+(i)+"\" /></td><td><div class=\"erreur\" id=\"erreur_afco"+(i)+"\"></div></td></tr><tr><td><label for=\"address\">Address<small style=\"color:#F00\"> *</small></label></td><td><input type=\"text\" name=\"address-1"+(i)+"\"  size=\"60\" id=\"adco"+(i)+"\" /></td><td><div class=\"erreur\" id=\"erreur_adco"+(i)+"\"></div></td></tr><tr><td></td><td><input type=\"text\" name=\"address-2"+(i)+"\"  size=\"60\" id=\"addco"+(i)+"\" /></td><td><div class=\"erreur\" id=\"erreur_addco"+(i)+"\"></div></td><td><div class=\"erreur\" id=\"erreur_afco"+(i)+"\"></div></td></tr><tr><td><label for=\"E-mail\">E-mail<small style=\"color:#ff5353\"> *</small></label></td><td><input type=\"text\" name=\"e-mail"+(i)+"\"  size=\"40\" id=\"emco"+(i)+"\" /></td><td><div class=\"erreur\" id=\"erreur_emco"+(i)+"\"></div></td></tr></table> </div><div id=\"apres"+(i+1)+"\"></div>"); }
						
						next_div = $(this).parent().next();
						//activate next step on progressbar using the index of next_div
						$("#progressbar li").eq($("fieldset").index(next_div)).addClass("active");
						next_div.show(); 
						current_div.hide();
						easing: 'easeInOutBack'	
						if(nbr_co_authors==0){
						current_div = $('#step2_next').parent();
						next_div = $('#step2_next').parent().next();
						//activate next step on progressbar using the index of next_div
						$("#progressbar li").eq($("fieldset").index(next_div)).addClass("active");
						next_div.show(); 
						current_div.hide();
						easing: 'easeInOutBack'	
						}}
							
							
							

						
					
					
	
});

$("#step2_next").click(function(){
	
	if(nbr_co_authors!=0){
	for(var i=1;i<=nbr_co_authors;i++){
	//first name--------------------------------------------------------------------
	if($("#fnco"+i+"").val()==""){
				$("#fnco"+i+"").css("border-color","#ff0000");
				$("#erreur_fnco"+i+"").fadeIn().text("Please enter the first name of co-auhor"+i+"");
				 valide=false;
				 window.location.hash='#fnco'+i+'';
				}else if(!$("#fnco"+i+"").val().match(/^[a-z]+$/i))
				{
					$("#fnco"+i+"").css("border-color","#ff0000");
				$("#erreur_fnco"+i+"").fadeIn().text("Please enter a validate first name of co-auhor"+i+"");
				valide=false;
					}
					else
					{
						$("#erreur_fnco"+i+"").fadeOut();
						$("#fnco"+i+"").css("border-color","#15ED34");
						
						
					}
	//middele name---------------------------------------------------------------------
					if($("#mnco"+i+"").val()!=""){
					if(!$("#mnco"+i+"").val().match(/^[a-z]+$/i)){
				$("#mnco"+i+"").css("border-color","#ff0000");
				$("#erreur_mnco"+i+"").fadeIn().text("Please enter a validate middele name of co-auhor"+i+"");
				 valide=false;
				 window.location.hash='#mnco'+i+'';
				}else 
					{
						$("#erreur_mnco"+i+"").fadeOut();
						$("#mnco"+i+"").css("border-color","#15ED34");
						
						
					}}
//last name--------------------------------------------------------------------
					if($("#lnco"+i+"").val()==""){
				$("#lnco"+i+"").css("border-color","#ff0000");
				$("#erreur_lnco"+i+"").fadeIn().text("Please enter last name of co-auhor"+i+"");
				 valide=false;
				 window.location.hash='#lnco'+i+'';
				}else if(!$("#lnco"+i+"").val().match(/^[a-z]+$/i))
				{
					$("#lnco"+i+"").css("border-color","#ff0000");
				$("#erreur_lnco"+i+"").fadeIn().text("Please enter a validate last name of co-auhor"+i+"");
				valide=false;
					}
					else
					{
						$("#erreur_lnco"+i+"").fadeOut();
						$("#lnco"+i+"").css("border-color","#15ED34");
						
						
					}
//affiliation --------------------------------------------------------------------
					if($("#afco"+i+"").val()==""){
				$("#afco"+i+"").css("border-color","#ff0000");
				$("#erreur_afco"+i+"").fadeIn().text("Please enter affiliation of co-auhor"+i+"");
				 valide=false;
				 window.location.hash='#afco'+i+'';
				}else if(!$("#afco"+i+"").val().match(/^[a-z]+$/i))
				{
					$("#afco"+i+"").css("border-color","#ff0000");
				$("#erreur_afco"+i+"").fadeIn().text("Please enter a validate affiliation ");
				valide=false;
					}
					else
					{
						$("#erreur_afco"+i+"").fadeOut();
						$("#afco"+i+"").css("border-color","#15ED34");
						
						
					}
					//----email
					if($("#emco"+i+"").val()==""){
				$("#emco"+i+"").css("border-color","#ff0000");
				$("#erreur_emco"+i+"").fadeIn().text("Please enter email of co-auhor"+i+"");
				 valide=false;
				 window.location.hash='#emco'+i+'';
				}else if(!$("#emco"+i+"").val().match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/))
				{
					$("#emco"+i+"").css("border-color","#ff0000");
				$("#erreur_emco"+i+"").fadeIn().text("Please enter a validate email ");
				valide=false;
					}
					else
					{
						$("#erreur_emco"+i+"").fadeOut();
						$("#emco"+i+"").css("border-color","#15ED34");
						
						
					}
// address--------------------------------------------------------------------
					if($("#adco"+i+"").val()==""){
				$("#adco"+i+"").css("border-color","#ff0000");
				$("#erreur_adco"+i+"").fadeIn().text("Please enter address of co-auhor"+i+"");
				 valide=false;
				 window.location.hash='#adco'+i+'';
				}else if($("#addco"+i+"").val()!=""){
					
						$("#adco"+i+"").css("border-color","#15ED34");
							
					}else{
						current_div = $(this).parent();
						next_div = $(this).parent().next();
	//activate next step on progressbar using the index of next_div
	$("#progressbar li").eq($("fieldset").index(next_div)).addClass("active");
	next_div.show(); 
	current_div.hide();
	easing: 'easeInOutBack'
						}

				
	}}else{current_div = $(this).parent();
						next_div = $(this).parent().next();
	//activate next step on progressbar using the index of next_div
	$("#progressbar li").eq($("fieldset").index(next_div)).addClass("active");
	next_div.show(); 
	current_div.hide();
	easing: 'easeInOutBack'}//fin for
	
	
					
	
});

$("#step3_next").click(function(){
	if(uploaded==true){
		$('#titre').text($('#title').val());
		$('#articletype').text($('#type').val());
	$('#articlearea').text($('#topics').val());	
	$('#abstractinfo').text($('#abstract').val());
	$('#keywordinfo').text($('#abstract').val());
	for(var i=1;i<=nbr_co_authors;i++){
							$("#coapres"+i+"").after("<div id=\"coinf"+(i)+"\"><label><h4 style=\"padding-left: 6px; font-style: italic; text-decoration: underline;\">Co-Auteur 1 :</h4></label><table width=\"452\" class=\"coauteurinfo\"><tbody><tr><td width=\"111\">First name :</td><td width=\"329\"><p id=\"cofname"+(i)+"\"></p></td></tr><tr><td>Last name :</td><td><p id=\"colname"+(i)+"\"></p></td></tr><tr><td>Affiliation :</td><td><p id=\"coaffiliation"+(i)+"\"></p></td></tr><tr><td>Adresse :</td><td><p id=\"coadresse"+(i)+"\"></p></td></tr><tr><td>E-mail :</td><td><p id=\"coemail"+(i)+"\"></p></td></tr></tbody></table></div><div id=\"coapres"+(i+1)+"\"></div>");
							$("#cofname"+(i)).text($("#fnco"+(i)).val());	
							$("#colname"+(i)).text($("#lnco"+(i)).val());	
							$("#coaffiliation"+(i)).text($("#afco"+(i)).val());	
							$("#coadresse"+(i)).text($("#adco"+(i)).val());	
							$("#coemail"+(i)).text($("#emco"+(i)).val());
							}
							
							
							
							
							
	current_div = $(this).parent();
	next_div = $(this).parent().next();
	//activate next step on progressbar using the index of next_div
	$("#progressbar li").eq($("fieldset").index(next_div)).addClass("active");
	next_div.show(); 
	current_div.hide();
	easing: 'easeInOutBack'
	
	}else

	{
		$('#file').css("border-color","#ff0000");
		
		}
});


$("#step2_previous").click(function(){
	
	nbr_co_author =parseInt($("#nbr").val());

   for(var i=1;i<=nbr_co_author;i++){
	   $("#coa"+i).remove();
	   
	   
	   
	   }
	current_div = $(this).parent();
	previous_div = $(this).parent().prev();
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_div)).removeClass("active");
	previous_div.show(); 
	current_div.hide();
	easing: 'easeInOutBack'
	window.location.hash='#macro';
});
$("#step3_previous").click(function(){
	current_div = $(this).parent();
	previous_div = $(this).parent().prev();
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_div)).removeClass("active");
	previous_div.show(); 
	current_div.hide();
	easing: 'easeInOutBack'
	if(nbr_co_authors==0){
						current_div = $('#step2_next').parent();
						next_div = $('#step2_next').parent().prev();
						//activate next step on progressbar using the index of next_div
						$("#progressbar li").eq($("fieldset").index(next_div)).addClass("active");
						next_div.show(); 
						current_div.hide();
						easing: 'easeInOutBack'	
						}
});
$("#step4_previous").click(function(){
	nbr_co_author =parseInt($("#nbr").val());
	for(var i=1;i<=nbr_co_author;i++){
	   $("#coinf"+i).remove();
	   
	   
	   
	   }
	current_div = $(this).parent();
	previous_div = $(this).parent().prev();
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_div)).removeClass("active");
	previous_div.show(); 
	current_div.hide();
	easing: 'easeInOutBack'
});

function getExtension(filename)
    {
        var parts = filename.split(".");
        return (parts[(parts.length-1)]);
    }
function verifFileExtension(champ,listeExt)
    {
	filename = document.getElementById(champ).value.toLowerCase();
	fileExt = getExtension(filename);
	for (i=0; i<listeExt.length; i++)
	{
		if ( fileExt == listeExt[i] ) 
		{
			$('#file').css("border-color","");
			return true;
		}
	}
	alert("You must select a rar/zip file");
	$('#file').css("border-color","#ff0000");
	return false;
     }



var handleUpload=function(event){
	event.preventDefault();
	event.stopPropagation();
	extensionsValides=new Array('rar','zip');
	
	
	var fileInput=document.getElementById('file');
	
	var resultat=verifFileExtension('file',extensionsValides);
	if(resultat==true){
	
	var data= new FormData();
	data.append('ajax','true');
	for( var i =0;i<fileInput.files.length;++i){
		data.append('file[]',fileInput.files[i]); 
		}
		var request= new XMLHttpRequest();
		request.upload.addEventListener('progress',function(event){
			if(event.lengthComputable){
			var percent= event.loaded / event.total;
			
			
			
				
				
				
				progressbar(Math.round(percent * 100), $('#uploaded_progress'));
				
				}
				
			});
	    request.upload.addEventListener('load',function(event){
			
			document.getElementById('submit1').disabled=true;
			uploaded=true;
			});
		request.upload.addEventListener('error',function(event){
			alert('upload fail');
			});
			 request.open('POST','fichier.php');
			request.setRequestHeader('Cache-control','no-cache');
			 document.getElementById('uploaded_progress').style.display='block';
			  
			 request.send(data);}
	}
	
	
	
	var handleUpload2=function(event){
	
	
	
	
	
	}



window.addEventListener('load',function(event){
	var submit= document.getElementById('submit1');
	var submit2=document.getElementById('submit');
	submit.addEventListener('click',handleUpload);
	
	submit2.addEventListener('click',handleUpload2);
	
})