// JavaScript Document
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
var handleUpload=function(event){
	
	event.preventDefault();
	event.stopPropagation();
	extensionsValides=new Array('pdf','pdf');
	
	
	var fileInput=document.getElementById('file');
	console.log(fileInput.files[0].size/1024/1024);
	if((fileInput.files[0].size/1024/1024)>1){
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
	var submit2=document.getElementById('submit');
	submit.addEventListener('click',handleUpload);
	
	//submit2.addEventListener('click',handleUpload2);
	
})