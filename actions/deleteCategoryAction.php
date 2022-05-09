<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id){
    $category = new CategoryDaoMySql($pdo);
    $deleteCategory = $category -> deleteCategory($id);

    if($deleteCategory != true){
        $_SESSION['error'] = 'Não foi possivél deletar está categoria, favor tentar novamente!';
        header('Location: ../assets/pages/categories.php');
        exit;
    }

    $_SESSION['success'] = 'Ação bem sucedida! Categoria deletada';
    header('Location: ../assets/pages/categories.php');
    exit;
}

$_SESSION['error'] = 'Categoria não encontrada, favor tentar novamente!';
header('Location: ../assets/pages/categories.php');
exit;