<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$sku = filter_input(INPUT_POST, 'sku', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$quant = filter_input(INPUT_POST, 'quant', FILTER_VALIDATE_INT);
$desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if($id && $sku && $name && $price && $quant && $desc){
    $productPdo = new ProductDaoMySql($pdo);
    $find = $productPdo -> findProductById($id);

    if($find != false){
        $product = new Product();
        $product -> setSku($id);
        $product -> setSku($sku);
        $product -> setName($name);
        $product -> setPrice($price);
        $product -> setQuant($quant);
        $product -> setDesc($desc);
        $productPdo -> updateProduct($product);

        $_SESSION['success'] = "Product has been updated!";

        header('Location: ../assets/pages/products.php');
        exit;
    }else{
        $_SESSION['error'] = 'Product was not found, please try again!';
        header('Location: ../assets/pages/editProduct.php?id='.$id);
        exit;
    }
}

$_SESSION['error'] = 'It was not possible to update the product, please try again!';
header('Location: ../assets/pages/products.php');
exit;