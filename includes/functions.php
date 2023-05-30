<?php

function connectToDB() {
    $host = 'devkinsta_db';
    $dbname = 'CS_Feedback_Form';
    $dbuser = 'root';
    $dbpassword = 'WlekfIFX5rxSbNj2';

    $database = new PDO (
        "mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword
    );

    return $database;
}