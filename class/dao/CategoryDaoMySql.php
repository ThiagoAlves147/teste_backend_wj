<?php

class CategoryDaoMySql implements CategoryDAO {
    private $pdo;

    public function __construct($pdo){ //Recebe a conexão com o banco de dados
        $this -> pdo = $pdo;
    }

    public function addCategory(Category $c){ //Adiciona uma categoria nova
        try{
            $sql = $this -> pdo -> prepare('INSERT INTO categorias(codigo, nome) VALUES(:cod, :name)');
            $sql -> bindValue(':cod', $c -> getCod());
            $sql -> bindValue(':name', $c -> getName());
            $sql -> execute();
        } catch(PDOException $e){
            $_SESSION['error'] = $e -> getMessage();
            header('Location: ../../assets/pages/addCategory.php');
            exit;
        }

    }

    public function updateCategory(Category $c){
        try{
            $sql = $this -> pdo -> prepare("UPDATE categorias SET codigo=:cod, nome=:name WHERE id=:id");
            $sql -> bindValue(':id', $c -> getId());
            $sql -> bindValue(':cod', $c -> getCod());
            $sql -> bindValue(':name', $c -> getName());
            $sql -> execute();
    
            if(!$sql -> rowCount() > 0){
                return false;
            }
    
            return true;

        } catch(PDOException $e){
            $_SESSION['error'] = $e -> getMessage();
            header('Location: ../../assets/pages/editCategory.php?id='.$c -> getId());
            exit;
        }

    }

    public function deleteCategory($id){
        try{
            $sql = $this -> pdo -> prepare('DELETE FROM categorias WHERE id=:id');
            $sql -> bindValue(':id', $id);
            $sql -> execute();
    
            if(!$sql -> rowCount() > 0){
                return false;
            }
    
            return true;

        } catch(PDOException $e){
            $_SESSION['error'] = $e -> getMessage();
            header('Location: ../../assets/pages/categories.php');
            exit;
        }

    }

    public function findAllCategories(){
        try{
            $sql = $this -> pdo -> prepare('SELECT * FROM categorias');
            $sql -> execute();

            if($sql -> rowCount() > 0){
                $data = $sql -> fetchAll();

                foreach($data as $item){
                    $category = new Category();
                    $category -> setId($item['id']);
                    $category -> setCod($item['codigo']);
                    $category -> setName($item['nome']);

                    $list[] = $category;
                }

                return $list;
            }
        } catch(PDOException $e){
            $_SESSION['error'] = $e -> getMessage();
            header('Location: ../../assets/pages/categories.php');
            exit;
        }
    }

    public function findCategoryById($id){
        try{
            $sql = $this -> pdo -> prepare('SELECT * FROM categorias WHERE id=:id');
            $sql -> bindValue(':id', $id);
            $sql -> execute();
    
            if($sql -> rowCount() > 0){
                $item = $sql -> fetch();
    
                $category = new Category();
                $category -> setId($item['id']);
                $category -> setCod($item['codigo']);
                $category -> setName($item['nome']);
    
                return $category;
            }
    
            return false;

        } catch(PDOException $e){
            $_SESSION['error'] = $e -> getMessage();
            header('Location: ../../assets/pages/editCategory.php');
            exit;
        }

    }

    public function findCategoryByNameOrCod($cod, $name){ //
        try{
            $sql = $this -> pdo -> prepare('SELECT * FROM categorias WHERE nome=:name OR codigo=:cod');
            $sql -> bindValue(':name', $name);
            $sql -> bindValue(':cod', $cod);
            $sql -> execute();
    
            if($sql -> rowCount() > 0){
                $item = $sql -> fetch();
    
                $category = new Category();
                $category -> setId($item['id']);
                $category -> setCod($item['codigo']);
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