<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 11/10/2016
 * Time: 11:29
 */
session_start();
if(!isset($_SESSION['id'])){

    header('Location: ../../../login.html');

}
$author=$_SESSION['id'];
$validation=false;
$article=intval($_GET['id']);
include_once("../../../../php/cnx.php");
$select_article=$conn->query("SELECT title,type,area,abstract,keywords,etiquette FROM article WHERE id=".$article." AND author=".$author);
if($select_article){
    if($select_article->num_rows==0){



    }
    $row=$select_article->fetch_assoc();
    $select_etat = $conn->query("SELECT id, state,file, DATE_FORMAT(date, '%d %M') as date FROM state_author WHERE article=".$article);
    $select_editor = $conn->query("SELECT id ,editor FROM state_editor WHERE article=".$article);
    if($select_editor){
        $row_editor=$select_editor->fetch_assoc();
        $editor=$conn->query("SELECT fname,lname,email FROM editor WHERE id=".$row_editor['editor']);
        if($editor){
            $row_editor_inf=$editor->fetch_assoc();
        }else{

        }
    }else{

    }
    
}else{
    
}



?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Track</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link href="../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css" />
    <link href="../css/cssboot.css" rel="stylesheet" type="text/css">
    <link href="../css/track.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>

<input type="hidden" id="ident" value="<?php echo $_SESSION['id'] ?>"/>

<div class="container-fluid">
    <div class="col-lg-12">
        <nav class ="navbar navbar-inverse">
            <div class ="navbar-header ">
                <a class ="navbar-brand " href ="../usr_home.php?a=t">Author Account </a>
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
    <div class="col-xs-3 text_moyen">

        <div class="col-sm-12">
            <div class="row profile">

                <div class="col-sm-4 pading_left">
                    <img src="../images/profile.png" id="profile"></div>
                <div class="col-sm-7 pading_profile">
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



        <?php
        if($select_etat->num_rows!=0){
        echo"<div id=\"table_contenu\">
<div class=\"panel panel-primary panel_perso\">

  <table class=\"table table-striped table-condensed\">

    <div class=\"panel-heading head_perso\">

      <h3 class=\"panel-title text-center\">TRACK</h3>

    </div>

    <thead>

      <tr>

        <th  class=\"text-center\">Status</th>

        <th class=\"text-center\">Date</th>
        

      </tr>

    </thead>

    <tbody>";
            while($row_etat = $select_etat->fetch_assoc()){

                $select2 = $conn->query("SELECT name FROM file WHERE id=".$row_etat['file']);
                $row2 = $select2->fetch_assoc();
                $etat=$row_etat['state'];
                switch ($row_etat['state']) {
                    case "validation":

                        echo"
                                  <tr>
                                    <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">Check Informations</div></td>
                                    <td class=\"text-center \"style=\"line-height:3;\">".$row_etat['date']."</td>
                                    </tr>";
                        $select_et_editor = $conn->query("SELECT id FROM state_editor WHERE article=".$article." AND etat='Pre_Submited'");
                        $row_et_editor=$select_et_editor->fetch_assoc();
                        $lien_edit="../edit.php?a=".$article."&e=".$row_etat['id'];
                        $lien="&a=".$article."&e=".$row_etat['id']."&f=".$row_etat['file']."&et=".$row_et_editor['id'];

                        break;
                    case "Revision":

                    $select_decision=$conn->query("SELECT id,decision,editor From decision WHERE state_author=".$row_etat['id']);
                        $row_decision=$select_decision->fetch_assoc();
                        echo"
 <tr>
                                <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">Decision <a href=\"#\" data-width=\"700\" data-rel=".$row_decision['id']." class=\"poplight\">(Read More ...)</a> </div></td>
                                <div id=".$row_decision['id']." class=\"popup_block\">
                
                <p>".$row_etat['state']. "</br></br>".utf8_encode(nl2br($row_decision['decision']))."</p>
            </div>
<td class=\"text-center \"style=\"line-height:3;\">".$row_etat['date']."</td> 
                       </tr>";
                        $select_et_editor = $conn->query("SELECT id FROM state_editor WHERE article=".$article." AND etat='IDLE FOR SUBMITION'");
                        $row_et_editor=$select_et_editor->fetch_assoc();
                    $lien_revision="revision.php?a=".$article."&e=".$row_etat['id']."&ed=".$row_decision['editor'];
                        $lien_revision_valide="&a=".$article."&e=".$row_etat['id']."&f=".$row_etat['file']."&et=".$row_et_editor['id'];


                        break;
                    case "Revision 2":

                        $select_decision=$conn->query("SELECT id,decision,editor From decision WHERE state_author=".$row_etat['id']);
                        $row_decision=$select_decision->fetch_assoc();
                        echo"
 <tr>
                                <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">Decision <a href=\"#\" data-width=\"700\" data-rel=".$row_decision['id']." class=\"poplight\">(Read More ...)</a> </div></td>
                                <div id=".$row_decision['id']." class=\"popup_block\">
                
                <p>".$row_etat['state']. "</br></br>".utf8_encode(nl2br($row_decision['decision']))."</p>
            </div>
<td class=\"text-center \"style=\"line-height:3;\">".$row_etat['date']."</td> 
                       </tr>";
                        $select_et_editor = $conn->query("SELECT id FROM state_editor WHERE article=".$article." AND etat='IDLE FOR SUBMITION'");
                        $row_et_editor=$select_et_editor->fetch_assoc();
                        $lien_revision2="revision2.php?a=".$article."&e=".$row_etat['id']."&ed=".$row_decision['editor'];
                        $lien_revision_valide2="&a=".$article."&e=".$row_etat['id']."&f=".$row_etat['file']."&et=".$row_et_editor['id'];


                        break;
                    case "Accepted":

                        $select_decision=$conn->query("SELECT id,decision,editor From decision WHERE state_author=".$row_etat['id']);
                        $row_decision=$select_decision->fetch_assoc();
                        echo"
                            <tr>
                                <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">Decision <a href=\"#\" data-width=\"700\" data-rel=".$row_decision['id']." class=\"poplight\">(Read More ...)</a> </div></td>
                                <div id=".$row_decision['id']." class=\"popup_block\">
                
                                     <p> ".$row_etat['state']. ":</br></br>".utf8_encode(nl2br($row_decision['decision']))."</p>
                                </div>
                                <td class=\"text-center \"style=\"line-height:3;\">".$row_etat['date']."</td> 
                                 </tr>";

                        break;
                    case "-Revision-":
                        $select_decision=$conn->query("SELECT id,decision,editor From decision WHERE state_author=".$row_etat['id']);
                        $row_decision=$select_decision->fetch_assoc();
                        echo"
                            <tr>
                                <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">Decision <a href=\"#\" data-width=\"700\" data-rel=".$row_decision['id']." class=\"poplight\">(Read More ...)</a> </div></td>
                                <div id=".$row_decision['id']." class=\"popup_block\">
                
                                     <p>Decision :</br></br>".utf8_encode(nl2br($row_decision['decision']))."</p>
                                </div>
                                <td class=\"text-center \"style=\"line-height:3;\">".$row_etat['date']."</td> 
                                 </tr>";

                        break;
                    case "-Revision 2-":
                        $select_decision=$conn->query("SELECT id,decision,editor From decision WHERE state_author=".$row_etat['id']);
                        $row_decision=$select_decision->fetch_assoc();
                        echo"
                            <tr>
                                <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">Decision <a href=\"#\" data-width=\"700\" data-rel=".$row_decision['id']." class=\"poplight\">(Read More ...)</a> </div></td>
                                <div id=".$row_decision['id']." class=\"popup_block\">
                
                                     <p>Decision :</br></br>".utf8_encode(nl2br($row_decision['decision']))."</p>
                                </div>
                                <td class=\"text-center \"style=\"line-height:3;\">".$row_etat['date']."</td> 
                               </tr>";

                        break;
                    case "Refused":
                        $select_decision=$conn->query("SELECT id,decision,editor From decision WHERE state_author=".$row_etat['id']);
                        $row_decision=$select_decision->fetch_assoc();
                        echo"
                            <tr>
                                <td class=\"text-center\"><div style=\"line-height:20%;line-height:3;height: 40px;display:inline-block;\">Decision <a href=\"#\" data-width=\"700\" data-rel=".$row_decision['id']." class=\"poplight\">(Read More ...)</a> </div></td>
                                <div id=".$row_decision['id']." class=\"popup_block\">
                
                                     <p>Refused :</br></br>".utf8_encode(nl2br($row_decision['decision']))."</p>
                                </div>
                                <td class=\"text-center \"style=\"line-height:3;\">".$row_etat['date']."</td> 
                                </tr>";

                        break;
                    default:
                        echo"

                          <tr>
                            <td class=\"text-center \"style=\"line-height:3;\">".$row_etat['state']."</td>
                            <td class=\"text-center\" style=\"line-height:3;\">".$row_etat['date']."</td>
                            </td>
                          </tr>";
                        break;
                }


            }
            echo"</tbody>

  </table>

</div>

</div>";
        }
        
        ?>
            <div class="row profile2">
                <div class="hed"> <p class="text-center">EDITOR</p></div>
                <div class="col-sm-4 pading_left">
                    <img src="../images/profile.png" id="profile"></div>
                <div class="col-sm-7 pading_profile">
                    <div class="form-group">
                        <div class="row min_height">

                            <label class="col-lg-12 control-label no_padding text_label font_14" for="text"><?php echo $row_editor_inf['fname']." ".$row_editor_inf['lname']; ?> </label>
                        </div>
                        <div class="row min_height">
                            <label class="col-lg-4 control-label no_padding " for="text">E-mail : </label>
                            <label class="col-lg-8 control-label no_padding text_label" for="text"><?php echo $row_editor_inf['email']; ?> </label>
                        </div>


                    </div>

                </div>
            </div>

        </div></div>

    <div class ="col-xs-9 contenu">
        <div class="row"><legend class="texte_legend">Article Information</legend> </div>
        <div class="form-group">


            <div class="row">

                <div class="form-group">

                    <label for="text" class="col-lg-2 control-label">ID : </label>
<?php if($etat=="validation" or $etat=="Revision" or $etat=="Revision 2" )
{
    echo " <div class=\"col-lg-5\">";

}else{echo "<div class=\"col-lg-8\">";}?>


                        <label for="text" class=" control-label text-left texte text_label" id="titre" ><?php echo $row['etiquette'].sprintf('%04d',$article); ?> </label>

                    </div>
                <?php if($etat=="validation" or $etat=="Revision" or $etat=="Revision 2" )
                {
                    echo " <div class=\"col-lg-5\">";

                }else{echo "<div class=\"col-lg-2\">";}?>

                        <?php

                        switch ($etat) {
                            case "validation":
                                echo"<a href='".$lien_edit."'><button type=\"button\" class=\"btn btn-primary\"><i class=\"fa  fa-pencil\"></i>&nbsp;Edit</button></a>
                                <a href='valid_article.php?".$lien."'><button type=\"button\" class=\"btn btn-success\"><i class=\"fa fa-check\"></i>&nbsp;Approve</button></a>
                                <a href=\"download.php?ida=".$article."&a=".$row2['name']."\"><button type=\"button\" class=\"btn btn-primary active\"><i class=\"fa fa-download\"></i> Download</button></a>";
                                break;
                            case "Revision" :
                            echo"<a href='".$lien_revision."'><button type=\"button\" class=\"btn btn-primary\"><i class=\"fa  fa-pencil\"></i>&nbsp;Edit</button></a>
                                <a href='revision_confirm.php?".$lien_revision_valide."'><button type=\"button\" class=\"btn btn-success\"><i class=\"fa fa-check\"></i>&nbsp;Approve</button></a>
                                <a href=\"download.php?ida=".$article."&a=".$row2['name']."\"><button type=\"button\" class=\"btn btn-primary active\"><i class=\"fa fa-download\"></i> Download</button></a>";

                            break;
                            case "Revision 2" :
                                echo"<a href='".$lien_revision2."'><button type=\"button\" class=\"btn btn-primary\"><i class=\"fa  fa-pencil\"></i>&nbsp;Edit</button></a>
                                <a href='revision_confirm2.php?".$lien_revision_valide2."'><button type=\"button\" class=\"btn btn-success\"><i class=\"fa fa-check\"></i>&nbsp;Approve</button></a>
                                <a href=\"download.php?ida=".$article."&a=".$row2['name']."\"><button type=\"button\" class=\"btn btn-primary active\"><i class=\"fa fa-download\"></i> Download</button></a>";

                                break;
                            default:echo" <a href=\"download.php?ida=".$article."&a=".$row2['name']."\"><button type=\"button\" class=\"btn btn-primary active\"><i class=\"fa fa-download\"></i> Download</button></a>";

                        }


                        ?>

                    </div>

                </div>
            </div>
            <div class="row">

                <div class="form-group">

                    <label for="text" class="col-lg-2 control-label">Title : </label>

                    <div class="col-lg-10">

                        <label for="text" class=" control-label text-left texte text_label"id="titre" ><?php echo $row['title']; ?> </label>

                    </div>

                </div>

            </div>
            <div class="row">

                <div class="form-group">

                    <label for="textarea" class="col-lg-2 control-label ">Article Type : </label>

                    <div class="col-lg-10">

                        <label for="text" class=" control-label text-left texte text_label"id="type_article" ><?php echo $row['type']; ?> </label>

                    </div>

                </div>

            </div>
            <div class="row">

                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Areas of Article : </label>
                    <div class="col-lg-10">
                        <label for="text" class=" control-label text-left texte text_label"id="area_article" ><?php echo $row['area']; ?> </label>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="form-group">

                    <label for="text" class="col-lg-2 control-label">Abstract : </label>

                    <div class="col-lg-10">

                        <label for="text" class="  text-left texte text_label"id="abstract_article" ><?php  echo $row['abstract'] ; ?> </label>

                    </div>

                </div>

            </div>
            <div class="row">

                <div class="form-group">

                    <label for="text" class="col-lg-2 control-label">Keywords : </label>

                    <div class="col-lg-10">

                        <label for="text" class=" control-label text-left texte text_label"  ><?php echo $row['keywords']; ?> </label>

                    </div>

                </div>

            </div>

            <div class="row"><legend class='texte_legend'>Corresponding author </legend> </div>
            <div class="row">
                <table class="table table-striped" >
                    <thead>
                    <tr>
                        <th>First name</th>
                        <th>Middle name</th>
                        <th>Last name</th>
                        <th>Affiliation</th>
                        <th>Adresse</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class='texte'><?php echo  $_SESSION['fname']; ?></td>
                        <td class='texte'><?php echo  $_SESSION['mname']; ?></td>
                        <td class='texte'><?php echo  $_SESSION['lname']; ?></td>
                        <td class='texte'><?php echo  $_SESSION['affiliation']; ?></td>
                        <td class='texte'><?php echo  $_SESSION['adresse'].", ".$_SESSION['city'].", ".$_SESSION['contry'];?></td>
                        <td class='texte'><?php echo  $_SESSION['email'];?></td>
                    </tr>
                    </tbody>
                    </table></div>
            <?php
            $co=$conn->query("SELECT fname,mname,lname,affiliation,adresse,email  FROM co_author WHERE article=".$article);
            if ($co->num_rows!=0) {
                echo"
<div class=\"row\"><legend class='texte_legend'>Co-Authors </legend> </div>
<div class=\"row\">
    <table class=\"table table-striped\" >
    <thead>
      <tr>
        <th>First name</th>
        <th>Middle name</th>
        <th>Last name</th>
        <th>Affiliation</th>
        <th>Adresse</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>";

                while($co_row = $co->fetch_assoc()){

                    echo"
                    
                         
      <tr>
        <td class='texte'>".$co_row['fname']."</td>
        <td class='texte'>".$co_row['mname']."</td>
        <td class='texte'>".$co_row['lname']."</td>
        <td class='texte'>".$co_row['affiliation']."</td>
        <td class='texte'>".$co_row['adresse']."</td>
        <td class='texte'>".$co_row['email']."</td>
      </tr>
      
    
                    ";
                }
                echo"</tbody>
  </table>
</div>
                       ";
            }
            ?>
        </div>


</div>
    <footer class="row col-sm-12 footer_perso">
        <div class="container-fluid">
            <div class="row">
            <p class="text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>
            </div>
        </div>
    </footer>
</div>

<script src="../../../../jquery/jquery-2.1.3.js"></script>
<script src="../../../../bootstrap/js/bootstrap.min.js"></script>
<script type="application/javascript">
    $('a.poplight').on('click', function() {
        var popID = $(this).data('rel'); //Trouver la pop-up correspondante
        var popWidth = $(this).data('width'); //Trouver la largeur

        //Faire apparaitre la pop-up et ajouter le bouton de fermeture
        $('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"><img src="../images/close.png" class="btn_close" title="Close Window" alt="Close" /></a>');

        //Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
        var popMargTop = ($('#' + popID).height() + 80) / 2;
        var popMargLeft = ($('#' + popID).width() + 80) / 2;

        //Apply Margin to Popup
        $('#' + popID).css({
            'margin-top' : -popMargTop,
            'margin-left' : -popMargLeft
        });

        //Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
        $('body').append('<div id="fade"></div>');
        $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

        return false;
    });


    //Close Popups and Fade Layer
    $('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
        $('#fade , .popup_block').fadeOut(function() {
            $('#fade, a.close').remove();
        }); //...ils disparaissent ensemble

        return false;
    });
</script>
</body>
</html>