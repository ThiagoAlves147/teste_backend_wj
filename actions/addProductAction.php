<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$sku = filter_input(INPUT_POST, 'sku', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$quant = filter_input(INPUT_POST, 'quant', FILTER_VALIDATE_INT);
$desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categories = isset($_POST['categories']) ? $_POST['categories'] : false; //Verefica se foi selecionado alguma categoria no formulário, caso não, retorna false

if(in_array($_FILES['file']['type'], array('image/jpeg', 'image/png', 'image/jpg'))){
    $nameFile = md5(time().rand(0, 100)).'.jpeg';
    move_uploaded_file($_FILES['file']['tmp_name'], '../assets/images/product/'.$nameFile);
} else{
    $_SESSION['error'] = 'Essa extensão de arquivo não é permitida';
    header('Location: ../assets/pages/addProduct.php');
    exit;
}


if($categories && $sku && $name && $price && $quant && $desc){
    $productPdo = new ProductDaoMySql($pdo);
    $find = $productPdo -> findProductByNameOrSku($name, $sku); //Busca a produto pelo nome ou sku, caso não encontre nada retorna false

    if($find === false){
        $product = new Product();
        $product -> setSku($sku);
        $product -> setName($name);
        $product -> setPrice($price);
        $product -> setQuant($quant);
        $product -> setDesc($desc);
        $product -> setCategories($categories);
        if($nameFile){
            $product -> setImage($nameFile);
        }
        $productPdo -> addProduct($product);
        
        $_SESSION['success'] = "The product was added with success!";

        header('Location: ../assets/pages/products.php');
        exit;
    }else{
        $_SESSION['error'] = 'Request product failed!';
        header('Location: ../assets/pages/addProduct.php'); //Caso $find não seja false, significa que a categoria já existe e não pode ser adicionada
        exit;
    }
}

$_SESSION['error'] = 'It was not possible to add a category, please try again!';
header('Location: ../assets/pages/addProduct.php');
exit;