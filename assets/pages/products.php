<?php 
    session_start();
    require "../../config.php";
    require_once "../../vendor/autoload.php";
    
    if($pdo){
        $productPdo = new ProductDaoMySql($pdo);
        $getAllProducts = $productPdo -> findAllProducts();
    }else
        $getAllProducts = false;
        
?>

<!doctype html>
<html ⚡>
<head>
  <title>Webjump | Backend Test | Products</title>
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
      <li><a href="categories.php" class="link-menu">Categorias</a></li>
      <li><a href="products.php" class="link-menu">Produtos</a></li>
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
                    echo $_SESSION['success'] //Exibe a menssagem de erro
                ?>  
            </div>

            <div>
                <img src="../images/bt-close.png" alt="close" width="20px" id="btn-close-success" style="cursor: pointer;">
            </div>
        </div>
    <?php endif; ?>
    <div class="header-list-page">
      <h1 class="title">Products</h1>
      <a href="addProduct.php" class="btn-action">Add new Product</a>
    </div>
    <table class="data-grid">
      <tr class="data-row">
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Name</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">SKU</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Price</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Quantity</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Categories</span>
        </th>

        <th class="data-grid-th">
            <span class="data-grid-cell-content">Actions</span>
        </th>
      </tr>
      <?php if($getAllProducts != false): ?>
          <?php foreach($getAllProducts as $item): ?>
            <tr class="data-row">
              <td class="data-grid-td">
                <span class="data-grid-cell-content"><?= $item -> getName() ?></span>
              </td>
            
              <td class="data-grid-td">
                <span class="data-grid-cell-content"><?= $item -> getSku() ?></span>
              </td>

              <td class="data-grid-td">
                <span class="data-grid-cell-content"><?php echo "R$ ".$item -> getPrice() ?></span>
              </td>

              <td class="data-grid-td">
                <span class="data-grid-cell-content"><?= $item -> getQuant() ?></span>
              </td>

              <td class="data-grid-td">
                <span class="data-grid-cell-content">Category 1 <Br />Category 2</span>
              </td>
            
              <td class="data-grid-td">
                <div class="actions">
                    <a href="../pages/editProduct.php?id=<?= $item -> getId() ?>" class="action edit action-link"><span>Edit</span></div>
                    <a href="../../actions/deleteProductAction.php?id=<?= $item -> getId() ?>" class="action delete action-link" onclick="return confirm('Tem certeza que deseja deletar?')"><span>Delete</span></div>
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
    let btnClose = document.querySelector('#btn-close-success')
    btnClose.addEventListener('click', (e) => {
        document.querySelector('.success').style.display = "none";
    })
  </script>

</body>
</html>
