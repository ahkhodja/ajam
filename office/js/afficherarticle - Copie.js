// JavaScript Document
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
	
 $('#accepted').hide();
	  $('#refused').hide();
	  $( "textarea" ).prop( "disabled", true );
	  
$('#decision').change(function() {
 if($('#decision').val()=='accepted'){
	 $('#accepted').show("slow");
	  $('#refused').hide("slow");
	 
	 }else{
		 if($('#decision').val()=='refused'){
		 $('#accepted').hide("slow");
	  $('#refused').show("slow");}else{
		  
		   $('#accepted').hide("slow");
	  $('#refused').hide("slow");}
		  
		  }
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
	alert("You must select a PDF file");
	
	$('#file').css("border-color","#ff0000");
	return false;
     }
	 //----validation(acceptation)
	 
	 var accepte=function(event){
	event.preventDefault();
	event.stopPropagation();
		 var file=$('#file').val();
		 var article=$('#idarticle').val();
		 var author=$('#idauthor').val();
		  var etat=$('#etat').val();
		  alert('ok');
		 $.ajax({
								
								
								type:"POST",
								url:"php/acceptation.php",
								data: {file: file,article:article,author:author,etat:etat},
								success:function(data)
								{
									if(data == 1)
									{
										window.location="confirmaccepte.php";

									}
									else
									{
										alert('rein');
										
									}}});
		 
		 }
	 
	 
	 
	 
	 
	 
	 
	 
	 //----upload fichier
var handleUpload=function(event){
	
	event.preventDefault();
	event.stopPropagation();
	extensionsValides=new Array('tex','doc','docx');
	
	
	var fileInput=document.getElementById('file');
	console.log(fileInput.files[0].size/1024/1024);
	if((fileInput.files[0].size/1024/1024)>1000){
		alert('taille trop grand(max 50 Mo)');
		$('#file').css("border-color","#ff0000");
		}
	else{
	var resultat=verifFileExtension('file',extensionsValides);
	if(resultat==true){
	console.log(fileInput.files[0].name);
	var data= new FormData();
	data.append('ajax','true');
	for( var i =0;i<fileInput.files.length;++i){
		data.append('file[]',fileInput.files[i]); 
		}
		console.log($('#idauthor').val());
		data.append('id',$('#idauthor').val());
		var request= new XMLHttpRequest();
		request.upload.addEventListener('progress',function(event){
			if(event.lengthComputable){
			var percent= event.loaded / event.total;
			var sim = setInterval(progressSim, 50);
			al=Math.round(percent * 100);
			//var progress = document.getElementById('uploaded_progress');
		//var progress1 = document.getElementById('progressebar');
			//while(progress.hasChildNodes()){
			//	progress.removeChild(progress.firstChild);
			//	}
				
				//progress.appendChild(document.createTextNode(Math.round(percent * 100)+'%'));
			//progress1.value=Math.round(percent * 100);
				
				}
				
			});
	    request.upload.addEventListener('load',function(event){
			//document.getElementById('uploaded_progress').style.display='none';
		console.log('ok');
			//document.getElementById('submit1').disabled=true;
			uploaded=true;
			});
		request.upload.addEventListener('error',function(event){
			alert('upload fail');
			});
			 request.open('POST','PHP/upload.php');
			request.setRequestHeader('Cache-control','no-cache');
			// document.getElementById('uploaded_progress').style.display='block';
			  
			 request.send(data);}
	}}
	
	



window.addEventListener('load',function(event){
	var submit= document.getElementById('submit1');
	var submit2=document.getElementById('submit2');
	submit.addEventListener('click',handleUpload);
	
	submit2.addEventListener('click',accepte);
	
})
