 var valide,email;

$(function(valide){
	$("#submit").click(function(valide){
		  valide=true;
		  email=false;
			if($("#fname").val()==""){
				$("#fname").css("border-color","#ff0000");
				$("#fname").next(".erreur").fadeIn().text("Please type your First name");
				 valide=false;
				 window.location.hash='#fname';
				}else if(!$("#fname").val().match(/^[a-z]+$/i))
				{
					$("#fname").css("border-color","#ff0000");
				$("#fname").next(".erreur").fadeIn().text("Please type a valide First name");
				valide=false;
					}
					else
					{
						$("#fname").next(".erreur").fadeOut();
						$("#fname").css("border-color","#15ED34");
						
					}
					///midle nom

			
			// laste name validate
			if($("#lname").val()==""){
				$("#lname").css("border-color","#ff0000");
				$("#lname").next(".erreur").fadeIn().text("Veuillez entree votre nom");
				 valide=false;
				}else if(!$("#lname").val().match(/^[a-z]+$/i)) 
				{
					$("#lname").css("border-color","#ff0000");
				$("#lname").next(".erreur").fadeIn().text("Veuillez entree un nom valide");
				valide=false;
					}
					else
					{
						$("#lname").next(".erreur").fadeOut();
						$("#lname").css("border-color","#15ED34");
					}
			//Affiliation validation
			if($("#Affiliation").val()==""){
				$("#Affiliation").css("border-color","#ff0000");
				$("#Affiliation").next(".erreur").fadeIn().text("Veuillez entree votre nom");
				 valide=false;
				}else 
					{
						$("#Affiliation").next(".erreur").fadeOut();
						$("#Affiliation").css("border-color","#15ED34");
					}
			
			//addrese validation
			if($("#addr").val()==""){
				$("#addr").css("border-color","#ff0000");
				$("#addr").next(".erreur").fadeIn().text("Veuillez entree votre adresse");
				 valide=false;
				}else 
					{
						$("#addr").next(".erreur").fadeOut();
						$("#addr").css("border-color","#15ED34");
					}
			
			// city validation
			if($("#city").val()==""){
				$("#city").css("border-color","#ff0000");
				$("#city").next(".erreur").fadeIn().text("Veuillez entree votre adresse");
				 valide=false;
				}else 
					{
						$("#city").next(".erreur").fadeOut();
						$("#city").css("border-color","#15ED34");
					}
	//state validation
	if($("#state").val()==""){
				$("#state").css("border-color","#ff0000");
				$("#state").next(".erreur").fadeIn().text("Veuillez entree votre state");
				 valide=false;
				}else 
					{
						$("#state").next(".erreur").fadeOut();
						$("#state").css("border-color","#15ED34");
					}
	//country validation
		if($("#country").val()==""){
				$("#country").css("border-color","#ff0000");
				$("#country").next(".erreur").fadeIn().text("please choise your country");
				 valide=false;
				}else 
					{
						$("#country").next(".erreur").fadeOut();
						$("#country").css("border-color","#15ED34");
					}
	
	//post code validation
	if($("#pcode").val()==""){
				$("#pcode").css("border-color","#ff0000");
				$("#pcode").next(".erreur").fadeIn().text("please center your poste code");
				 valide=false;
				}else 
					{
						$("#pcode").next(".erreur").fadeOut();
						$("#pcode").css("border-color","");
					}
		// email validation			
	if($("#email").val()==""){
				$("#email").css("border-color","#ff0000");
				$("#email").next(".erreur").fadeIn().text("please enter your email");
				 valide=false;
				}else if(!$("#email").val().match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)) 
				{
					$("#email").css("border-color","#ff0000");
				$("#email").next(".erreur").fadeIn().text("please enter a valide email");
				valide=false;
					}
					else
					{
						var pseudo= $('#email').val();

							$.ajax({
								type:"POST",
								url:"../php/verification.php",
								data: {pseudo: pseudo},async:false,
								success:function(data)
								{
									if(data == 1)
									{
									
										valide=false;

										 window.location.hash='#fname';
										 email=true;
										$("#email").css("border-color","#ff0000");
										
										$("#email").next(".erreur").fadeIn().text("Cette email est deja pris");

									}
									else
									{
										
										//$("#email").next(".erreur").text()="";
										$("#email").next(".erreur").fadeOut();
						$("#email").css("border-color","#15ED34");
									}
								}


							});
							
						
					}
					
	
	
					
		//password validation  
					if($("#password").val()==""){
				$("#password").css("border-color","#ff0000");
				$("#password").next(".erreur").fadeIn().text("please type your password");
				 valide=false;
				}else if(!$("#password").val().match(/^(?=.*[a-z])(?=.*[0-9]).{6,}$/i)) 
				{
					$("#password").css("border-color","#ff0000");
				$("#password").next(".erreur").fadeIn().text("please type a valide password");
				valide=false;
					}
					else
					{
						$("#password").next(".erreur").fadeOut();
						$("#password").css("border-color","#15ED34");
					}
				//repassword validation
					if($("#repassword").val()==""){
				$("#repassword").css("border-color","#ff0000");
				$("#repassword").next(".erreur").fadeIn().text("please re-type your password");
				 valide=false;
				}else if(!$("#repassword").val().match(/^(?=.*[a-z])(?=.*[0-9]).{6,}$/i)) 
				{
					$("#repassword").css("border-color","#ff0000");
				$("#repassword").next(".erreur").fadeIn().text("please re-type a valide password");
				valide=false;
					}
					else if($("#password").val()!=$("#repassword").val()){
		valide=false;
		$("#password").css("border-color","#ff0000");
		
		$("#repassword").css("border-color","#ff0000");
		$("#repassword").next(".erreur").fadeIn().text("please enter a identique password");
		
		}else
					{
						$("#repassword").next(".erreur").fadeOut();
						$("#repassword").css("border-color","#15ED34");
					}
				 	
	
	// verification email disponible
	
	


		return valide;
		});
	
	
	
	});
// JavaScript Document