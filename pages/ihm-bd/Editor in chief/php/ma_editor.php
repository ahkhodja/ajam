<?php
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
include_once("../../../../php/cnx.php");

$select = $conn->query("SELECT id,fname,lname,mname,email from editor ORDER BY id DESC ");
if ($select->num_rows != 0) {

    $contenu = "



<table id=\"table\" class=\"table table - striped table - bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th>id</th>
                <th>First name</th>
                <th >Middle name</th>
                <th>Last name</th>
                <th>Email</th>
                </tr>
        </thead>
		<tbody>

";
    while($row = $select->fetch_assoc()){



        $contenu=$contenu."
	   <tr>
                <td>". $row['id']."</td>
                
                <td>". $row['fname']."</td>
                <td>". $row['mname']."</td>
                <td>". $row['lname']."</td>
                <td>". $row['email']."</td>
            </tr>
  ";
    }
    $contenu=$contenu."</tbody></table></div>";


}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>MANAGE REVIEWVER</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/index2.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery-2.1.3.js" ></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>

</head>
<body>
<div class="container-fluid">

    <div class="row bann">
        <div class="col-sm-2 logo">
            <p class="text-center">Editor Account</p>
        </div>
        <div class="col-sm-10 bn">
            <div class="pull-right log-out">
                <a class="no_color" href="php/log-out.php" id="logout"><img src="../images/user.png">Sign out</a>
            </div>
        </div>
    </div>
    <row class="row menu_row">
        <div class="col-sm-2 menu">
            <div class="row profile">
                <div class="col-sm-4 pading_left">
                    <img src="../images/profile.png" id="profile">
                </div>
                <div class="col-sm-7 pading_profile text_moyen">
                    <div class="form-group">
                        <div class="row min_height">
                            <label class="col-lg-12 control-label no_padding" for="text">WELLCOME Mr :  </label>

                        </div>
                        <div class="row min_height">
                            <label class="col-lg-6 control-label no_padding" for="text">Last name : </label>
                            <label class="col-lg-6 control-label no_padding text_label" for="text"><?php  ?> </label>
                        </div>


                    </div>

                </div>
            </div>
            <div class="row menu">
                <div class="panel panel-info panel_perso">

                    <div class=" head_perso panel-heading ">
                        <h3 class="panel-title font_14">&nbsp;ARTICLES BEFOR REVISION</h3>
                    </div>
                    <div class="list-group">
                        <li >
                            <a href="../index2.php?t=sub" id="track" class="list-group-item liste_perso font-12 ">
                                <i class ="fa fa-inbox fa-2x  "></i>&nbsp; SUBMITED ARTICLES

                            </a>
                        </li>


                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;ARTICLES IN REVISIONS</h3>
                    </div>
                    <div class="list-group">
                        <li>
                            <a href="../index2.php?t=w_r" class="list-group-item liste_perso">
                                <i class ="fa  fa-hourglass-end fa-2x "></i>	  &nbsp;WAITING FOR REVIEWERS

                            </a></li>
                        <li >
                            <a href="../index2.php?t=u_r"  class="list-group-item liste_perso">
                                <i class ="fa  fa-folder-open-o fa-2x "></i>&nbsp;IN REVISION

                            </a>

                        </li>
                        <li >
                            <a href="../index2.php?t=i_s"  class="list-group-item liste_perso">
                                <i class ="fa   fa-hourglass-2 fa-2x "></i>&nbsp;IDLE FOR SUBMITION

                            </a>
                        </li>
                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;ARTICLES IN REVISIONS 2</h3>
                    </div>
                    <div class="list-group">
                        <li >
                            <a href="../index2.php?t=r2" class="list-group-item liste_perso" id="edit">
                                <i class ="fa  fa-folder-open-o fa-2x "></i>&nbsp; IN REVISION 2
                            </a>
                        </li>
                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;REVIEWVER</h3>
                    </div>
                    <div class="list-group">

                            <a href="ma_rev.php" class="list-group-item liste_perso" >
                                <i class ="fa   fa-users fa-2x "></i>&nbsp; MANAGE REVIEWVERS
                            </a>
                        <li class="selected">
                            <a href="" class="list-group-item liste_perso" >
                                <i class ="fa   fa-users fa-2x "></i>&nbsp; MANAGE EDITORS
                            </a>
                        </li>
                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;MESSAGES</h3>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item liste_perso">
                            <i class ="fa  fa-inbox fa-2x "></i>	  &nbsp;INBOX

                        </a>


                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;ARTICLES AFTER REVISION</h3>
                    </div>
                    <div class="list-group">
                        <li >
                            <a href="../index2.php?t=acc_ar" class="list-group-item liste_perso">
                                <i class ="fa fa-check fa-2x "></i>	  &nbsp;ACCEPTED ARTICLES

                            </a></li>
                        <li >
                            <a href="../index2.php?t=ref_ar" class="list-group-item liste_perso">
                                <i class ="fa   fa-close fa-2x "></i>	  &nbsp;REFUSED ARTICLES

                            </a>
                        </li>


                    </div>

                </div>
            </div>

        </div>
        <div class="col-sm-10">
            <div id="contenu">
                <legend> &nbsp;EDITORS :</legend>
                <button id="add"><i class ="fa fa-plus fa-2x  "></i></button>
                <div id="add_rev">
                    <div class="row">

                        <div class="form-group">

                            <label for="text" class="col-lg-1 control-label line_height">F-name : </label>

                            <div class="col-lg-5">

                                <input type="text" class="form-control" id="fname" placeholder ="First Name ... " name="re_fn2">

                            </div>

                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group">

                            <label for="text" class="col-lg-1 control-label line_height">M-name : </label>

                            <div class="col-lg-5">

                                <input type="text" class="form-control" id="mname" placeholder ="Middle Name ... " name="re_mn2">

                            </div>

                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group">

                            <label for="text" class="col-lg-1 control-label line_height">L-name : </label>

                            <div class="col-lg-5">

                                <input type="text" class="form-control" id="lname" placeholder ="Last Name ... " name="re_ln2">

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <div class="form-group">

                            <label for="text" class="col-lg-1 control-label line_height">E-mail : </label>

                            <div class="col-lg-5">

                                <input type="email" class="form-control" id="email" placeholder ="Email ... " name="re_em2">

                            </div>

                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group">

                            <label for="text" class="col-lg-1 control-label line_height">Password: </label>

                            <div class="col-lg-5">

                                <input type="password" class="form-control" id="password" placeholder ="Password ... " name="re_mn2">

                            </div>
                            <div class="col-lg-2 line_height"><button id="env" >Submit</button> <img src="../images/gears.gif" style="display: none" id="wait"></div>

                        </div>
                        <div class="col-lg-1 ">

                        </div>

                    </div>
                </div>
                <?php echo $contenu ?>

            </div>





    </row>

</div>

<footer class=" footer_perso">

    <p class="text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

</footer>
<script  type="application/javascript">
    $(document).ready(function() {
        $("#add_rev").hide();
        $('#table').dataTable( {
            "order": [3,'desc']
        } );
        $("#add").click(function () {
            $("#add_rev").show();
        });
        $("#env").click(function () {
            $("#wait").show();
            data_sub="fname="+$("#fname").val()+"&mname="+$("#mname").val()+"&lname="+$("#lname").val()+"&email="+$("#email").val()+"&password="+$("#password").val();
            $.ajax({
                type:"POST",
                url:"add_editor_compte.php",
                data: data_sub,async:false,
                success:function(data)
                {
                    if(data=1){
                        location.reload();

                    }



                }
            });
        });
    });
</script>
</body>
</html>