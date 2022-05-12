<?php 
    session_start();
    require "../../config.php";
    require_once "../../vendor/autoload.php";
    
    if($pdo){ //Verifica se existe uma conexão com o banco de dados
        $categoryPdo = new CategoryDaoMySql($pdo);
        $getAllCategories = $categoryPdo -> findAllCategories(); //Busca todas as categorias para exibir para o usuário
    }else
        $getAllCategories = false; 
        
?>

<!doctype html>
<html ⚡>
<head>
  <title>Webjump | Backend Test | Categories</title>
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
<!-- Header --><body>
  <!-- Main Content -->
  <main class="content">
    <?php if(isset($_SESSION['success'])): ?> 
        <div class="success">
            <div>
                <?php
                    echo $_SESSION['success'] //Exibe a menssagem de successo
                ?>  
            </div>

            <div>
                <img src="../images/bt-close.png" alt="close" width="20px" id="btn-close-success" style="cursor: pointer;">
            </div>
        </div>
    <?php elseif(isset($_SESSION['error'])): ?>
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
    <div class="header-list-page">
      <h1 class="title">Categories</h1>
      <a href="addCategory.php" class="btn-action">Add new Category</a>
    </div>
    <table class="data-grid">
      <tr class="data-row">
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Name</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Code</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Actions</span>
        </th>
      </tr>

      <?php if($getAllCategories != false): //Verifica se foi achado uma ou mais categorias?> 
        <?php foreach($getAllCategories as $item): //Vai listar todas as categorias encontradas na tela?>

            <tr class="data-row">
                <td class="data-grid-td">
                <span class="data-grid-cell-content"><?= $item -> getName() ?></span>
                </td>
            
                <td class="data-grid-td">
                <span class="data-grid-cell-content"><?= $item -> getCod() ?></span>
                </td>
            
                <td class="data-grid-td">
                <div class="actions">
                    <a href="../pages/editCategory.php?id=<?= $item -> getId() ?>" class="action edit action-link"><span>Edit</span></div>
                    <a href="../../actions/deleteCategoryAction.php?id=<?= $item -> getId() ?>" class="action delete action-link" onclick="return confirm('Tem certeza que deseja deletar?')"><span>Delete</span></div>
                </div>
                </td>
            </tr>

        <?php endforeach; ?>     
       <?php endif; ?> 
    </table>
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
  
<script>
    let btnCloseS = document.querySelector('#btn-close-success')
    let btnCloseE = document.querySelector('#btn-close-error');

    if(btnCloseS){
      btnCloseS.addEventListener('click', (e) => {
        document.querySelector('.success').style.display = "none";
      })
    }
    
    if(btnCloseE){
      btnCloseE.addEventListener('click', (e) => {
        document.querySelector('.error').style.display = "none";
    })
    }
</script>

</body>
</html>
