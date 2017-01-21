<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 12/02/2016
 * Time: 19:49
 */
$id=15;

$filetemp="../files/".$id."/".$_POST['ida']."/source/temp/".$_POST['file'];
if (file_exists($filetemp)) {
    echo "1";
} else {
    echo "0";
}
?>