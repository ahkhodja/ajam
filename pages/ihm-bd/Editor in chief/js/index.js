/**
 * Created by URTI on 24/02/2016.
 */



$(document).ready(function() {
$('ul li a').click(
    function(e) {
        e.preventDefault(); // prevent the default action
        e.stopPropagation; // stop the click from bubbling
        $(this).closest('ul').find('.selected').removeClass('selected');
        $(this).parent().addClass('selected');
    });
});
$("#submited").click(function(){

    $("#contenu").remove();
    $.ajax({


        type:"POST",
        url:"php/submited.php",
        async:false,
        success:function(data)
        {


            $("#body").append(data);

        }
    });
});
    $("#wa_re").click(function(){

        $("#contenu").remove();
        $.ajax({


            type:"POST",
            url:"php/wa_re.php",
            async:false,
            success:function(data)
            {


                $("#body").append(data);

            }
        });

    });
$("#un_re").click(function(){

    $("#contenu").remove();
    $.ajax({


        type:"POST",
        url:"php/un_rev.php",
        async:false,
        success:function(data)
        {


            $("#body").append(data);

        }
    });

});




