<?php

class Category {
    private $id;
    private $name;
    private $cod;

    public function setId($id){
        $this -> id = $id;
    }

    public function getId(){
        return $this -> id;
    }


    public function setName($name){
        $this -> name = trim(ucfirst(strtolower($name)));
    }

    public function getName(){
        return $this -> name;
    }


    public function setCod($cod){
        $this -> cod = trim(strtoupper($cod));;
    }

    public function getCod(){
        return $this -> cod;
    }
}

interface CategoryDAO {
    public function addCategory(Category $c);
    public function updateCategory(Category $c);
    public function deleteCategory($id);
    public function findAll();
    public function findById($id);
    public function findByNameOrCod($cod, $name);
}