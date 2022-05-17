<?php

    try{
        $pdo = new PDO('mysql:dbname=db_teste_WJ;host=mysql', "teste", "12345"); //Tenta fazer  a conexão com o banco de dados
    }catch(PDOException $e){
        $pdo = false;
        $error = $e -> getMessage();
    }
    
?>