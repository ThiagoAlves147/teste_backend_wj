<?php

class Product {
    private $id;
    private $name;
    private $sku;
    private $price;
    private $quant;
    private $desc;
    private $categories;

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


    public function setSku($sku){
        $this -> sku = trim(strtoupper($sku));;
    }

    public function getSku(){
        return $this -> sku;
    }


    public function setPrice($price){
        $this -> price = str_replace(',', '.', $price);;
    }

    public function getPrice(){
        return $this -> price;
    }


    public function setQuant($quant){
        $this -> quant = trim(strtoupper($quant));;
    }

    public function getQuant(){
        return $this -> quant;
    }


    public function setDesc($desc){
        $this -> desc = trim(strtoupper($desc));;
    }

    public function getDesc(){
        return $this -> desc;
    }


    public function setCategories($categories){
        $this -> categories = $categories;
    }

    public function getCategories(){
        return $this -> categories;
    }
}

interface ProductDAO {
    public function addProduct(Product $p);
    public function updateProduct(Product $p);
    public function deleteProduct($id);
    public function findAllProducts();
    public function findProductById($id);
    public function findProductByNameOrSku($name, $sku);
}