<?php
session_start();
//echo isset($_SESSION['reviwer']);
if(isset($_SESSION['reviwer'])){

  header('Location: index.php');

}else
{

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>



    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    <style>

    </style>
</head>
<body>
<div class="container">





    <section class="main">
        <form  METHOD="post" class="form-2">
            <h1><span class="log-in">REVIEWVER</span> </h1>
            <p class="float">
                <label for="login"><i class="icon-user"></i>Username</label>
                <input type="text" name="login" placeholder="Email" id="usr">
            </p>
            <p class="float">
                <label for="password"><i class="icon-lock"></i>Password</label>
                <input type="password" name="password" placeholder="Password" class="showpassword" id="pass">
            </p>
            <p class="clearfix">

                <input type="submit" name="submit" value="Log in" id="log"><img src="images/gears.gif" style="display: none">
            </p>
        </form>​​
    </section>

</div>
<!-- jQuery if needed -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){

        $(".showpassword").each(function(index,input) {
            var $input = $(input);
            $("<p class='opt'/>").append(
                $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
                    var change = $(this).is(":checked") ? "text" : "password";
                    var rep = $("<input placeholder='Password' type='" + change + "' />")
                        .attr("id", $input.attr("id"))
                        .attr("name", $input.attr("name"))
                        .attr('class', $input.attr('class'))
                        .val($input.val())
                        .insertBefore($input);
                    $input.remove();
                    $input = rep;
                })
            ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
        });

        $('#showPassword').click(function(){
            if($("#showPassword").is(":checked")) {
                $('.icon-lock').addClass('icon-unlock');
                $('.icon-unlock').removeClass('icon-lock');
            } else {
                $('.icon-unlock').addClass('icon-lock');
                $('.icon-lock').removeClass('icon-unlock');
            }
        });
        $("#log").click(function (e) {
            valide=true;
            e.stopPropagation();
            if($("#usr").val()==""){
                $("#usr").css("border-color","#ff0000");
                valide=false;
            }
            else
            {
                $("#usr").css("border-color","#CCCCCC");

            }
            if($("#pass").val()==""){
                $("#pass").css("border-color","#ff0000");
                valide=false;
            }
            else
            {
                $("#pass").css("border-color","#CCCCCC");

            }
            if($("#password").val()!=""&& $("#usr").val()!="" && valide)
            {
                $("#wait").show();
                var pseudo= $('#usr').val();
                var password= $('#pass').val();

                $.ajax({


                    type:"POST",
                    url:"php/connexion.php",
                    data: {pseudo: pseudo,password:password},
                    success:function(data)
                    {
                        if(data == 1)
                        {
                            window.location.href="index.php";

                        }
                        else
                        {
                            $("#usr").css("border-color","#ff0000");
                            $("#pass").css("border-color","#ff0000");

                            valide=false;

                        }}});




            }
            return false;

        });
    });
</script>
</body>
</html>