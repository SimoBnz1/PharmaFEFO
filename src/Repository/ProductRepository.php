<?php
// src/Repository/ProductRepository.php
require_once __DIR__ . '/../../config/database.php';

class ProductRepository 
{
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllProducts() 
    {
        return $this->db->query("SELECT * FROM produits ORDER BY nom ASC")->fetchAll();
    }
}