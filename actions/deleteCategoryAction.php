<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id){
    $categoryPdo = new CategoryDaoMySql($pdo);
    $deleteCategory = $categoryPdo -> deleteCategory($id); //Chama o metódo para deletar a categoria

    if($deleteCategory != true){ //Verifica se a categoria foi deletada
        $_SESSION['error'] = 'It was not possible to delete the category!';
        header('Location: ../assets/pages/categories.php');
        exit;
    }

    $_SESSION['success'] = 'Category deleted with success!';
    header('Location: ../assets/pages/categories.php');
    exit;
}

$_SESSION['error'] = 'Category was not found, please try again!';
header('Location: ../assets/pages/categories.php');
exit;