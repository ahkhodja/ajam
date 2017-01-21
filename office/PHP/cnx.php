<?php
$conn= new mysqli('localhost','root','','ajam');
if ($conn->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

?>