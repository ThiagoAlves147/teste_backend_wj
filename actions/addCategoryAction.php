<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id){
    $categoryPdo = new CategoryDaoMySql($pdo);
    $find = $categoryPdo -> findById($id);

    if($find === false){
        $category = new Category();
        $category -> setCod($cod);
        $category -> setName($name);
        $categoryPdo -> addCategory($category);

        $_SESSION['success'] = "Action was a success";

        header('Location: ../assets/pages/categories.php');
        exit;

    }else{
        $_SESSION['error'] = 'Request failed!';
        header('Location: ../assets/pages/addCategory.php');
        exit;
    }
}

$_SESSION['error'] = 'Não foi possivél atualizar, favor tentar novamente!';
header('Location: ../assets/pages/addCategory.php');
exit;
