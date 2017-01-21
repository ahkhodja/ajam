<?php
session_start();

/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 08/02/2016
 * Time: 19:56
*/
$file=$_POST['file'];
$id=15;//a changer
$idar=$_POST['ida'];





if (unlink('../files/'.$id.'/'.$idar.'/source/temp/'.$file)) {

    echo "1";
} else {
    echo "0";
}

?>

