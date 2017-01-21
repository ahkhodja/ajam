
<?php





?>



<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Document sans nom</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-2.1.3.js"></script>
    <link href="css/index.css" rel="stylesheet" type="text/css">
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
    <div class="row">
        <div class="col-lg-2 logo">
            <p class="text-center">Editor Account</p>
        </div>
        <div class="col-lg-10 bn">

        </div>
    </div>

    <div class="row ">
        <div class="col-lg-2 menu">

                <div class="row profile">
                <img src="images/profile.png" id="profile">
                <p>KHODJA AHMED</p>

                </div>
                <div class="row titre">
                    <ul class="choix">
                   <li class="titre"> <p class="text-titre">ARTICLE BEFOR REVISION</p></li>

                        <li class="s_menu selected" ><a href="#" id="submited">SUBMITED ARTICLE</a> </li>
                        <li class="s_menu"><a href="#">REFUSED ARTICLE</a></li>
                        <li class="titre"><p class="text-titre">ARTICLE IN  REVISION</p></li>
                        <li class="s_menu"><a href="#" id="wa_re">WAITING FOR REVIEWERS</a></li>
                        <li class="s_menu"><a href="#" id="un_re">IN REVISION</a></li>
                        <li class="titre"><p class="text-titre">ARTICLE IN 2ND REVISION</p></li>
                        <li class="s_menu">REVISED ARTICLE</li>
                        <li class="titre"><p class="text-titre">Reviewver</p></li>
                        <li class="s_menu">Manage reviewver</li>
                        <li class="s_menu">Add reviewver</li>
                    </ul>
                </div>


        </div>
        <div class="col-lg-10 ">
            <div id="body">

            </div>
        </div>
</div>

<script src="js/index.js"></script>
</body>
</html>

