<?php
header('Content-type: text/html; charset=UTF-8');
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
mb_internal_encoding("UTF-8");
$select = $conn->query("SELECT title,type,area,abstract,keywords,author FROM article WHERE id=".$id_article);
$row = $select->fetch_assoc();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" xml:lang="fr" lang="fr">
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
    <div class="col-xs-2">
       <?php
       echo "<input type=\"hidden\" id=\"ide\" value=\"".$id_editor."\">";
       echo "<input type=\"hidden\" id=\"e_ed\" value=\"".$etat_editor."\">";
       echo "<input type=\"hidden\" id=\"idar\" value=\"".$id_article."\">";
       echo "<input type=\"hidden\" id=\"idau\" value=\"".$row['author']."\">";
       ?>



    </div>
    <div class="col-xs-9">
        <div class="row"><legend>Article Information</legend> </div>
    <div class="form-group">
        </br>
        <div class="row">

            <div class="form-group">

                <label for="text" class="col-lg-2 control-label">Title : </label>

                <div class="col-lg-10">

                    <label for="text" class=" control-label text-left texte"id="titre" ><?php echo $row['title']; ?> </label>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="form-group">

                <label for="textarea" class="col-lg-2 control-label">Article Type : </label>

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

                    <label for="text" class="  text-left texte"id="abstract_article" ><?php mb_internal_encoding("UTF-8"); echo utf8_decode($row['abstract']) ; ?> </label>

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
<div class=\"row\"><legend>Reviews Suggestions</legend> </div>
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
<div class=\"row\"><legend>Co-Authors </legend> </div>
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
        <div class="row">

            <div class="form-group">

                <label for="text" class="col-lg-2 control-label">File : </label>

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
        </br>
        </br>
        <div class="row">

            <div class="form-group">

                <label for="text" class="col-lg-1 control-label ">Decision : </label>

                <div class="col-lg-5">

                    <select name="decision" id="decision" value="" class="form-control texte">
                    <option value="" class='texte'>-- Please Select --</option>
                    <option value="accept for revision" class='texte'>Accept for revision</option> // DEFAULT OPTION
                    <option value="refused" class='texte'>Refused</option>
                    <option value="refused" class='texte'>Transmit to editor in chief</option>

                     </select>

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

                <div class="form-group">

                    <label for="text" class="col-lg-11 control-label"></label>

                    <div class="col-lg-1">

                        <button type="button" class="btn btn-primary" id="refused"> Submit </button>


                    </div>

                </div>

            </div>
            <div class="row decision" id="transmit">

                <div class="form-group">

                    <label for="text" class="col-lg-11 control-label"></label>

                    <div class="col-lg-1">

                        <button type="button" class="btn btn-primary" id="transmit_e"> transmit </button>


                    </div>

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
                $('html,body').animate({scrollTop: $("#Accepted_for_reveiw").offset().top}, 'slow');}
            if(resultat=='Refused')
            {$("#refused_section").show();
                $('html,body').animate({scrollTop: $("#refused_section").offset().top}, 'slow');}
            if(resultat=='Transmit to editor in chief')
            {$("#transmit").show();
                $('html,body').animate({scrollTop: $("#transmit").offset().top}, 'slow');}
        });
        $('#accepted_r').click(function() {

            data_sub="ide="+ide+"&e_ed="+e_ed+"&idar="+idar+"&idau="+idau+"&idf="+file;
            
            $.ajax({
                type:"POST",
                url:"accepte_review.php",
                data: data_sub,async:false,
                success:function(data)
                {
                    if(data == 1)
                    {
                        alert("ok");
                    }
                    else
                    {


                    }
                }


            });
        });
    });


</script>
</body>
</html>
