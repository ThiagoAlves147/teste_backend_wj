<?php
require_once "../config.php";
require_once "../vendor/autoload.php";

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if($name && $cod){
    $categoryPdo = new CategoryDaoMySql($pdo);
    $find = $categoryPdo -> findByNameOrCod($cod, $name);

    if($find === false){
        $category = new Category();
        $category -> setCod($cod);
        $category -> setName($name);
        $categoryPdo -> addCategory($category);

        $_SESSION['sucess'] = 'Action was a success';

        header('Location: ../assets/pages/categories.php');
        exit;

    }else{
        $_SESSION['error'] = 'Error, ainda pensando';
        header('Location: ../assets/pages/addCategory.php');
        exit;
    }
}
