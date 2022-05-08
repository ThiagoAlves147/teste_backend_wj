<?php

class CategoryDaoMySql {
    private $pdo;

    public function __construct($pdo){ //Recebe a conexão com o banco de dados
        $this -> pdo = $pdo;
    }

    public function addCategory(){
        
    }

}