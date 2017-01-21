<?php

set_time_limit(0);
session_start();
if (!isset($_GET["id"])) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}

// on a bien une demande de téléchargement de fichier
if (empty($_GET["a"])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}

if(basename($_GET["a"]) != $_GET["a"]) {
    header("HTTP/1.1 400 Bad Request");
    exit;
}
if (empty($_GET["ida"])) {
    header("HTTP/1.1 404 Not Found");
    exit;
}
$name = $_GET["a"];
$author=$_GET["id"];

// vérifie l'existence et l'accès en lecture au fichier
$filename = "../../Authors/files/".$author."/".$_GET["ida"]."/".$name;
if (!is_file($filename) || !is_readable($filename)) {
    header("HTTP/1.1 404 Not Found");
    exit;
}
$size = filesize($filename);

// désactivation compression GZip
if (ini_get("zlib.output_compression")) {
    ini_set("zlib.output_compression", "Off");
}

// fermeture de la session
session_write_close();

// désactive la mise en cache
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0");
header("Cache-Control: max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// force le téléchargement du fichier avec un beau nom
header("Content-Type: application/force-download");
header('Content-Disposition: attachment; filename="'.$name.'"');

// indique la taille du fichier à télécharger
header("Content-Length: ".$size);

// envoi le contenu du fichier
readfile($filename);?>