<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 01/08/2016
 * Time: 10:57
 */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>AJAM | Algerian Journal for Avanced Materials</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <script>window.jQuery || document.write('<script src="js/jquery-1.8.1.min.js"><\/script>')</script>



</head>
<body>
<textarea rows="4" cols="100" id="area"></textarea>
<button id="aff">Afficher</button>
<a href="index.html" target=_blank >Le Carolo Geek</a>
<div id="res"></div>

<script type="application/javascript">
    $("#aff").click(function () {
        data_sub="r="+$("#area").val();
        $.ajax({

                type:"POST",
                url:"retour.php",
                data: data_sub,async:false,
                success:function(data)
            {
               $("#res").append(data);
            }
            
            
            
        })
        
      //  alert($("#area").val());

    })


</script>
</body>
</html>

