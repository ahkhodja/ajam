// JavaScript Document
var valide=true;

$(function(){
	
	
	$("#submit").click(function(valide){
		
		
		
		if($("#usr").val()==""){
				$("#usr").css("border-color","#ff0000");
				 valide=false;
				}
		else 
				{
				$("#usr").css("border-color","none");
				
				}
				
				
				if($("#password").val()==""){
					
					$("#password").css("border-color","#ff0000");
				 valide=false;
					
					}
		else{
			
			$("#password").css("border-color","#15ED34");
			
		}
				
				if($("#password").val()!=""&& $("#usr").val()!="")
				{
					
					var pseudo= $('#usr').val();
					var password= $('#password').val();
					
					$.ajax({
								
								
								type:"POST",
								url:"../php/connexion.php",
								data: {pseudo: pseudo,password:password},
								success:function(data)
								{
									if(data == 1)
									{
										window.location.href="../pages/ihm-bd/Authors/usr_home.php?a=t";

									}
									else
									{
										$("#usr").css("border-color","#ff0000");
										$("#password").css("border-color","#ff0000");
										$('#erreur').fadeIn().text("please enter a identique password");
										valide=false;
										
									}}});
					
					
					
					
				}
				
		
		
		
		
		return false;
		
		});});