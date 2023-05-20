<?php

define("SERVER", "localhost");

if ($_SERVER['DOCUMENT_ROOT'] === 'D:/MyWork/cours') {
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "blog");
} else {
    require('db-credentials.php');
}

function connectDB()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Set MySQLi to throw exceptions 

    try {
        //se connecter à la base de données
        $c = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
    } catch (mysqli_sql_exception $e) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    //s'assurer que la connection traite du UTF8
    mysqli_query($c, "SET NAMES 'utf8'");

    // Activer les exceptions de mysqli
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    return $c;
}
