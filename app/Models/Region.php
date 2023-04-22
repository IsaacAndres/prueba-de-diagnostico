<?php

require_once('config/database.php');

class Region
{
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['pdo'];
    }
    
    public function listar()
    {
        $query = $this->db->query('SELECT * FROM regiones');
        return $query->fetchAll();
    }
}