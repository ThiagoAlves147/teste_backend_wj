<?php 
    session_start();
    require "../../config.php";
    require_once "../../vendor/autoload.php";
    
    if($pdo){
        $categoryPdo = new CategoryDaoMySql($pdo);
        $getAllCategories = $categoryPdo -> findAllCategories();
    }else
        $getAllCategories = false;
        
?>

<!doctype html>
<html ⚡>
<head>
  <title>Webjump | Backend Test | Add Product</title>
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
    <h1 class="title new-item">New Product</h1>
    
    <form action="../../actions/addProductAction.php" method="POST" enctype="multipart/form-data">
      <div class="input-field">
        <label for="sku" class="label">Product SKU</label>
        <input type="text" id="sku" class="input-text" name="sku"/> 
      </div>
      <div class="input-field">
        <label for="name" class="label">Product Name</label>
        <input type="text" id="name" class="input-text" name="name"/> 
      </div>
      <div class="input-field">
        <label for="price" class="label">Price</label>
        <input type="text" id="price" class="input-text" name="price"/> 
      </div>
      <div class="input-field">
        <label for="quantity" class="label">Quantity</label>
        <input type="number" id="quantity" class="input-text" name="quant"/> 
      </div>
      <div class="input-field">
        <label for="category" class="label">Categories</label>
        <select multiple id="category" class="input-text" name="categories[]">

          <?php if($getAllCategories != false): ?>
            <?php foreach($getAllCategories as $item): ?>
                <option value="<?= $item -> getId() ?>"><?= $item -> getName() ?></option>
            <?php endforeach; ?>
          <?php endif; ?>

        </select>
      </div>
      <div class="input-field">
        <label for="description" class="label">Description</label>
        <textarea id="description" class="input-text" name="desc" style="resize: none"></textarea>
      </div>
      <div class="input-field" id="divFile">
        <input type="file" name="file"  id="file">
      </div>
      <div class="actions-form">
        <a href="products.php" class="action back">Back</a>
        <input class="btn-submit btn-action" type="submit" value="Save Product" />
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

 <script type="text/javascript" src="../javascript/validateAddProduct.js"></script>
</body>
</html>