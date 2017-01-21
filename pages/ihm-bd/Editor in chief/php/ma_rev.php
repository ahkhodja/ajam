<?php
session_start();
include_once("../../../../php/cnx.php");
$contenu='';
$id_editor= $_SESSION['editor_in_chief'];
$submited_count_select=$conn->query("SELECT COUNT(*) FROM state_editor WHERE etat='Draft Submited' and editor=".$id_editor);
$submited_count = $submited_count_select->fetch_array();
$d_rev=$conn->query("SELECT COUNT(*) FROM state_editor WHERE etat='Draft in review' and editor=".$id_editor);
$d_rev_count = $d_rev->fetch_array();
$d_dec=$conn->query("SELECT COUNT(*) FROM state_editor WHERE etat='Draft in Decision' and editor=".$id_editor);
$d_dec_count = $d_dec->fetch_array();
$r1_dec=$conn->query("SELECT COUNT(*) FROM state_editor WHERE etat='R1 Submited' and editor=".$id_editor);
$r1_dec_count = $r1_dec->fetch_array();
$r1_rev=$conn->query("SELECT COUNT(*) FROM state_editor WHERE etat='R1 in review' and editor=".$id_editor);
$r1_rev_count = $r1_rev->fetch_array();
$r1_des=$conn->query("SELECT COUNT(*) FROM state_editor WHERE etat='R1 in Decision' and editor=".$id_editor);
$r1_des_count = $r1_des->fetch_array();

$sql = "SELECT id,fname,lname,mname,email from reviewer ORDER BY id DESC ";
$select = $conn->query($sql);
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
    <title>EDITOR ACCOUNT</title>
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
            <a class="no_color" href="../index.php?t=d_sub"> <p class="text-center">Editor Account</p></a>
        </div>
        <div class="col-sm-10 bn">
            <div class="pull-right">
                <a class="no_color" href="php/log-out.php"><img src="../images/user.png">Sign out</a>
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

                            <label class="col-lg-12 control-label no_padding text_label font_14" for="text"><?php echo  $_SESSION['editor_in_chief_fname']." ". $_SESSION['editor_in_chief_lname']; ?> </label>
                        </div>


                    </div>

                </div>
            </div>
            <div class="row menu">
                <div class="panel panel-info panel_perso">

                    <div class=" head_perso panel-heading ">
                        <h3 class="panel-title font_14">&nbsp;DRAFT PAPERS</h3>
                    </div>
                    <div class="list-group">
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='d_sub') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=d_sub" id="track" class="list-group-item liste_perso font-12 ">
                                <i class ="fa fa-inbox fa-2x  "></i>&nbsp; SUBMITED ARTICLES
                                <span class="pull-right nombre">(<?php echo $submited_count[0]; ?>)</span>
                            </a>

                        </li>
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='d_rev') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=d_rev" id="track" class="list-group-item liste_perso font-12 ">
                                <i class ="fa fa-pencil fa-2x  "></i>&nbsp; IN REVIEW
                                <span class="pull-right nombre">(<?php echo $d_rev_count[0]; ?>)</span>
                            </a>

                        </li>
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='d_dec') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=d_dec" id="track" class="list-group-item liste_perso font-10">
                                <i class ="fa  fa-gavel fa-2x  "></i>&nbsp; DECISION &nbsp;&nbsp;  &nbsp;&nbsp;<span class="pull-right nombre">(<?php echo $d_dec_count[0]; ?>)</span>

                            </a>
                        </li>


                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;REVISED PAPERS I</h3>
                    </div>
                    <div class="list-group">
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='r1_sub') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=r1_sub"  class="list-group-item liste_perso">
                                <i class ="fa  fa-inbox fa-2x "></i>&nbsp;SUBMITED PAPERS<span class="pull-right nombre">(<?php echo $r1_dec_count[0]; ?>)</span>

                            </a>

                        </li>
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='r1_rev') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=r1_rev"  class="list-group-item liste_perso">
                                <i class ="fa  fa-pencil fa-2x "></i>&nbsp;IN REVIEW<span class="pull-right nombre">(<?php echo $r1_rev_count[0]; ?>)</span>

                            </a>

                        </li>
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='r1_dec') {echo " class=\"selected sp\"";}}  ?>>
                            <a href="../index.php?t=r1_dec"  class="list-group-item liste_perso">
                                <i class ="fa    fa-gavel fa-2x "></i>&nbsp;DECISION <span class="pull-right nombre">(<?php echo $r1_des_count[0]; ?>)</span>

                            </a>
                        </li>
                    </div>
                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;REVISED PAPERS II</h3>
                    </div>
                    <div class="list-group">
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='r2_sub') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=r2_sub"  class="list-group-item liste_perso">
                                <i class ="fa  fa-inbox fa-2x "></i>&nbsp;SUBMITED PAPERS<span class="pull-right nombre">()</span>

                            </a>

                        </li>
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='r2_rev') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=r2_rev"  class="list-group-item liste_perso">
                                <i class ="fa  fa-pencil fa-2x "></i>&nbsp;IN REVIEW<span class="pull-right nombre">()</span>

                            </a>

                        </li>
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='r2_dec') {echo " class=\"selected sp\"";}}  ?>>
                            <a href="../index.php?t=r2_dec"  class="list-group-item liste_perso">
                                <i class ="fa    fa-gavel fa-2x "></i>&nbsp;DECISION <span class="pull-right nombre">()</span>

                            </a>
                        </li>
                    </div>

                    <div class="panel-heading head_perso">
                        <h3 class="panel-title font_14">&nbsp;REVIEWVER</h3>
                    </div>
                    <div class="list-group">
                        <a href="ma_rev.php" class="list-group-item liste_perso selected" >
                            <i class ="fa   fa-users fa-2x "></i>&nbsp; MANAGE REVIEWVER
                        </a>

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
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='acc_ar') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=acc_ar" class="list-group-item liste_perso">
                                <i class ="fa fa-check fa-2x "></i>	  &nbsp;ACCEPTED ARTICLES

                            </a></li>
                        <li <?php if(isset($_GET['t'])){ if($_GET['t']=='ref_ar') {echo " class=\"selected\"";}}  ?>>
                            <a href="../index.php?t=ref_ar" class="list-group-item liste_perso">
                                <i class ="fa   fa-close fa-2x "></i>	  &nbsp;REFUSED ARTICLES

                            </a>
                        </li>


                    </div>

                </div>
            </div>

        </div>
        <div class="col-sm-10">
            <div id="contenu">
                <legend> &nbsp;REVIEWVERS :</legend>
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
                url:"add_rev_compte.php",
                data: data_sub,async:false,
                success:function(data)
                {
                    if(data=1){
                       loaction.reload();

                    }



                }
            });
        });
    });
</script>
</body>
</html>