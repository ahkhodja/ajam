<?php
$contenu="";
session_start();
if(!isset($_SESSION['id'])){

    header('Location: ../../login.html');

}
include_once("../../../../php/cnx.php");
$select = $conn->query("SELECT fname,lname,mname,affiliation,adresse,city,state,contry,pcode,phone,fax FROM personne WHERE id=".$_SESSION['id']);
$row = $select->fetch_assoc();

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
                        <a href="#" class="list-group-item liste_perso" id="inbox">
                            <i class ="fa  fa-inbox fa-2x "></i>	  &nbsp;Inbox

                        </a>
                        <a href="#"  class="list-group-item liste_perso" id="contact">
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
<legend> &nbsp;Edit Informations :</legend>
<form class=\"form-horizontal \">


  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">First Name :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"fname\" placeholder =\"First Name\" value=\"". $row['fname']."\" disabled>

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">Middle Name :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"text\" value=\"".$row['mname']."\" disabled>

      </div>

    </div>

  </div>
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">last Name :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"text\" value=\"". $row['lname']."\"disabled>

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">Affiliation :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"affiliation\" value=\"".$row['affiliation']."\">

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">Address :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"adresse\" value=\"".$row['adresse']."\">

      </div>

    </div>

  </div>
   <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"text\" class=\"col-lg-2 control-label\">City :</label>

      <div class=\"col-lg-8\">

        <input type=\"text\" class=\"form-control\" id=\"city\" value=\"". $row['city']."\">

      </div>

    </div>

  </div>

  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">State/Region :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"state\"value=\"". $row['state']."\">

      </div>

    </div>

  </div>
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">contry :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"contry\" value=\"". $row['contry']."\">

      </div>

    </div>

  </div>
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">Zip/Postcode :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"pcode\" value=\"". $row['pcode']."\">

      </div>

    </div>

  </div>
  
  <div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">Phone :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"Phone\" value=\"". $row['phone']."\">

      </div>

    </div>

  </div>
<div class=\"row\">

    <div class=\"form-group\">

      <label for=\"textarea\" class=\"col-lg-2 control-label\">Fax :</label>

      <div class=\"col-lg-8\">

        <input type=\"textarea\" class=\"form-control\" id=\"fax\" value=\"". $row['fax']."\">

      </div>

    </div>

  </div>
 

  <div class=\"form-group\">

    <button class=\"pull-right btn btn-primary\" id=\"submit-edit\">Envoyer</button>

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
    $('#submit-edit').on('click', function(e) {
        e.stopPropagation(e);
        affiliation=$('#affiliation').val();
        $.ajax({
            type:"POST",
            url:"update_profile.php",
            data: {affiliation:affiliation,adresse:$('#adresse').val(),city:$('#city').val(),state:$('#state').val(),contry:$('#contry').val(),pcode:$('#pcode').val(),Phone:$('#Phone').val(),fax:$('#fax').val() },async:false,
            success:function(data)
            {
                $("#table_contenu").remove();
                $("#contenu").append(data);

            }});return false;




    });
</script>
</body>
</html>
