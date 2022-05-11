<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id){
    $productPdo = new ProductDaoMySql($pdo);
    $deleteProduct = $productPdo -> deleteProduct($id);

    if($deleteProduct != true){
        $_SESSION['error'] = 'Não foi possivél deletar este produto, favor tentar novamente!';
        header('Location: ../assets/pages/products.php');
        exit;
    }

    $_SESSION['success'] = 'Ação bem sucedida! Produto deletado';
    header('Location: ../assets/pages/products.php');
    exit;
}

$_SESSION['error'] = 'Produto não encontrado, favor tentar novamente!';
header('Location: ../assets/pages/products.php');
exit;