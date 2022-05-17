<?php

    $server_name = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'project';
    $connection = mysqli_connect($server_name, $username, $password, $database);

    if(!$connection){
        die("Error: ". mysqli_connect_error());
    }