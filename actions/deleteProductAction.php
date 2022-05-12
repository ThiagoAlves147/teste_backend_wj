<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id){
    $productPdo = new ProductDaoMySql($pdo);
    $deleteProduct = $productPdo -> deleteProduct($id); //Chama o metodo para deletar o produto

    if($deleteProduct != true){ //Verifica se foi retornado true ao chamar o metódo, caso não, então retorna um erro para o usuário
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