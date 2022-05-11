<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if($name && $cod){
    $categoryPdo = new CategoryDaoMySql($pdo);
    $find = $categoryPdo -> findCategoryByNameOrCod($cod, $name);

    if($find === false){
        $category = new Category();
        $category -> setCod($cod);
        $category -> setName($name);
        $categoryPdo -> addCategory($category);

        $_SESSION['success'] = "The category was added with success!";

        header('Location: ../assets/pages/categories.php');
        exit;

    }else{
        $_SESSION['error'] = 'This category already exists!';
        header('Location: ../assets/pages/addCategory.php');
        exit;
    }
}

$_SESSION['error'] = 'It was not possible to add a category, please try again!';
header('Location: ../assets/pages/addCategory.php');
exit;