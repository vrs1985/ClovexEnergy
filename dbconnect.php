<?php

// data base info
    $host = 'localhost';
    $db = 'greenbutton';
    $charset = 'utf8';
    $user = 'root';
    $pass = 'root';
// end data base info

    $con = mysqli_connect($host,$user,$pass,$db );
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_set_charset($con, $charset);

?>