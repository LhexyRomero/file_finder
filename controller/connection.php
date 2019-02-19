<?php
    $server = 'localhost';
    $username = 'root';
    $password = 'mysql';
    $dbname = 'files';

    $connect = new mysqli($server, $username, $password, $dbname);

    if(!$connect->connect_error) {
    }
    else {
    }
?>