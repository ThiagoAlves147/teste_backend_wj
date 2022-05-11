<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id){
    $productPdo = new ProductDaoMySql($pdo);
    $deleteProduct = $productPdo -> deleteProduct($id);

    if($deleteProduct != true){
        $_SESSION['error'] = 'It was not possible to delete the product!';
        header('Location: ../assets/pages/products.php');
        exit;
    }

    $_SESSION['success'] = 'Product deleted with success!';
    header('Location: ../assets/pages/products.php');
    exit;
}

$_SESSION['error'] = 'Product was not found, please try again!';
header('Location: ../assets/pages/products.php');
exit;