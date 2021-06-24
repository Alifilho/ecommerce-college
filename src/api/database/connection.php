<?php

class Connection {
    
    public $connection;

    public function __construct() {
        try {
            $this->connection = new PDO("sqlite:" . __dir__ . "/ecommerce.db");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $error) {
            echo "Connection failed: " . $error->getMessage();
        }
    }
}