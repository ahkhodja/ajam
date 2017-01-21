<?php
session_start();
if(!isset(  $_SESSION['editor_in_chief'])){

    header('Location: ../log-in.php');

}
$id_article=$_GET['idar'];
$etat_editor=$_GET['et_e'];
$id_editor=1;

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 01/05/2016
 * Time: 02:23
 */

include_once("../../../../php/cnx.php");

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

    <title>SUBMITED</title>
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
            <a class="no_color" href="index2.php?t=sub"> <p class="text-center">Editor Account</p></a>
        </div>
        <div class="col-sm-10 bn">
            <div class="pull-right">
            <a class="no_color" href="log-out.php"><img src="../images/user.png"><?php echo  " ".$_SESSION['editor_in_chief_fname']." ". $_SESSION['editor_in_chief_lname']; ?></a>
        </div>
            </div>
    </div>
    <div class="row menu_row">
        <div class="col-sm-2 menu">
            <div class="row profile">
                <div class="hed"> <p>AUTHOR</p></div>
                <div class="col-sm-2 pading_left">
                    <img src="../images/profile.png" id="profile">
                </div>
                <div class="col-sm-9 pading_profile text_moyen">
                    <div class="form-group">
                        <div class="row min_height">
                            <label class="col-lg-12 control-label no_padding font_14" for="text"><?php echo $row_author['fname']." ".$row_author['lname']; ?>  </label>

                        </div>
                        <div class="row min_height">
                            <label class="col-lg-2 control-label no_padding" for="text">Email: </label>
                            <label class="col-lg-10 control-label no_padding text_label" for="text">&nbsp;<?php echo" ". $row_author['email']  ?> </label>
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
                <div class="panel panel-info panel_perso font_10">

                    <div class=" head_perso panel-heading ">
                        <h3 class="panel-title font_14">&nbsp;FILES</h3>
                    </div>
                    <div class="panel-body panel_body_perso">
                        <div class="row">
                            <table class="table table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th width="50%" class="text-center">Name</th>
                                    <th width="50" class="text-center">Download</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- --><?php
                                $file_sources=$conn->query("SELECT name,size,type from file WHERE article=".$id_article." AND type like '%source'");
                                while($file_res=$file_sources->fetch_assoc()){
                                    echo "<tr><td class='text-center'><span class='line_height'>".$file_res['type']."</span></td>";
                                    echo "<td class='text-center'><a href=\"downloads.php?id=".$row["author"]."&ida=".$id_article."&a=".$file_res['name']."\" style=\"color: #FFFFFF\"><button type=\"button\" class=\"btn btn-default active\"><i class=\"fa fa-download\"></i> </button></a></td></tr>";
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
<div class=\"panel panel-primary panel_perso font_10\">
<div class=\"panel-heading head_perso\">
<h3 class=\"panel-title text-center\">TRACK</h3>
 </div>
  <table class=\"table table-striped table-condensed\">

    

      

   

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

                            <label for="text" class=" control-label text-left texte text_label" id="titre" ><?php echo $row["etiquette"].$id_article; ?> </label>

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


                $select2 = $conn->query("SELECT fname,mname,lname,email FROM sug_rev WHERE article=".$id_article);

                echo"
<div class=\"row\"><legend class='texte_legend'>Reviews Suggestions</legend> </div>
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
                                <option value="accept for revision" class='texte'>Accept for revision</option> // DEFAULT OPTION
                                <option value="refused" class='texte'>Refused</option>
                                <option value="refused" class='texte'>Transmit to editor</option>

                            </select>

                        </div>
                        
                        <div class="col-lg-1">
                            <img src="../images/gears.gif" style="display: none;" id="wait">
                        </div>
                        <div class="col-lg-5">
                            <label for="text" class="col-lg-12 control-label rouge" id="erreur" style="display:none">Erreur: Action can't be done </label>
                        </div>

                    </div>
                </div>


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
                                <textarea  name="decision" rows="15" class="form-control" id="decision_text" placeholder ="Desicion ..."></textarea>
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

                        <div class="form-group">

                                <label for="text" class="col-lg-1 control-label bordure_n"></label>
                            <div class="col-lg-5">
                                <select name="editor"  id="editor" class="form-control">

                                    <?php $select_editor = $conn->query("SELECT id,fname,lname  FROM editor");
                                    while($data = mysqli_fetch_assoc($select_editor)){
                                        echo"<option value='".$data['id']."'>".$data['fname']." ".$data['lname']."</option>";


                                    }
                                    ?>

                                </select>
                            </div>



                                <button type="button" class="btn btn-primary" id="transmit_e"> transmit </button>





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
                if(resultat=='Accept for revision')
                {$("#Accepted_for_reveiw").show();
                    $("#erreur").hide();
                    $('html,body').animate({scrollTop: $("#Accepted_for_reveiw").offset().top}, 'slow');}
                if(resultat=='Refused')
                {$("#refused_section").show();
                    $("#erreur").hide();
                    $('html,body').animate({scrollTop: $("#refused_section").offset().top}, 'slow');}
                if(resultat=='Transmit to editor')
                {$("#transmit").show();
                    $("#erreur").hide();
                    $('html,body').animate({scrollTop: $("#transmit").offset().top}, 'slow');}
            });
            $('#accepted_r').click(function() {
                $("#wait").show();
                data_sub="ide="+ide+"&e_ed="+e_ed+"&idar="+idar+"&idau="+idau+"&idf="+file;

                $.ajax({
                    type:"POST",
                    url:"accepte_review.php",
                    data: data_sub,async:false,
                    success:function(data)
                    {
                        if(data == 1)
                        {
                            window.location.href="../index2.php?t=w_r";
                        }
                        else
                        {


                        }
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
                    url:"ref_b_r.php",
                    data: data_sub,async:false,
                    success:function(data)
                    {
                        if(data==1){

                            window.location.href="../index2.php?t=ref_ar";

                        }



                    }
                });

            });
            $('#transmit_e').click( function (){
                $("#wait").show();
                edit=$("#editor").val();
                data_sub="ed="+edit+"&e_ed="+e_ed;
                console.log(data_sub);
                $.ajax({


                    type:"POST",
                    url:"transmit_ed.php",
                    data: data_sub,async:false,
                    success:function(data)
                    {

                        if(data == 1)
                        {

                           window.location.href="../index2.php?t=sub";
                        }
                        else
                        {
                            $("#wait").hide();
                            $("#erreur").show();

                        }


                    }
                });

            });
        });


    </script>

</body>
</html>
