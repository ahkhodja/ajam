/**
 * Created by TOSHIBA on 04/09/2016.
 */
$("#envoyer").click(function (e) {
    e.stopPropagation();

    var data_sub=$('#form').serialize();
    


    $.ajax({
        type:"POST",
        url:"php/rev_validate.php",
        data: data_sub,async:false,
        success:function(data)
        {

            if(data == 1)
            {
                location.reload();
            }
            else
            {


            }
        }


    });
})