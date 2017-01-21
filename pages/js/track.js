// JavaScript Document

var valide=true;

$(function(){
	
	
	$("#submit").click(function(valide){
		
		
		
		if($("#id_article").val()==""){
				$("#id_article").css("border-color","#ff0000");
				 valide=false;
				}
		else 
				{
				$("#id_article").css("border-color","#15ED34");
				
				}
				
				
				if($("#password").val()==""){
					
					$("#password").css("border-color","#ff0000");
				 valide=false;
					
					}
		else{
			
			$("#password").css("border-color","#15ED34");
			
		}
				
				if($("#password").val()!=""&& $("#id_article").val()!="")
				{
					
					var pseudo= $('#id_article').val();
					var password= $('#password').val();
					$.ajax({
								
								
								type:"POST",
								url:"../php/connexionTrack.php",
								data: {pseudo: pseudo,password:password},
								success:function(data)
								{
									if(data == 1)
									{
										
										window.location="trackingResult.html";

									}
									else
									{
										$("#id_article").css("border-color","#ff0000");
										$("#password").css("border-color","#ff0000");
										$('#erreur').fadeIn().text("please enter a identique password");
										valide=false;
										
									}}});
					
					
					
					
				}
				
		
		
		
		
		return false;
		
		});});