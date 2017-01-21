<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 12/11/2016
 * Time: 13:26
 */

/*$outputt=shell_exec("gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=ajam_D_1199.pdf ajam_D_119.pdf file.pdf");
echo $outputt;*/

$exec = exec('gswin64c.exe -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile=ajam_D_1199.pdf ajam_D_119.pdf file.pdf 2>&1');
   var_dump($exec) //Return 'convert command not found'

?>