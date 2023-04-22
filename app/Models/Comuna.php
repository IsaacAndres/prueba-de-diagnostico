<?php

require_once('config/database.php');

class Comuna
{
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['pdo'];
    }
    
    public function obtenerComunas($regionId)
    {
        $query = $this->db->prepare('SELECT * FROM comunas WHERE region_id = ?');
        $query->execute([$regionId]);
        return $query->fetchAll();
    }
}