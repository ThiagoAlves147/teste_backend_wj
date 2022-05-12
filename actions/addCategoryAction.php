<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if($name && $cod){ //Verifica se os dois valores estão preenchidos
    $categoryPdo = new CategoryDaoMySql($pdo); 
    $find = $categoryPdo -> findCategoryByNameOrCod($cod, $name); //Busca a categoria pelo nome ou código, caso não encontre nada retorna false

    if($find === false){ //Verifica se foi encontrado alguma categoria, caso não tenha encontrado, irá tentar adicionar a categoria
        $category = new Category();
        $category -> setCod($cod); 
        $category -> setName($name);
        $categoryPdo -> addCategory($category);

        $_SESSION['success'] = "The category was added with success!"; //Retorna uma mesagem de sucesso caso a ação de adicionar categoria tenha sido efetuada com succeso

        header('Location: ../assets/pages/categories.php');
        exit;

    }else{
        $_SESSION['error'] = 'This category already exists!';
        header('Location: ../assets/pages/addCategory.php'); //Caso $find não seja false, significa que a categoria já existe e não pode ser adicionada
        exit;
    }
}

$_SESSION['error'] = 'It was not possible to add a category, please try again!';
header('Location: ../assets/pages/addCategory.php'); //Retorna para a página de adicionar com uma mensagem de erro, caso todos os dados não tenham sido preenchidos corretamente.
exit;