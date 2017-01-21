$("#p").click(function( event ) {

    event.preventDefault();
    event.stopPropagation();
    var client = new XMLHttpRequest();

        var file = document.getElementById("uploadfile");

        /* Create a FormData instance */
        var formData = new FormData();
        /* Add the file */
        formData.append("upload", file.files[0]);
    alert (file.files[0]);
        client.open("post", "upload2.php");
        client.setRequestHeader("Content-Type", "multipart/form-data");
        client.setRequestHeader("Cache-Control", "no-cache");
        client.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        client.send(formData);  /* Send to server */


    /* Check the response status */
    client.onreadystatechange = function()
    {
        if (client.readyState == 4 && client.status == 200)
        {
            alert("php:"+client.responseText);
        }
    }
    // Do something
});
/**
 * Created by TOSHIBA on 21/10/2016.
 */
