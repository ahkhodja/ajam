<?php

session_start();
if(!isset($_SESSION['reviwer'])){

    header('Location: log-in.php');

}

$id_rev= $_SESSION['reviwer'];
if(isset($_GET['t'])){
    if($_GET['t']=='o'){
        $contenu="<p>We confirm that Password has changed succufully</p>";
    }else{
        $contenu="<p>An error has occured try again</p>";
    }


}


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reviewver Account</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css" />
    <link href="../css/cssboot.css" rel="stylesheet" type="text/css">
    <link href="../css/Cp.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">

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
                <a class ="navbar-brand " href ="../index.php">REVIEWVER ACCOUNT</a>
            </div>
            <ul class ="nav navbar-nav  pull-right">
                <li class="divider"></li>


                <li> <a href="../log-out.php" id="log-out"> <i class ="fa  fa-sign-out fa-2x "></i></a> </li >
            </ul>

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
        <div id="contenu">
<?php echo $contenu ;?>
        </div>
    </div>

    <footer class="row col-sm-12 ">

        <p class="footer_perso text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

    </footer>
</div>

</body>
</html>