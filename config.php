<?php

    try{
        $pdo = new PDO('mysql:dbname=db_teste_WebJump;host=mysql', "webJump", "1234"); //Tenta fazer  a conexão com o banco de dados
    }catch(PDOException $e){
        $pdo = false;
        $error = $e -> getMessage();
    }
    
?>