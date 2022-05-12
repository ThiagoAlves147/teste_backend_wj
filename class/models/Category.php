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

interface CategoryDAO { //Todos os metódos que a classe CategoryDaoMySql precisa para funcionar
    public function addCategory(Category $c);
    public function updateCategory(Category $c);
    public function deleteCategory($id);
    public function findAllCategories();
    public function findCategoryById($id);
    public function findCategoryByNameOrCod($cod, $name);
}