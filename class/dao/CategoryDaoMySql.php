<?php

class CategoryDaoMySql implements CategoryDAO {
    private $pdo;

    public function __construct($pdo){ //Recebe a conexão com o banco de dados
        $this -> pdo = $pdo;
    }

    public function addCategory(Category $c){ //Adiciona uma categoria nova
        $sql = $this -> pdo -> prepare('INSERT INTO categorias(codigo, nome) VALUES(:cod, :name)');
        $sql -> bindValue(':cod', $c -> getCod());
        $sql -> bindValue(':name', $c -> getName());
        $sql -> execute();
    }

    public function findAll(){
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
            $error = $e -> getMessage();
            die();
        }
    }

    public function findByNameOrCod($cod, $name){ //
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
    }

}