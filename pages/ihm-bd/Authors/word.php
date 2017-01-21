<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 11/04/2016
 * Time: 21:17

$output = array();
$path='C:\Program Files (x86)\EasyPHP-Devserver-16.1\eds-www\site\pages\ihm-bd\Authors\unoconv';
$path2='C:\t04_2015.docx';
chdir($path);
$outputt=exec('python unoconv -f pdf --output= C:/unoconv/t04_2015.docx ',$output);
print_r ($output);
 * */
$path2='C:\sites\ajam\pages\ihm-bd\Authors\files\15\temp\\';
echo $path2;
?>