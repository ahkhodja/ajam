<?php
session_start();
if(!isset( $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
$id_article=$_GET['idar'];
$etat_editor=$_GET['et_e'];
$id_editor= $_SESSION['editor_in_chief'];

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 01/05/2016
 * Time: 02:23
 */

include_once("../../../../php/cnx.php");
$update=$conn->query("UPDATE state_editor SET vu='yes' WHERE id=".$etat_editor);

$select = $conn->query("SELECT etiquette,title,type,area,abstract,keywords,author FROM article WHERE id=".$id_article);
$row = $select->fetch_assoc();

$select_author = $conn->query("SELECT fname,lname ,email FROM personne WHERE id=".intval($row['author']));
$row_author = $select_author->fetch_assoc();
$select_author = $conn->query("SELECT fname,lname ,email FROM personne WHERE id=".intval($row['author']));
$row_author = $select_author->fetch_assoc();
$select_etat = $conn->query("SELECT id, etat,file, DATE_FORMAT(date, '%d %M') as date FROM state_editor WHERE article=".$id_article);
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Pragma" CONTENT="no-cache">
    <meta http-equiv="Expires" CONTENT="-1">
    <meta http-equiv="Cache-Control" CONTENT="no-cache">

    <title>ID : <?php echo $row["etiquette"].$id_article ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css" />
    <link href="../css/show2.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-2.1.3.js"></script>
</head>
<body>
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-2 logo">
            <a class="no_color" href="../index.php?t=d_sub"> <p class="text-center">Editor Account</p></a>
        </div>
        <div class="col-sm-10 bn">
            <div class="pull-right">
                <a  class="no_color" href="log-out.php"><img src="../images/user.png">Sign out</a>
            </div>
        </div>
    </div>
    <div class="row menu_row">
        <div class="col-sm-2 menu">
            <div class="row profile">
                <div class="hed"> <p>AUTHOR</p></div>
                <div class="col-sm-4 pading_left">
                    <img src="../images/profile.png" id="profile">
                </div>
                <div class="col-sm-7 pading_profile text_moyen">
                    <div class="form-group">
                        <div class="row min_height">
                            <label class="col-lg-12 control-label no_padding font_14 nom text-center" for="text"><?php echo $row_author['fname']." ".$row_author['lname']; ?>  </label>

                        </div>
                        <div class="row min_height">

                            <label class="col-lg-12 control-label no_padding text_label" for="text">&nbsp;<?php echo"". $row_author['email']  ?> </label>
                        </div>


                    </div>

                </div>

            </div>
            <div class="row menu">
                <?php
                echo "<input type=\"hidden\" id=\"ide\" value=\"".$id_editor."\">";
                echo "<input type=\"hidden\" id=\"e_ed\" value=\"".$etat_editor."\">";
                echo "<input type=\"hidden\" id=\"idar\" value=\"".$id_article."\">";
                echo "<input type=\"hidden\" id=\"idau\" value=\"".$row['author']."\">";
                ?>
                <div class="panel panel-info panel_perso">

                    <div class=" head_perso panel-heading ">
                        <h3 class="panel-title font_14">&nbsp;FILES</h3>
                    </div>
                    <div class="panel-body panel_body_perso font_10">
                        <div class="row">
                            <table class="table table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th width="50%" class="text-center">Name</th>
                                    <th width="50" class="text-right">Download</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- --><?php
                                $file_sources=$conn->query("SELECT name,size,type from file WHERE article=".$id_article." AND type like '%source'");
                                while($file_res=$file_sources->fetch_assoc()){
                                    echo "<tr><td ><span class='line_height'>".$file_res['type']."</span></td>";
                                    echo "<td class='text-right'><a href=\"downloads.php?id=".$row["author"]."&ida=".$id_article."&a=".$file_res['name']."\" style=\"color: #FFFFFF\"><button type=\"button\" class=\"btn btn-default active\"><i class=\"fa fa-download\"></i> </button></a></td></tr>";
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row menu">

                <?php
                if($select_etat->num_rows!=0){
                    echo"
<div class=\"panel panel-primary panel_perso\">
<div class=\"panel-heading head_perso\">
<h3 class=\"panel-title text-center\">TRACK</h3>
 </div>
  <table class=\"table table-striped table-condensed font_10\">

    

      

   

    <thead>

      <tr>

        <th width=\"60%\" class=\"text-center\">Status</th>

        <th class=\"text-center\">Date</th>
        

      </tr>

    </thead>

    <tbody>";
                    while($row_etat = $select_etat->fetch_assoc()){

                        $select2 = $conn->query("SELECT name FROM file WHERE id=".$row_etat['file']);
                        $row2 = $select2->fetch_assoc();

                        echo"

      <tr>

        <td class=\"text-center \"style=\"line-height:3;\">".$row_etat['etat']."</td>

        <td class=\"text-center\" style=\"line-height:3;\">".$row_etat['date']."</td>
        
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
        <div class="col-sm-9 pad" >

            <div class="row"><legend class="texte_legend">Article Information</legend> </div>
            <div class="form-group">
                </br>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">ID : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte text_label" id="titre" ><?php echo $row["etiquette"].sprintf('%04d',$id_article); ?> </label>

                        </div>

                    </div>

                </div><div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Title : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte text_label" id="titre" ><?php echo $row['title']; ?> </label>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group">

                        <label for="textarea" class="col-lg-2 control-label ">Article Type : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte text_label" id="type_article" ><?php echo $row['type']; ?> </label>

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

                </br>
                <?php
                $co=$conn->query("SELECT fname,mname,lname,affiliation,adresse,email  FROM co_author WHERE article=".$id_article);
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
                </br>

                <?php


                $select2 = $conn->query("SELECT fname,mname,lname,email FROM sug_rev WHERE article=".$id_article);

                echo"
<div class=\"row\"><legend class='texte_legend'>Reviewers suggested by the authors</legend> </div>
<div class=\"row\">
    <table class=\"table table-striped\" >
    <thead>
      <tr>
        <th>First name</th>
        <th>Middle name</th>
        <th>Last name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>";
                while($row2 = $select2->fetch_assoc()){

                    echo"
                    
                         
      <tr>
        <td class='texte'>".$row2['fname']."</td>
        <td class='texte'>".$row2['mname']."</td>
        <td class='texte'>".$row2['lname']."</td>
        <td class='texte'>".$row2['email']."</td>
      </tr>
      
    
                    ";



                }
                echo"</tbody>
  </table>
</div>
                       ";

                ?>
                </br>
                <?php
                $file=$conn->query("SELECT file  FROM state_editor WHERE  id=".$etat_editor);
                $rowfile = $file->fetch_assoc();
                $file=$conn->query("SELECT name  FROM file WHERE  id=".$rowfile['file']);
                $rowfile2=$file->fetch_assoc();
                echo "<input type=\"hidden\" id=\"file\" value=\"".$rowfile['file']."\">";
                ?>
                </br>
                <div class="row">


                </div>
                <div class="row">

                    <?php
                    $review=$conn->query("SELECT reviewer,date_accepte,resultat,date_result,date_reject,date,state from state_review WHERE article=".$id_article." AND type='review 1'");
                    if($review)
                    {
                        if ($review->num_rows != 0)
                        {
                            echo"
<legend class='texte_legend'> Reviewing status</legend> <table class=\"table table-striped\" >
    <thead>
      <tr>
        <th>First name</th>
        
        <th>Last name</th>
        <th>Email</th>
        <th>Date invited</th>
        <th>Date accepted </th>
        <th>Date completed</th>
        <th>Date rejected</th>
        <th>Recommandation</th>
      </tr>
    </thead>
    <tbody>";
                            while ($res_rev=$review->fetch_assoc()){
                                $reviewver=$conn->query("SELECT fname,mname,lname,email from reviewer WHERE id=".$res_rev["reviewer"]);

                                if($reviewver){
                                    $rev_inf=$reviewver->fetch_assoc();
                                }else{die('Error : ('. $conn->error .') '. $conn->error);}
                                echo"
    <tr>
        <td class='texte'>".$rev_inf['fname']."</td>
        
        <td class='texte'>".$rev_inf['lname']."</td>
        <td class='texte'>".$rev_inf['email']."</td>        
        <td class='texte'>".$res_rev["date"]."</td>
        <td class='texte'>".$res_rev["date_accepte"]."</td>
        <td class='texte'>".$res_rev["date_result"]."</td>
        <td class='texte'> ".$res_rev["date_reject"]."</td>
      
    ";if($res_rev["state"]!=null){
                                    if($res_rev["state"]=='Finished'){
                                        $select=$conn->query("SELECT Novelty,Technical,Relevance,Quality,Comments,recommendation,Confidential from res_rev WHERE id=".$res_rev["resultat"]);
                                        if($select){
                                            $row_rev=$select->fetch_assoc();
                                            echo "
 <div id=d".$res_rev["resultat"]." class=\"popup_block\">
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

  </div>";


                                        }echo" <td class='texte'> <a href=\"#\" data-width=\"700\" data-rel=d".$res_rev["resultat"]." class=\"poplight\">".$row_rev['recommendation']."</a></td>  ";
                                    }else{
                                        echo" <td class='texte'>------</td> ";}
                                }else
                                {
                                    echo" <td class='texte'>-----</td>  ";
                                }

                            }
                            echo"</tr></tbody></table>";

                        }}

                    ?>




                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-1 control-label bordure_n  "><span class="line_height">File :</span> </label>

                        <div class="col-lg-10">

                            <?php
                            $file=$conn->query("SELECT file  FROM state_editor WHERE  id=".$etat_editor);
                            $rowfile = $file->fetch_assoc();
                            $file=$conn->query("SELECT name  FROM file WHERE  id=".$rowfile['file']);
                            $rowfile2=$file->fetch_assoc();

                            echo" <a href=\"download.php?id=".$row["author"]."&ida=".$id_article."&a=".$rowfile2['name']."\" style=\"color: #FFFFFF\">";
                            ?><button type="button" class="btn btn-primary active"><i class="fa fa-download"></i> Download</button></a>

                        </div>

                    </div>

                </div>
                <?php
                echo "<input type=\"hidden\" id=\"file\" value=\"".$rowfile['file']."\">";
                ?>
                <div class="row decision_sec">

                    <div class="form-group">

                        <label for="text" class="col-lg-1 control-label bordure_n"><span class="line_height"> Decision :</span> </label>

                        <div class="col-lg-5">

                            <select name="decision" id="decision" value="" class="form-control texte">
                                <option value="" class='texte'>-- Please Select --</option>
                                <option value="Submit to Review Process" class='texte'>Submit to Review Process</option> // DEFAULT OPTION
                                <option value="Reject as it is" class='texte'>Reject as it is</option>
                                <option value="Transfer to editor in chief" class='texte'>Transfer</option>

                            </select>

                        </div>

                        <div class="col-lg-1">
                            <img src="../images/gears.gif" style="display: none;" id="wait">
                        </div>

                    </div>
                    </br>

                    <div class="row decision" id="Accepted_for_reveiw">

                        <div class="form-group">

                            <label for="text" class="col-lg-11 control-label"></label>

                            <div class="col-lg-1">
                                <button type="button" class="btn btn-primary " id="accepted_r"> Submit </button>
                            </div>

                        </div>

                    </div>
                    <div class="row decision" id="refused_section">
                        <div class="form-group text_desion ">
                            <div class="col-lg-12 bordure_n ">
                                <textarea  name="decision" rows="15" class="form-control" id="decision_text" placeholder ="Decision ..."></textarea>
                            </div>

                        </div>

                        <div class="form-group">

                            <label for="text" class="col-lg-11 control-label"></label>

                            <div class="col-lg-1">

                                <button type="button" class="btn btn-primary" id="refused"> Submit </button>


                            </div>

                        </div>

                    </div>
                    <div class="row decision" id="transmit">
                        <div class="form-group ">
                            <label for="text" class="col-lg-2 control-label bordure_n  "> </label>
                            <div class="col-lg-5  ">
                                <select name="editor"  id="editor" class="form-control">

                                    <?php $select_editor = $conn->query("SELECT id,fname,lname  FROM editor");
                                    while($data = mysqli_fetch_assoc($select_editor)){
                                        echo"<option value='".$data['id']."'>".$data['fname']." ".$data['lname']."</option>";


                                    }
                                    ?>

                                </select> </div>
                            <div class="col-lg-1 bordure_n">

                                <button type="button" class="btn btn-primary" id="transmit_e"> Transfer </button>


                            </div>

                        </div>



                    </div>
                    <div class="row decision " id="add_rev">

                        <div class="form-group">

                            <label for="textarea" class="col-lg-1 control-label bordure_n "><span class="titre_select">  </span> </label>
                            <div class="col-lg-8">

                                <select  id="rev" class="form-control" name="tfile" >

                                    <?php $select = $conn->query("SELECT id,fname,lname,email  FROM reviewer");
                                    while($data = mysqli_fetch_assoc($select)){
                                        echo"<option value='".$data['id']."'>".$data['fname']." ".$data['lname']." | ".$data['email']."</option>";


                                    }
                                    ?>

                                </select>


                            </div>
                            <div class="col-lg-1">

                                <button type="button" class="btn btn-primary" id="send_rev"> Send </button>


                            </div>
                        </div>
                    </div>








                </div>
            </div>

        </div>
    </div>
    <footer class=" footer_perso">

        <p class="text-center">Copyright &copy; 2015 - All Rights Reserved - <a href="http://www.csc.dz">(CRTI)</a></p>

    </footer>
    <script type="application/javascript">
        $(function(){

            ide=$('#ide').val();
            e_ed=$('#e_ed').val();
            idar=$('#idar').val();
            idau=$('#idau').val();
            file=$('#file').val();
            $('select[value]').each(function(){
                $(this).val(this.getAttribute("value"));
            });
            $('.decision').hide();
            $("#decision").change(function(){
                $('.decision').hide();
                resultat=$("#decision option:selected").text();

                if(resultat=='Reject as it is')
                {$("#refused_section").show();
                    $('html,body').animate({scrollTop: $("#refused_section").offset().top}, 'slow');}
                if(resultat=='Transfer')
                {$("#transmit").show();
                    $('html,body').animate({scrollTop: $("#transmit").offset().top}, 'slow');}
                if(resultat=='Submit to Review Process')
                {$("#add_rev").show();
                    $('html,body').animate({scrollTop: $("#transmit").offset().top}, 'slow');}
            });
            $('#send_rev').click( function (){
                $("#wait").show();
                idrev=$( "#rev option:selected" ).val();
                data_sub="idar="+idar+"&idfile="+file+"&idrev="+idrev+"&e_ed="+e_ed;
                console.log(data_sub);
                $.ajax({


                    type:"POST",
                    url:"add_rev.php",
                    data: data_sub,async:false,
                    success:function(data)
                    {
                        location.reload(true);



                    }
                });

            });
            $('#refused').click( function (){
                $("#wait").show();
                dec=$("#decision_text").val();
                data_sub="ar="+idar+"&dec="+dec+"&e_ed="+e_ed+"&file="+file;
                console.log(data_sub);
                $.ajax({


                    type:"POST",
                    url:"../decision/d_dec_ref_sub.php",
                    data: data_sub,async:false,
                    success:function(data)
                    {
                        if(data == 1)
                        {
                            window.location.href="../index.php?t=ref_ar";
                        }
                        else
                        {


                        }



                    }
                });

            });
            $('#transmit_e').click( function (){
                $("#wait").show();
                edit=$("#editor").val();
                data_sub="&e_ed="+e_ed+"&ed="+edit;
                console.log(data_sub);
                $.ajax({


                    type:"POST",
                    url:"../decision/transmit_ed.php",
                    data: data_sub,async:true,
                    success:function(data)
                    {
                        if(data == 1)
                        {
                            window.location.href="../index.php?t=d_sub";
                        }
                        else
                        {


                        }



                    }
                });

            });
        });
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
