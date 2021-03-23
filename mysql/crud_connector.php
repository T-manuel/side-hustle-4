<?php

    $servername = getenv("DB_HOST");
    $username = getenv("DB_USER");
    $password = getenv("DB_PASS");
    $database = getenv("DB_SCHEMA");

    // Create connection
    $conn = new mysqli($servername,$username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("could not connect to MySQL ". $conn->connect_error);
    }
    
?>
