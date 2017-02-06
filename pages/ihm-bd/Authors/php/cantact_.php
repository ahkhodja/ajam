<?php
$contenu="";
session_start();
if(!isset($_SESSION['id'])){

    header('Location: ../../login.html');

}




?>



<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit profile</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/cssboot.css" rel="stylesheet" type="text/css">
    <link href="../css/usr_home.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <script src="../../../../jquery/jquery-2.1.3.js"></script>
    <script src="../../../../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    <![endif]-->

</head>



<body>
<input type="hidden" id="ident" value="<?php echo $_SESSION['id'] ?>"/>

<div class="container-fluid ">
    <div class="col-lg-12 ">
        <nav class ="navbar navbar-inverse">
            <div class ="navbar-header ">
                <a class ="navbar-brand " href ="../usr_home.php?a=t">Author Account</a>
            </div>
            <ul class ="nav navbar-nav ">
                <li class="divider"></li>
                <li class =" active "> <a href ="../usr_home.php?a=t"> Home </a> </li >
                <li> <a href ="#">Ethics </a> </li >
                <li> <a href ="#">Author Guidelines</a> </li >

            </ul>
            <div class="pull-right log-out"> <a href="../../../../php/log_out.php" id="log-out"> <img src="../images/1480521556_logout.png"> Sign out</a></div>
        </nav>
    </div>
</div>
<div class="container-fluid">
    <div class="col-xs-3">
        <div class="col-sm-12">
            <div class="row profile">
                <div class="col-sm-4 pading_left">
                    <img src="../images/profile.png" id="profile">
                </div>
                <div class="col-sm-7 pading_profile text_moyen">
                    <div class="form-group">
                        <div class="row min_height">
                            <label class="col-lg-6 control-label no_padding" for="text">First name : </label>
                            <label class="col-lg-6 control-label no_padding text_label" for="text"><?php echo $_SESSION['fname']; ?> </label>
                        </div>
                        <div class="row min_height">
                            <label class="col-lg-6 control-label no_padding" for="text">Last name : </label>
                            <label class="col-lg-6 control-label no_padding text_label" for="text"><?php echo $_SESSION['lname']; ?> </label>
                        </div>
                        <div class="row min_height">
                            <label class="col-lg-6 control-label no_padding" for="text">Grade : </label>
                            <label class="col-lg-6 control-label no_padding text_label" for="text"><?php echo $_SESSION['grade']; ?> </label>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row menu_principale">
                <div class="panel panel-info panel_perso">

                    <div class=" head_perso panel-heading ">
                        <h3 class="panel-title im"><i class ="fa  fa-file-text-o fa-1x "></i>&nbsp;ARTICLES</h3>
                    </div>
                    <div class="list-group">
                        <a href="../usr_home.php?a=t" id="track" class="list-group-item liste_perso">
                            <i class ="fa   fa-search fa-2x "></i>&nbsp; Track Paper

                        </a>
                        <a href="../submission_new.php" target="_blank" class="list-group-item liste_perso">
                            <i class ="fa    fa-upload fa-2x "></i>&nbsp; &nbsp;Submit

                        </a>

                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title im"><i class ="fa  fa-envelope fa-1x "></i>&nbsp;MESSAGES</h3>
                    </div>
                    <div class="list-group">
                        <a href="inbox.php" class="list-group-item liste_perso" id="inbox">
                            <i class ="fa  fa-inbox fa-2x "></i>	  &nbsp;Inbox

                        </a>
                        <a href="cantact_.php"  class="list-group-item liste_perso" id="contact">
                            <i class ="fa  fa-envelope fa-2x "></i>&nbsp;Contact us

                        </a>

                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title im"><i class ="fa fa-user fa-1x"></i>&nbsp;PROFILE</h3>
                    </div>
                    <a href="edit_pr.php" class="list-group-item liste_perso" id="edit">
                        <i class ="fa  fa-edit fa-2x "></i>&nbsp; Edit Informations

                    </a>

                </div>
            </div>
        </div></div>

    <div class ="col-xs-9">

        <div id="contenu">
            <?php  echo"<div id=\"table_contenu\">
<form class =\"col-lg-12\">
		<legend >Contact</legend >
			<div class =\"form-group\">
                <label for=\"texte\">OBJECT : </label>
                <input id=\"text\" type =\" text \" class =\"form-control\">
			</div>
			<div class =\"form-group\">
				<label for=\"textarea\">TEXTE : </label>
				<textarea id=\"textarea\" type =\"textarea\" rows=\"13\" class =\"form-control\"></textarea></br>
                <button class =\"pull-right btn btn-primary\" id=\"envoyer\">Envoyer</button >
			 </div>
</form>
</div>";?>
        </div>
    </div>

    <footer class="row col-sm-12">

        <p class="footer_perso text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

    </footer>
</div>
<script>
    $('#envoyer').on('click', function(e) {

        textarea=$('#textarea').val();
        title =$('#text').val();
        e.stopPropagation(e);
        $("#table_contenu").remove();

        $.ajax({


            type:"POST",
            url:"envoi_msg.php",
            data: {msg:textarea,title:title },async:true,
            success:function(data)
            {


                $("#contenu").append(data);






            }});



        return false;






    });
</script>
</body>
</html>
