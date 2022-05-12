<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if($name && $cod && $id){
    $categoryPdo = new CategoryDaoMySql($pdo);
    $find = $categoryPdo -> findCategoryById($id); //Procura a categoria pelo id

    if($find != false){ //Verifica se a categoria existe para fazer o update
        $category = new Category();
        $category -> setId($id);
        $category -> setCod($cod);
        $category -> setName($name);
        $updateCategory = $categoryPdo -> updateCategory($category); //Chama o metódo para atualizar a categoria

        if($updateCategory === true){ //Caso o metódo update retorne true, significa que a categoria foi atualizada
            $_SESSION['success'] = "Category has been update!";

            header('Location: ../assets/pages/categories.php');
            exit;
        }

    }else{
        $_SESSION['error'] = 'Category was not found, please try again!';
        header('Location: ../assets/pages/editCategory.php?id='.$id);
        exit;
    }
}

$_SESSION['error'] = 'Fill all required fields !';
header('Location: ../assets/pages/editCategory.php?id='.$id);
exit;
