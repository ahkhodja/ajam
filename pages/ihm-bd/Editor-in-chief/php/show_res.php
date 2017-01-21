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
$row_author = $select_author->fetch_assoc()

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Document sans nom</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css" />
    <link href="../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-2.1.3.js"></script>
    <link href="../css/show.css" rel="stylesheet" type="text/css">
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


    <div class="row">
        <div class="col-lg-2 info_bar" >
            <?php
            echo "<input type=\"hidden\" id=\"ide\" value=\"".$id_editor."\">";
            echo "<input type=\"hidden\" id=\"e_ed\" value=\"".$etat_editor."\">";
            echo "<input type=\"hidden\" id=\"idar\" value=\"".$id_article."\">";
            echo "<input type=\"hidden\" id=\"idau\" value=\"".$row['author']."\">";
            ?>

                <div class="panel-group texttt">
                    <div class="panel panel-info panel_perso">
                        <div class="panel-heading text-center head_perso">File sources</div>
                        <div class="panel-body">
                            <div class="row">
                                <table class="table table-striped table-condensed">
                                    <thead>
                                    <tr>
                                        <th width="70%" class="text-center">Name</th>
                                        <th width="30">Size</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- --><?php
                                    $file_sources=$conn->query("SELECT name,size,type from file WHERE article=".$id_article." AND type like '%source'");
                                    while($file_res=$file_sources->fetch_assoc()){
                                        echo "<tr><td>".$file_res['type']."</td>";
                                        echo "<td>".$file_res['size']."</td></tr>";
                                    }
                                    ?>
    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            

        </div>
        <div class="col-xs-9 contenu_bar">
            <div class="row"><legend class="texte_legend">Article Information</legend> </div>
            <div class="form-group">
                </br>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">ID : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte"id="titre" ><?php echo $row{'etiquette'}.$id_article; ?> </label>

                        </div>

                    </div>

                </div><div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Title : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte"id="titre" ><?php echo $row['title']; ?> </label>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group">

                        <label for="textarea" class="col-lg-2 control-label ">Article Type : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte"id="type_article" ><?php echo $row['type']; ?> </label>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Areas of Article : </label>
                        <div class="col-lg-10">
                            <label for="text" class=" control-label text-left texte"id="area_article" ><?php echo $row['area']; ?> </label>
                        </div>

                    </div>
                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Abstract : </label>

                        <div class="col-lg-10">

                            <label for="text" class="  text-left texte"id="abstract_article" ><?php  echo $row['abstract'] ; ?> </label>

                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="form-group">

                        <label for="text" class="col-lg-2 control-label">Keywords : </label>

                        <div class="col-lg-10">

                            <label for="text" class=" control-label text-left texte"  ><?php echo $row['keywords']; ?> </label>

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

                    <?php
                    $review=$conn->query("SELECT reviewer,date_accepte,resultat,date_result,date,state from state_review WHERE article=".$id_article);
                    if($review)
                    {

                        echo"
<legend class='texte_legend'>State review </legend> <table class=\"table table-striped\" >
    <thead>
      <tr>
        <th>First name</th>
        <th>Middle name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Date</th>
        <th>State</th>
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
        <td class='texte'>".$rev_inf['mname']."</td>
        <td class='texte'>".$rev_inf['lname']."</td>
        <td class='texte'>".$rev_inf['email']."</td>        
        <td class='texte'>".$res_rev["date"]."</td>
      
    ";if($res_rev["state"]!=null){
                                if($res_rev["state"]=='Finished'){

                                    echo" <td class='texte'> <a href=\"result_rev.php?id=".$res_rev["resultat"]."\" onclick=\"javascript:window.open(this.href,'Popup','height=500,width=750,scrollbars=yes,location=no');return false;\">Result...</a></td>  ";

                                }else{
                                echo" <td class='texte'>".$res_rev["state"]."</td>  ";}
                            }else
                            {
                                echo" <td class='texte'>-----</td>  ";
                            }

                        }
                        echo"</tr></tbody></table>";

                    }

                    ?>




                </div>
                <div class="row" >

                    <div class="form-group">

                        <label for="textarea" class="col-lg-1 bordure_n "><span class="pull-right titre_select">Decision : </span></label>
                        <div class="col-lg-10 ">

                            <select  id="des" class="form-control" name="desicion" >
                            <option value="">Please select ...</option>
                            <option value="Accept">Accept</option>
                              <option value="Accept with revision">Accept with revision</option>
                                <option value="Refused">Refused</option>

                                <option value="Add reviewver">Add reviewver</option>

                            </select>


                        </div>

                    </div>
                    
                </div>
                <div class="row bt" id="text_dec_div">
                    <div class="form-group text_desion ">



                        <div class="col-lg-12 bordure_n ">

                            <textarea  name="decision" rows="15" class="form-control" id="decision" placeholder ="Desicion ..."></textarea>

                        </div>

                    </div>
                    
                    
                    
                </div>
                <div class="row pull-right bt " id="acc_div">

                    <button type="button" class="btn btn-primary" id="acc_bt"> Send </button>
                </div>
                <div class="row pull-right bt" id="acc_w_div">

                    <button type="button" class="btn btn-primary" id="acc_w_bt"> Send </button>
                </div>
                <div class="row pull-right bt">

                    <button type="button" class="btn btn-primary" id="ref_bt"> Send </button>
                </div>
                <div class="row bt " id="add_rev">

                    <div class="form-group">

                        <label for="textarea" class="col-lg-1 control-label bordure_n "><span class="titre_select">  </span> </label>
                        <div class="col-lg-10">

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
    <div class="col-xs-1">

    </div>

</div>
</div>
<script type="application/javascript">
    $(function(){
        $('#des').val("");
        $("#text_dec_div").hide();
        $("#add_rev").hide();
        $(".bt").hide();
        ide=$('#ide').val();
        e_ed=$('#e_ed').val();
        idar=$('#idar').val();
        idau=$('#idau').val();
        file=$('#file').val();

    });
    $('#des').change(function() {

        if($('#des').val()=='Accept'){
            $(".bt").hide("slow");
            $("#text_dec_div").show("slow");
            $("#acc_div").show("slow");

        }
        if($('#des').val()=='Add reviewver'){
            $(".bt").hide();
            $("#add_rev").show("slow");

        }
        if($('#des').val()=='Accept with revision'){
            $(".bt").hide();
            $("#text_dec_div").show("slow");
            $("#acc_w_div").show("slow");

        }

    });
    $('select[value]').each(function(){
        $(this).val(this.getAttribute("value"));
    });
    $('#send_rev').click( function (){
        idrev=$( "#rev option:selected" ).val();
        data_sub="idar="+idar+"&idfile="+file+"&idrev="+idrev+"&e_ed="+e_ed;
        console.log(data_sub);
        $.ajax({


            type:"POST",
            url:"add_rev2.php",
            data: data_sub,async:false,
            success:function(data)
            {
                location.reload(true);



            }
        });

    });

    $('#acc_w_bt').click( function (){
        dec=$("#decision").val();
        data_sub="ar="+idar+"&dec="+dec+"&e_ed="+e_ed;
        console.log(data_sub);
        $.ajax({


            type:"POST",
            url:"acc_w_r.php",
            data: data_sub,async:false,
            success:function(data)
            {




            }
        });

    });
    $('#acc_bt').click( function (){
        dec=$("#decision").val();
        data_sub="ar="+idar+"&dec="+dec+"&e_ed="+e_ed;
        console.log(data_sub);
        $.ajax({


            type:"POST",
            url:"acc_article.php",
            data: data_sub,async:false,
            success:function(data)
            {




            }
        });

    });


</script>
</body>
</html>
