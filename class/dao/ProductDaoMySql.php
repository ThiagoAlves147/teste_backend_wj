<?php

class ProductDaoMySql implements ProductDAO {
    private $pdo;

    public function __construct($pdo){
        $this -> pdo = $pdo;
    }

    public function addProduct(Product $p){
        try{
            $sql = $this -> pdo -> prepare('INSERT INTO produtos(nome, sku, preco, quant, descricao, imagem) 
            VALUES(:name, :sku, :price, :quant, :desc, :img)');

            $sql -> bindValue(':name', $p -> getName());
            $sql -> bindValue(':sku', $p -> getSku());
            $sql -> bindValue(':price', $p -> getPrice());
            $sql -> bindValue(':quant', $p -> getQuant());
            $sql -> bindValue(':desc', $p -> getDesc());
            $sql -> bindValue(':img', $p -> getImage());
            $sql -> execute();

            $this -> addProductCategory($p);

        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/addProduct.php');
            exit;
        }
    }

    public function addProductCategory(Product $p){
        try{
            $categories = $p -> getCategories();
            $id = $this -> pdo -> lastInsertId();
    
            foreach($categories as $item){
                $sql = $this -> pdo -> prepare('INSERT INTO produto_categoria(id_produto, id_categoria)
                VALUES(:idP, :idC)');
    
                $sql -> bindValue(':idP', $id);
                $sql -> bindValue(':idC', $item);
                $sql -> execute();
            }
        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/addProduct.php');
            exit;
        }

    }

    public function updateProduct(Product $p){
        try{
            $sql = $this -> pdo -> prepare("UPDATE produtos 
            SET nome=:name, sku=:sku, preco=:price, quant=:quant, descricao=:desc  
            WHERE id=:id");
            $sql -> bindValue(':id', $p -> getId());
            $sql -> bindValue(':name', $p -> getName());
            $sql -> bindValue(':sku', $p -> getSku());
            $sql -> bindValue(':price', $p -> getPrice());
            $sql -> bindValue(':quant', $p -> getQuant());
            $sql -> bindValue(':desc', $p -> getDesc());
            $sql -> execute();
    
            if(!$sql -> rowCount() > 0){
                return false;
            }
    
            return true;

        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/editProduct.php?id='.$p -> getId());
            exit;
        }
    }

    public function deleteProduct($id){
        try{
            $sql = $this -> pdo -> prepare('DELETE FROM produtos WHERE id=:id');
            $sql -> bindValue(':id', $id);
            $sql -> execute();
    
            if(!$sql -> rowCount() > 0){
                return false;
            }
    
            return true;

        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/products.php');
            exit;
        }
    }

    public function findAllProducts(){
        try{
            $sql = $this -> pdo -> prepare('SELECT * FROM produtos ORDER BY nome');
            $sql -> execute();

            if($sql -> rowCount() > 0){
                $data = $sql -> fetchAll();

                foreach($data as $item){
                    $product = new Product();
                    $product -> setId($item['id']);
                    $product -> setName($item['nome']);
                    $product -> setSku($item['sku']);
                    $product -> setPrice($item['preco']);
                    $product -> setQuant($item['quant']);
                    $product -> setImage($item['imagem']);

                    $list[] = $product;
                }

                return $list;
            }

        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/products.php');
            exit;
        }
    }

    public function findProductById($id){
        try{
            $sql = $this -> pdo -> prepare('SELECT * FROM produtos WHERE id=:id');
            $sql -> bindValue(':id', $id);
            $sql -> execute();
    
            if($sql -> rowCount() > 0){
                $item = $sql -> fetch();
    
                $product = new Product();
                $product -> setId($item['id']);
                $product -> setName($item['nome']);
                $product -> setSku($item['sku']);
                $product -> setPrice($item['preco']);
                $product -> setQuant($item['quant']);
                $product -> setDesc($item['descricao']);
    
                return $product;
            }
    
            return false;

        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/editProduct.php'.$id);
            exit;
        }
    }

    public function findProductByNameOrSku($name, $sku){
        try{
            $sql = $this -> pdo -> prepare('SELECT * FROM produtos WHERE nome=:name OR sku=:sku');
            $sql -> bindValue(':name', $name);
            $sql -> bindValue(':sku', $sku);
            $sql -> execute();
    
            if($sql -> rowCount() > 0){
                $item = $sql -> fetch();
    
                $product = new Product();
                $product -> setId($item['id']);
                $product -> setSku($item['sku']);
                $product -> setName($item['nome']);
    
                return $product;
            }
    
            return false;

        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/addProduct.php');
            exit;
        }
    }

    public function findProductCategoriesById($id){
        try{
            $sql = $this -> pdo -> prepare("SELECT categorias.nome as nome
            FROM categorias, produtos, produto_categoria
            WHERE categorias.id=produto_categoria.id_categoria
            AND produtos.id=produto_categoria.id_produto
            AND produtos.id=:id");

            $sql -> bindValue(':id', $id);
            $sql -> execute();

            if($sql -> rowCount() > 0){
                $data = $sql -> fetchAll();
    
                foreach($data as $item){
                    $product = new Product();
                    $product -> setCategories($item['nome']);

                    $list[] = $product;
                }

                return $list;
            }

            return false;

        } catch(PDOException $e){
            $_SESSION['error'] = 'Error '.$e -> getCode().': Please, try again in a few minutes!';
            header('Location: ../../assets/pages/editProduct.php'.$id);
            exit;
        }
    }
}