<?php

class ProductDaoMySql implements ProductDAO {
    private $pdo;

    public function __construct($pdo){
        $this -> pdo = $pdo;
    }

    public function addProduct(Product $p){
        try{
            $sql = $this -> pdo -> prepare('INSERT INTO produtos(nome, sku, preco, quant, descricao) 
            VALUES(:name, :sku, :price, :quant, :desc)');

            $sql -> bindValue(':name', $p -> getName());
            $sql -> bindValue(':sku', $p -> getSku());
            $sql -> bindValue(':price', $p -> getPrice());
            $sql -> bindValue(':quant', $p -> getQuant());
            $sql -> bindValue(':desc', $p -> getDesc());
            $sql -> execute();

            $this -> addProductCategory($p);

        } catch(PDOException $e){
            $_SESSION['error'] = $e -> getMessage();
            header('Location: ../../assets/pages/addCategory.php');
            exit;
        }
    }

    public function addProductCategory(Product $p){
        $categories = $p -> getCategories();
        $id = $this -> pdo -> lastInsertId();

        foreach($categories as $item){
            $sql = $this -> pdo -> prepare('INSERT INTO produto_categoria(id_produto, id_categoria)
            VALUES(:idP, :idC)');

            $sql -> bindValue(':idP', $id);
            $sql -> bindValue(':idC', $item);
            $sql -> execute();
        }
    }

    public function updateProduct(Product $p){

    }

    public function deleteProduct($id){

    }

    public function findAllProducts(){

    }

    public function findProductById($id){

    }

    public function findProductByNameOrSku($name, $sku){
        try{
            $sql = $this -> pdo -> prepare('SELECT * FROM produtos WHERE nome=:name OR sku=:sku');
            $sql -> bindValue(':name', $name);
            $sql -> bindValue(':sku', $sku);
            $sql -> execute();
    
            if($sql -> rowCount() > 0){
                $item = $sql -> fetch();
    
                $category = new Product();
                $category -> setId($item['id']);
                $category -> setSku($item['sku']);
                $category -> setName($item['nome']);
    
                return $category;
            }
    
            return false;

        } catch(PDOException $e){
            $_SESSION['error'] = $e -> getMessage();
            header('Location: ../../assets/pages/addCategory.php');
            exit;
        }
    }
}