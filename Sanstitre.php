<?php
   // date_default_timezone_set('Etc/UTC');
include_once 'php/cnx.php';
$select=$conn->query("SELECT date,DATE_ADD(date, INTERVAL 90 DAY) AS endDate from article where id=92");
$row=$select->fetch_assoc();
echo $row['endDate'];
 
?> 
