/**
 * Created by TOSHIBA on 04/09/2016.
 */
$("#envoyer").click(function (e) {
    e.stopPropagation();

    var data_sub=$('#form').serialize();

    console.log(data_sub);

    $.ajax({
        type:"POST",
        url:"php/rev_validate3.php",
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
})/**
 * Created by TOSHIBA on 09/11/2016.
 */
