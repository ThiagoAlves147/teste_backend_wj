<?php

use PHPUnit\Framework\TestCase;

class CategoryDaoMySqlTest extends TestCase{

    public function testCanUpdateCategoryWithSuccess(){
        
        $pdo = $this -> createStub(PDO::class);
        $pdoState = $this -> createStub(PDOStatement::class);
        $pdo -> method('prepare') -> willReturn($pdoState);
        $pdoState -> method('rowCount') -> willReturn(1);

        $categoryPdo = new CategoryDaoMySql($pdo);
        $category = new Category();

        $this -> assertTrue($categoryPdo -> updateCategory($category));

    }

    public function testCanDeleteCategoryWithSuccess(){
        
        $pdo = $this -> createStub(PDO::class);
        $pdoState = $this -> createStub(PDOStatement::class);
        $pdo -> method('prepare') -> willReturn($pdoState);
        $pdoState -> method('rowCount') -> willReturn(1);

        $categoryPdo = new CategoryDaoMySql($pdo);
        $category = new Category();

        $this -> assertTrue($categoryPdo -> deleteCategory($category));

    }

}