<?php
if ($handle = opendir('../files/15/27/source/temp/')) {


    /* Ceci est la façon correcte de traverser un dossier. */
    while (false !== ($entry = readdir($handle))) {
        if($entry!= "ajax-loader.gif"&&$entry!= "."&&$entry!= ".."){

            unlink('../files/15/27/source/temp/'.$entry) ;;

        }

    }
    closedir($handle);
}
    ?>