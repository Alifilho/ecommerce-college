<?php

require_once "../database/orm.php";


class Product {

    public $orm;
    
    public $idCategory;
    public $idBrand;
    public $idProduct;
    public $description;
    public $stock;
    public $name;
    public $amount;

    public function __construct() {
        $this->orm = new Orm("products");
    }

    public function show($id) {
        return $this->orm->select([], "id = " . $id);
    }

    public function index() {
        return $this->orm->select();
    }

    public function add($body) {
        return $this->orm->insert(array_keys($body), array_values($body));
    }
    
    public function update($id, $body) {
        return $this->orm->update($id, $body);
    }
    
    public function remove($id) {
        return $this->orm->delete("id = " . $id);
    }    
}