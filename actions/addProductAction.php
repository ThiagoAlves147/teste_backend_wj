<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$sku = filter_input(INPUT_POST, 'sku', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$quant = filter_input(INPUT_POST, 'quant', FILTER_VALIDATE_INT);
$desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categories = isset($_POST['categories']) ? $_POST['categories'] : false;

if($categories && $sku && $name && $price && $quant && $desc){
    $productPdo = new ProductDaoMySql($pdo);
    $find = $productPdo -> findProductByNameOrSku($name, $sku);

    if($find === false){
        $product = new Product();
        $product -> setSku($sku);
        $product -> setName($name);
        $product -> setPrice($price);
        $product -> setQuant($quant);
        $product -> setDesc($desc);
        $product -> setCategories($categories);
        $productPdo -> addProduct($product);

        $_SESSION['success'] = "Action was a success";

        header('Location: ../assets/pages/products.php');
        exit;
    }else{
        $_SESSION['error'] = 'Request product failed!';
        header('Location: ../assets/pages/addProduct.php');
        exit;
    }
}

$_SESSION['error'] = 'Não foi possivel adicionar o produto, favor tentar novamente!';
header('Location: ../assets/pages/addProduct.php');
exit;