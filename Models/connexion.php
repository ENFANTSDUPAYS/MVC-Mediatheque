<?php

function getConnexion(){
    $server = "localhost";
    $db = "mvc";
    $username = "root";
    $password = "";

    try{
        $connexion = new PDO("mysql:host=$server;dbname=$db", $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    return $connexion;
}



