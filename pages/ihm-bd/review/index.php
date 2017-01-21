<?php

session_start();
if(!isset($_SESSION['reviwer'])){

    header('Location: log-in.php');

}

$id_rev= $_SESSION['reviwer'];

$contenu="";
include_once("../../../php/cnx.php");
$select_sub=$conn->query("SELECT id,article,DATE_FORMAT(date_result, '%m-%d-%Y') as date_result,resultat,file,decision FROM state_review WHERE reviewer=".$id_rev." AND state='Finished' ORDER BY date_result desc");
if($select_sub){
    $contenu = $contenu ."
        <div class=\"panel panel-info panel_perso\">



                    <table class=\"table table-bordered table-condensed layout\">
                    <div class=\"panel-heading head_perso\">

                         <h3 class=\"panel-title text-center\">Reviews submited</h3>

                      </div>
                    <thead>
                        
                        
                        <tr>
                            <th class='text-center'>Manuscript ID</th>
                            <th width=\"40%\">Title</th>
                            <th class='text-center'>Editor</th>
                            <th class='text-center'>Date completed</th>
                            <th class='text-center'>View my review</th>
                            <th class='text-center'>Status</th>
                        </tr>
                      </thead>
                        <tbody>
                        ";
    if($select_sub->num_rows!=0){

        while($row_sub=$select_sub->fetch_assoc()){
            $select_article=$conn->query("SELECT etiquette,title,author FROM article WHERE id=".$row_sub['article']);
            $row_article=$select_article->fetch_assoc();
            $select_editor_id=$conn->query("SELECT editor FROM state_editor WHERE article=".$row_sub['article']);
            $row_select_id=$select_editor_id->fetch_assoc();

            $select_editor=$conn->query("SELECT fname,lname,email from editor WHERE id=".$row_select_id['editor']);
            $row_editor=$select_editor->fetch_assoc();
            $select_resultat=$conn->query("SELECT Novelty,Technical,Relevance,Quality,Comments,recommendation,Confidential from res_rev WHERE id=".$row_sub["resultat"]);
            $row_rev=$select_resultat->fetch_assoc();
            $select_file=$conn->query("SELECT name FROM file where id=".$row_sub['file']);
            $row_file=$select_file->fetch_assoc();

            if($row_sub['decision']!="Null"){
            $selec_decision=$conn->query("SELECT decision from decision WHERE id=".$row_sub['decision']);
                if($selec_decision){
                    if($selec_decision->num_rows!=0){
            $row_decision=$selec_decision->fetch_assoc();

            }}}
            $contenu = $contenu ."<tr>
 <td class='text-center'>".$row_article['etiquette'].$row_sub['article']."</td>
 <td >".$row_article['title']." <a href=\"php/download.php?id=".$row_article["author"]."&ida=".$row_sub['article']."&a=".$row_file['name']."\" > (view manuscript)</a> </td>
 <td class='text-center'>".$row_editor['fname']." ".$row_editor['lname']."</td>
 <td class='text-center'>".$row_sub['date_result']."</td>
 <td class='text-center'> <a href=\"#\" data-width=\"700\" data-rel=d".$row_sub["resultat"]." class=\"poplight\">".$row_rev['recommendation']."</a></td>
 ";
            if($selec_decision){
            if($selec_decision->num_rows!=0){
                $contenu = $contenu .  "<td class='text-center'><a href=\"#\" data-width=\"700\" data-rel=s".$row_sub['decision']." class=\"poplight\">Decision Lettre</a> </td>
 </tr>
  
 ";
            }}else{
                $contenu = $contenu .  "<td class='text-center'></td>
 </tr>
  
 ";
            }

            $contenu = $contenu ."<div id=d".$row_sub["resultat"]." class=\"popup_block\">
            <div class=\"row\">

                <div class=\"form-group\">

                    <label for=\"text\" class=\"col-lg-5 control-label\">Novelty and originality  : </label>

                    <div class=\"col-lg-7\">

                        <label for=\"text\" class=\" control-label text-left texte text_label\"id=\"titre\" > ".$row_rev['Novelty']." </label>

                    </div>

                </div>

            </div>
            <div class=\"row\">

                <div class=\"form-group\">

                    <label for=\"text\" class=\"col-lg-5 control-label\">Technical content and correctness :</label>

                    <div class=\"col-lg-7\">

                        <label for=\"text\" class=\" control-label text-left texte text_label\"id=\"titre\" > ".$row_rev['Technical']." </label>

                    </div>

                </div>

            </div>
            <div class=\"row\">

                <div class=\"form-group\">

                    <label for=\"text\" class=\"col-lg-5 control-label\">Relevance and Timeliness :</label>

                    <div class=\"col-lg-7\">

                        <label for=\"text\" class=\" control-label text-left texte text_label\"id=\"titre\" > ".$row_rev['Relevance']." </label>

                    </div>

                </div>

            </div>
   
      <div class=\"row\">

                <div class=\"form-group\">

                    <label for=\"text\" class=\"col-lg-5 control-label\">Quality of presentation :</label>

                    <div class=\"col-lg-7\">

                        <label for=\"text\" class=\" control-label text-left texte text_label\"id=\"titre\" > ". $row_rev['Quality']." </label>

                    </div>

                </div>

      </div>
    <div class=\"row\">

                <div class=\"form-group\">

                    <label for=\"text\" class=\"col-lg-5 control-label\">Overall recommendation : :</label>

                    <div class=\"col-lg-7\">

                        <label for=\"text\" class=\" control-label text-left texte text_label\"id=\"titre\" > ". $row_rev['recommendation']." </label>

                    </div>

                </div>

      </div>
      <label>Comments :</label>
<p>". nl2br($row_rev['Comments'])."</p>
<label>Confidential :</label>
<p style=color:red;>". nl2br($row_rev['Confidential'])."</p>

  </div>";  if($selec_decision){
                if($selec_decision->num_rows!=0){
            $contenu = $contenu ."<div id=s".$row_sub['decision']." class=\"popup_block\"><p>
            ".$row_decision['decision']."
            </p></div>";}}



        }


    }else{

        $contenu = $contenu ."<td colspan=6 class='text-center'>There are no manuscripts in this list.</td>";

    }$contenu = $contenu ." </tbody>
  </table>
  </div>";}
$select = $conn->query("SELECT id,article,date_accepte,DATE_FORMAT(DATE_ADD(date_accepte, INTERVAL 90 DAY),'%d-%m-%Y') AS endDate,cle,cle2,file,type FROM state_review WHERE reviewer=".$id_rev." AND state='Accepted' ORDER BY date desc");
if($select){
    $contenu = $contenu ."
        <div class=\"panel panel-info panel_perso\">



                    <table class=\"table table-bordered table-condensed layout\">
                    <div class=\"panel-heading head_perso\">

                         <h3 class=\"panel-title text-center\">Manuscript in Review</h3>

                       </div>
                    <thead>
                        
                        
                        <tr>
                            <th class='text-center'  >Manuscript ID</th>
                            <th width=\"60%\">Title</th>
                            <th class='text-center'>Due Date</th>
                            <th class='text-center'>Review and score</th>
                        </tr>
                        </thead>
                        <tbody>
                        ";

    if($select->num_rows!=0){



        while($row_state=$select->fetch_assoc()){
            $select_article=$conn->query("SELECT etiquette,title,author FROM article WHERE id=".$row_state['article']);
            $row_article=$select_article->fetch_assoc();
            $select_file=$conn->query("SELECT name FROM file where id=".$row_state['file']);
            $row_file=$select_file->fetch_assoc();

$contenu = $contenu ." <tr>
                        <td class='text-center'>".$row_article['etiquette'].$row_state['article']."</td>
                        <td>".$row_article['title']." <a href=\"php/download.php?id=".$row_article["author"]."&ida=".$row_state['article']."&a=".$row_file['name']."\" > (view manuscript)</a></td>
                        <td class='text-center'>".$row_state['endDate']."</td>";
            switch ($row_state['type']){
                case "review 1":
                    $select_et_ed=$conn->query("SELECT id,editor from state_editor WHERE article=".$row_state['article']." AND (etat='Draft Submited' or etat='-Draft Submited-')");
                    $row_etat=$select_et_ed->fetch_assoc();

                    $contenu = $contenu ."<td class='text-center'><a href=\"review.php?c1=".$row_state["cle"]."&c2=".$row_state["cle2"]."&rsa=".$row_state["id"]."&f=".$row_state["file"]."&b=".$row_etat['editor']."&et_ed=".$row_etat['id']."\" class=\"lien\">Link to score sheet</a></td></tr>";
                    break;
                case "Review 2":
                    $select_et_ed=$conn->query("SELECT id,editor from state_editor WHERE article=".$row_state['article']." AND (etat='R1 Submited' or etat='-R1 Submited-')");
                    $row_etat=$select_et_ed->fetch_assoc();

                    $contenu = $contenu ."<td class='text-center'><a href=\"review2.php?c1=".$row_state["cle"]."&c2=".$row_state["cle2"]."&rsa=".$row_state["id"]."&f=".$row_state["file"]."&b=".$row_etat['editor']."&et_ed=".$row_etat['id']."\" class=\"lien\">Link to score sheet</a></td></tr>";
                    break;
                case "review 3":
                    $select_et_ed=$conn->query("SELECT id,editor from state_editor WHERE article=".$row_state['article']." AND (etat='R2 Submited' or etat='-R2 Submited-')");
                    $row_etat=$select_et_ed->fetch_assoc();

                    $contenu = $contenu ."<td class='text-center'><a href=\"review3.php?c1=".$row_state["cle"]."&c2=".$row_state["cle2"]."&rsa=".$row_state["id"]."&f=".$row_state["file"]."&b=".$row_etat['editor']."&et_ed=".$row_etat['id']."\" class=\"lien\">Link to score sheet</a></td></tr>";
                    break;

            }



        }




    }else{
        $contenu = $contenu ."<td colspan=4>There are no manuscripts in this list.</td>";

    }$contenu = $contenu ."</tbody>
                        
                        </table></div>";}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reviewver Account</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css" />
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/usr_home.css" rel="stylesheet" type="text/css">
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
            <ul class ="nav navbar-nav  pull-right ">
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
        <div id="contenu">

            <?php echo $contenu;?>
        </div>
    </div>

    <footer class="row col-sm-12 ">

        <p class="footer_perso text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

    </footer>
</div>
<script>
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