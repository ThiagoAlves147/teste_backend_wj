<?php 
    session_start();
    require_once "../../config.php";
    require_once "../../vendor/autoload.php"; 

    if($pdo != false){ //Verifica se existe uma conexão com o banco de dados
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); //Pega o id da categoria pela url

        if($id){
            $category = new CategoryDaoMySql($pdo);
            $item = $category -> findCategoryById($id); //Busca a categoria para verificar se ela existe

            if(!$item){ //Caso o usuário não exista, retorna uma mensagem de erro
                $_SESSION['error'] = 'Category was not found! Please, try again!';
                header("Location: categories.php");
                exit;
            }

        }else{
            $_SESSION['error'] = 'Category was not found! Please, try again!';
            header("Location: categories.php");
            exit;
        }
            
    }
?>

<!doctype html>
<html ⚡>
<head>
  <title>Webjump | Backend Test | Edit Category</title>
  <meta charset="utf-8">

<link  rel="stylesheet" type="text/css"  media="all" href="../css/style.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
<meta name="viewport" content="width=device-width,minimum-scale=1">
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script></head>
  <!-- Header -->
<amp-sidebar id="sidebar" class="sample-sidebar" layout="nodisplay" side="left">
  <div class="close-menu">
    <a on="tap:sidebar.toggle">
      <img src="../images/bt-close.png" alt="Close Menu" width="24" height="24" />
    </a>
  </div>
  <a href="../../index.php"><img src="../images/menu-go-jumpers.png" alt="Welcome" width="200" height="43" /></a>
  <div>
    <ul>
      <li><a href="categories.php" class="link-menu">Categories</a></li>
      <li><a href="products.php" class="link-menu">Products</a></li>
    </ul>
  </div>
</amp-sidebar>
<header>
  <div class="go-menu">
    <a on="tap:sidebar.toggle">☰</a>
    <a href="../../index.php" class="link-logo"><img src="../images/go-logo.png" alt="Welcome" width="69" height="430" /></a>
  </div>
  <div class="right-box">
    <span class="go-title">Administration Panel</span>
  </div>    
</header>  
<!-- Header -->
  <!-- Main Content -->
  <main class="content">
  <?php if(isset($_SESSION['error'])): ?>
        <div class="error">
            <div>
                <?php
                    echo $_SESSION['error'] //Exibe a menssagem de erro
                ?>  
            </div>

            <div>
                <img src="../images/bt-close.png" alt="close" width="20px" id="btn-close-error" style="cursor: pointer;">
            </div>
        </div>
    <?php endif; ?>
    <h1 class="title new-item">Edit Category</h1>
    
    <form action="../../actions/updateCategoryAction.php" method="POST">
        <input type="hidden" name="id" value="<?= $item -> getId()?>"/>

        <div class="input-field">
            <label for="category-name" class="label">Category Name</label>
            <input type="text" id="category-name" class="input-text" name="name" value="<?= $item -> getName() ?>"/>
        </div>

        <div class="input-field">
            <label for="category-code" class="label">Category Code</label>
            <input type="text" id="category-code" class="input-text" name="cod" value="<?= $item -> getCod() ?>"/>
        </div>

        <div class="actions-form">
            <a href="categories.php" class="action back">Back</a>
            <input class="btn-submit btn-action"  type="submit" value="Save" />
        </div>
    </form>
  </main>
  <!-- Main Content -->

  <!-- Footer -->
<footer>
	<div class="footer-image">
	  <img src="../images/go-jumpers.png" width="119" height="26" alt="Go Jumpers" />
	</div>
	<div class="email-content">
	  <span>go@jumpers.com.br</span>
	</div>
</footer>
 <!-- Footer -->

<?php session_destroy() ?>

<script type="text/javascript" src="../javascript/app.js"></script>

</body>
</html>
