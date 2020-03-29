<?php
    
    try{
        $connstring="mysql:host=localhost;dbname=cookablog_db";
        $user="root";
        $pass="";
        $pdo=new PDO($connstring,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        die($e->getMessage());
    }

?>