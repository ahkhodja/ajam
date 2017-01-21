<?php

session_start();
if(!isset($_SESSION['reviwer'])){

    header('Location: log-in.php');

}

$id_rev= $_SESSION['reviwer'];



?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reviewver Account</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
    <link href="css/cssboot.css" rel="stylesheet" type="text/css">
    <link href="css/Cp.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <script src="../../../jquery/jquery-2.1.3.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    <![endif]-->

</head>

<body>


<div class="container-fluid">
    <div class="col-lg-12">
        <nav class ="navbar navbar-inverse">
            <div class ="navbar-header ">
                <a class ="navbar-brand " href ="index.php">REVIEWVER ACCOUNT</a>
            </div>
            <ul class ="nav navbar-nav  pull-right">
                <li class="divider"></li>


                <li> <a href="log-out.php" id="log-out"> <img src="images/1480521556_logout.png"> Sign out</a> </li >
            </ul>

        </nav>
    </div>
</div>
<div class="container-fluid">
    <div class="col-xs-3">
        <div class="col-sm-12">
            <div class="row profile">
                <div class="col-sm-4 pading_left">
                    <img src="images/profile.png" id="profile">
                </div>
                <div class="col-sm-7 pading_profile text_moyen">
                    <div class="form-group">
                        <div class="row min_height">
                            <label class="col-lg-12 control-label no_padding " for="text"><?php echo $_SESSION['reviwer_fname']." ".$_SESSION['reviwer_lname']; ?> </label>

                        </div>
                        <div class="row min_height">
                            <label class="col-lg-5 control-label no_padding" for="text"><?php echo $_SESSION['reviwer_email'];?></label>

                        </div>


                    </div>

                </div>
            </div>
            <div class="row menu_principale">
                <div class="panel panel-info panel_perso">
                    <div class="list-group">
                        <a href="index.php" id="track" class="list-group-item liste_perso">
                            <i class ="fa fa-inbox fa-2x "></i>&nbsp; ARTICLES

                        </a>

                    </div>

                </div>
                <div class="panel panel-info panel_perso">


                    <div class="list-group">
                        <a href="ch_pass.php" target="_blank" class="list-group-item liste_perso">
                            <i class ="fa    fa-cog fa-2x "></i>&nbsp; &nbsp;CHANGE PASSWORD

                        </a>
                    </div>



                </div>
            </div>
        </div></div>

    <div class ="col-xs-9">
        <div id="ch">
<form action="php/confirm_pass.php" method="post">
            <div class="container-fluid ">

                <div class="row">

                    <div class="form-group">
                        <div class="col-lg-1">
                            </div>

                        <label for="text" class="col-lg-2 control-label text_label text-right" style="line-height: 3">Old Password : </label>

                        <div class="col-lg-6">

                            <input type="password" class="form-control" id="old" placeholder ="Old password  ... " name="Old">

                        </div>

                    </div>


                </div>
                <div class="row">

                    <div class="form-group">
                        <div class="col-lg-1">
                        </div>

                        <label for="text" class="col-lg-2 control-label text_label text-right" style="line-height: 3">New Password : </label>

                        <div class="col-lg-6">

                            <input type="password" class="form-control" id="New" placeholder ="New password  ... " name="New">

                        </div>

                    </div>


                </div>
                <div class="row">

                    <div class="form-group">
                        <div class="col-lg-1">
                        </div>

                        <label for="text" class="col-lg-2 control-label text_label text-right" style="line-height: 3">Confirm Password : </label>

                        <div class="col-lg-6">

                            <input type="password" class="form-control" id="Confirm" placeholder ="Confirm password  ... " name="Confirm">

                        </div>

                    </div>


                </div>
                <div class="row">

                    <div class="form-group">
                        <div class="col-lg-8">
                        </div>



                        <div class="col-lg-1">

                            <button class="pull-right btn btn-success" id="envoyer">&nbsp;Submit&nbsp;</button>

                        </div>

                    </div>


                </div>
            </div>
</form>
        </div>
    </div>

    <footer class="row col-sm-12 ">

        <p class="footer_perso text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

    </footer>
</div>
<script>
    $("#envoyer").click(function (e) {
        valide_t=true;
        e.stopPropagation();
        if($('#New').val()==""){

            $('#New').css("border-color","#ff0000");
            valide_t=false;
        }
        if($('#Confirm').val()==""){

            $('#Confirm').css("border-color","#ff0000");
            valide_t=false;
        }
        if($('#old').val()==""){

            $('#old').css("border-color","#ff0000");
            valide_t=false;
        }else
        {
            $('#old').css("border-color","#CCCCCC");
        }
        if($('#New').val()!=$('#Confirm').val()){

            $('#New').css("border-color","#ff0000");
            $('#Confirm').css("border-color","#ff0000");
            valide_t=false;
        }



return valide_t;
    });
</script>
</body>
</html>