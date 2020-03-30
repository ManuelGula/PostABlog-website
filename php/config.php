<?php
    
    try{
        $connstring="mysql:host=localhost;dbname=cookablog_db";
        $user="root";
        $pass="";
        $link=new PDO($connstring,$user,$pass);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        die($e->getMessage());
    }

?>