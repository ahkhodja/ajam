<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 14/10/2016
 * Time: 16:08
 */
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: log-in.php');

}
$contenu='';
$id_editor=1;
if(isset($_GET['t'])){
    include_once("../../../php/cnx.php");
    if($_GET['t']=='sub') {


        $sql = "SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_editor WHERE editor=" . $id_editor . " AND etat='Submited'";
        $select = $conn->query($sql);
        if ($select->num_rows != 0) {

            $contenu = "<div id=\"contenu\"><legend> &nbsp;Submited Article :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
            while($row = $select->fetch_assoc()){
                $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
                $row2 = $select2->fetch_assoc();
                $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
                $row3 = $select3->fetch_assoc();
               $contenu=$contenu."
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/sub_info.php?idar=".$row['article']."&et_e=".$row['id']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
                
            </tr>
  ";
        }
            $contenu=$contenu."</tbody></table></div>";
    }else{
        $contenu=$contenu."<legend> &nbsp;Submited Article :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";

        }
    }
    if($_GET['t']=='ref_ar') {


        $sql = "SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_editor WHERE editor=". $id_editor ." AND etat='Refused'";
        $select = $conn->query($sql);
        if ($select->num_rows != 0) {

            $contenu = "<div id=\"contenu\"><legend> &nbsp;Refused Article :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
            while($row = $select->fetch_assoc()){
                $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
                $row2 = $select2->fetch_assoc();
                $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
                $row3 = $select3->fetch_assoc();
                $contenu=$contenu."
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/article_inf.php?idar=".$row['article']."&et_e=".$row['id']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
                
            </tr>
  ";
            }
            $contenu=$contenu."</tbody></table></div>";
        }else{
            $contenu=$contenu."<legend> &nbsp;Refused Article :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";

        }
    }    if($_GET['t']=='all_ar') {


        $sql = "SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_editor WHERE  etat='-Submited-' OR etat='Submited'";
        $select = $conn->query($sql);
        if ($select->num_rows != 0) {

            $contenu = "<div id=\"contenu\"><legend> &nbsp;ALL Article :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
            while($row = $select->fetch_assoc()){
                $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
                $row2 = $select2->fetch_assoc();
                $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
                $row3 = $select3->fetch_assoc();
                $contenu=$contenu."
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/ar_inf_all.php?idar=".$row['article']."&et_e=".$row['id']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
                
            </tr>
  ";
            }
            $contenu=$contenu."</tbody></table></div>";
        }else{
            $contenu=$contenu."<legend> &nbsp;Refused Article :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";

        }
    }
    if($_GET['t']=='acc_ar') {


        $sql = "SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_editor WHERE editor=". $id_editor ." AND etat='Accepted'";
        $select = $conn->query($sql);
        if ($select->num_rows != 0) {

            $contenu = "<div id=\"contenu\"><legend> &nbsp;Accepted Article :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
            while($row = $select->fetch_assoc()){
                $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
                $row2 = $select2->fetch_assoc();
                $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
                $row3 = $select3->fetch_assoc();
               $contenu=$contenu."
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/article_inf.php?idar=".$row['article']."&et_e=".$row['id']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
                
            </tr>
  ";
        }
            $contenu=$contenu."</tbody></table></div>";
    }else{
        $contenu=$contenu."<legend> &nbsp;Accepted Article :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";

        }
    }
if($_GET['t']=='w_r') {

    $sql="SELECT id,article,file, DATE_FORMAT(date, '%d %M') as date FROM state_editor WHERE editor=".$id_editor." AND etat='Waiting Review'";
    $select = $conn->query($sql);
    if ($select->num_rows!=0) {
        $contenu=$contenu. "
<div id=\"contenu\">
<legend> &nbsp;Wainting for reviewver :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
        while($row = $select->fetch_assoc()){
            $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
            $row2 = $select2->fetch_assoc();
            $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
            $row3 = $select3->fetch_assoc();
           $contenu=$contenu. "
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/wait_rev.php?idar=".$row['article']."&et_e=".$row['id']."&idau=".$row2['author']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
               
            </tr>
  ";
        }
        $contenu=$contenu."</tbody></table></div>";

    }else{


        $contenu=$contenu."<legend> &nbsp;Wainting for reviewver :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";

    }
}
    if($_GET['t']=='r2') {

        $sql="SELECT id,article,file,DATE_FORMAT(date,'%d %M') as date FROM state_editor WHERE editor=".$id_editor." AND etat='Revision 2'";
        $select = $conn->query($sql);
        if ($select->num_rows!=0) {

            $contenu=$contenu."
<div id=\"contenu\">
<legend> &nbsp;REVISION II :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
            while($row = $select->fetch_assoc()){
                $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
                $row2 = $select2->fetch_assoc();
                $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
                $row3 = $select3->fetch_assoc();
                $contenu=$contenu. "
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/show_rev2.php?idar=".$row['article']."&et_e=".$row['id']."&idau=".$row2['author']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
                
            </tr>
  ";
            }


            $contenu=$contenu."</tbody></table></div>";

        }else{


            $contenu=$contenu."<legend> &nbsp;REVISION II :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";




        }

    }
if($_GET['t']=='u_r') {

    $sql="SELECT id,article,file,DATE_FORMAT(date,'%d %M') as date FROM state_editor WHERE editor=".$id_editor." AND etat='Under review'";
    $select = $conn->query($sql);
    if ($select->num_rows!=0) {

        $contenu=$contenu."
<div id=\"contenu\">
<legend> &nbsp;Under Review :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
        while($row = $select->fetch_assoc()){
            $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
            $row2 = $select2->fetch_assoc();
            $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
            $row3 = $select3->fetch_assoc();
            $contenu=$contenu. "
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/show_res2.php?idar=".$row['article']."&et_e=".$row['id']."&idau=".$row2['author']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
               
            </tr>
  ";
        }


        $contenu=$contenu."</tbody></table></div>";

    }else{


        $contenu=$contenu."<legend> &nbsp;Under Review :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";




    }

}
    if($_GET['t']=='i_s') {

        $sql="SELECT id,article,file,DATE_FORMAT(date,'%d %M') as date FROM state_editor WHERE editor=".$id_editor." AND etat='IDLE FOR SUBMITION'";
        $select = $conn->query($sql);
        if ($select->num_rows!=0) {

            $contenu=$contenu."
<div id=\"contenu\">
<legend> &nbsp;IDLE FOR SUBMISSION :</legend>

<table id=\"table\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">
 <thead>
            <tr>
                <th width='5%'>id</th>
                <th>TITLES</th>
                <th width='15%'>AUTHOR</th>
                <th width='10%'>DATE</th>
                
                  </tr>
        </thead>
		<tbody>

";
            while($row = $select->fetch_assoc()){
                $select2 = $conn->query("SELECT id,title,author FROM article WHERE id=".$row['article']);
                $row2 = $select2->fetch_assoc();
                $select3 = $conn->query("SELECT fname,lname FROM personne WHERE id=".$row2['author']);
                $row3 = $select3->fetch_assoc();
                $contenu=$contenu. "
	   <tr>
                <td>". $row2['id']."</td>
                <td><a  onclick=\"window.open(this.href); return false;\"   href=\"php/idl.php?idar=".$row['article']."&et_e=".$row['id']."&idau=".$row2['author']."\">". $row2['title']."</a></td>

                <td>". $row3['fname']." ".$row3['lname']."</td>
                <td>". $row['date']."</td>
               
            </tr>";
            }


            $contenu=$contenu."</tbody></table></div>";

        }else{
            $contenu=$contenu."<legend> &nbsp;IDLE FOR SUBMISSION :</legend><div class= 'vide'><p class='text-center '>No Items Found</p></div>";
        }

    }

}

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Editor in chief</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/index2.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-2.1.3.js" ></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>

</head>
<body>
<div class="container-fluid">

    <div class="row bann">
        <div class="col-sm-2 logo">
            <a class="no_color" href="index2.php?t=sub"> <p class="text-center">Editor in chief</p></a>
        </div>
        <div class="col-sm-10 bn">
<div class="pull-right">
    <a class="no_color" href="php/log-out.php"><img src="images/user.png"><?php echo  " ".$_SESSION['editor_in_chief_fname']." ". $_SESSION['editor_in_chief_lname']; ?></a>
</div>
        </div>
    </div>
    <row class="row menu_row">
        <div class="col-sm-2 menu">
            <div class="row profile">
                <div class="col-sm-4 pading_left">
                    <img src="images/profile.png" id="profile">
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
                    <h3 class="panel-title font_14">&nbsp;ARTICLES BEFOR REVISION</h3>
                </div>
                <div class="list-group">
                    <li <?php if(isset($_GET['t'])){ if($_GET['t']=='sub') {echo " class=\"selected\"";}}  ?>>
                    <a href="index2.php?t=sub" id="track" class="list-group-item liste_perso font-12 ">
                        <i class ="fa fa-inbox fa-2x  "></i>&nbsp; SUBMITED ARTICLES

                    </a>
                    </li>


                </div>
                <div class="panel-heading head_perso">
                    <h3 class="panel-title font_14">&nbsp;ARTICLES IN REVISIONS</h3>
                </div>
                <div class="list-group">
                    <li<?php if(isset($_GET['t'])){ if($_GET['t']=='w_r') {echo " class=\"selected\"";}}  ?>>
                    <a href="index2.php?t=w_r" class="list-group-item liste_perso">
                        <i class ="fa  fa-hourglass-end fa-2x "></i>	  &nbsp;WAITING FOR REVIEWERS

                    </a></li>
                    <li <?php if(isset($_GET['t'])){ if($_GET['t']=='u_r') {echo " class=\"selected\"";}}  ?>>
                    <a href="index2.php?t=u_r"  class="list-group-item liste_perso">
                        <i class ="fa  fa-folder-open-o fa-2x "></i>&nbsp;IN REVISION

                    </a>

                    </li>
                    <li <?php if(isset($_GET['t'])){ if($_GET['t']=='i_s') {echo " class=\"selected sp\"";}}  ?>>
                    <a href="index2.php?t=i_s"  class="list-group-item liste_perso">
                        <i class ="fa   fa-hourglass-2 fa-2x "></i>&nbsp;IDLE FOR SUBMITION

                    </a>
                    </li>
                </div>
                <div class="panel-heading head_perso">
                    <h3 class="panel-title font_14">&nbsp;ARTICLES IN REVISIONS 2</h3>
                </div>
                <div class="list-group">
                    <li <?php if(isset($_GET['t'])){ if($_GET['t']=='r2') {echo " class=\"selected sp\"";}}  ?>>
                <a href="index2.php?t=r2" class="list-group-item liste_perso" id="edit">
                    <i class ="fa  fa-folder-open-o fa-2x "></i>&nbsp; IN REVISION 2
                </a>
                    </li>
                </div>
                <div class="panel-heading head_perso">
                    <h3 class="panel-title font_14">&nbsp;REVIEWVER</h3>
                </div>
                <div class="list-group">
                <a href="php/ma_rev.php" class="list-group-item liste_perso" >
                    <i class ="fa   fa-users fa-2x "></i>&nbsp; MANAGE REVIEWVER
                </a>
                    <a href="php/ma_editor.php" class="list-group-item liste_perso" >
                        <i class ="fa   fa-users fa-2x "></i>&nbsp; MANAGE EDITOR
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
                    <a href="index2.php?t=acc_ar" class="list-group-item liste_perso">
                        <i class ="fa fa-check fa-2x "></i>	  &nbsp;ACCEPTED ARTICLES

                    </a></li>
                    <li <?php if(isset($_GET['t'])){ if($_GET['t']=='ref_ar') {echo " class=\"selected\"";}}  ?>>
                    <a href="index2.php?t=ref_ar" class="list-group-item liste_perso">
                        <i class ="fa   fa-close fa-2x "></i>	  &nbsp;REFUSED ARTICLES

                    </a><li <?php if(isset($_GET['t'])){ if($_GET['t']=='all_ar') {echo " class=\"selected\"";}}  ?>>
                    <a href="index2.php?t=all_ar" class="list-group-item liste_perso">
                        <i class ="fa   fa-search fa-2x "></i>	  &nbsp;ALL ARTICLES

                    </a>
                    </li>


                </div>

            </div>
            </div>

        </div>
        <div class="col-sm-10">
            
<?php echo $contenu ?>

        </div>





    </row>

</div>

<footer class=" footer_perso">

    <p class="text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

</footer>
<script  type="application/javascript">
    $(document).ready(function() {
    $('#table').dataTable( {
        "order": [3,'desc']
    } );});
</script>
</body>
</html>